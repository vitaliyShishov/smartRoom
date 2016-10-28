<?php

class ModelToolImportTool extends Model
{
    protected $_csv;
    protected $_filename;
    protected $_headers;
    protected $_rowCount;
    protected $_importMethod;
    protected $_csvFileName;
    //------------------------------
    protected $_row = 1;
    protected $_reader;
    protected $_highestRow;
    protected $_highestColumn;
    protected $_numOfSheets;
    protected $_inputFileType;

    public function getQueries($data)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "import_log ORDER BY import_date DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalQueries()
    {
        $query = $this->db->query("SELECT COUNT(id) AS total FROM " . DB_PREFIX . "import_log");

        return $query->row['total'];
    }

    public function saveFile($file)
    {
        if (isset($file)) {
            $status = true;
            $uploaded_file = '';

            $uploadDir = DIR_UPLOADS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777);
            }

            if (move_uploaded_file($file['tmp_name'], $uploadDir . basename($file['name']))) {
                $uploaded_file = $file['name'];
                $status = true;
            } else {
                $status = false;
            }

            $return = array(
                'file' => $uploaded_file,
                'status' => $status
            );

            return $return;
        }
    }

    public function loadFileXls($filename){
        $this->_filename = $filename;
        require_once(DIR_SYSTEM . 'PHPExcel/Classes/PHPExcel.php' );

        // Memory Optimization
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array(' memoryCacheSize '  => '16MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        // parse file
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);

        //-------------------------------------------
        $objPHPExcel = $objReader->load($filename);
        $numOfSheets = $objPHPExcel->getSheetCount();
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
        $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'

        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

        $data = array();

        for ($col = 0; $col <= $highestColumnIndex; ++$col) {
            $data[] =  $objWorksheet->getCellByColumnAndRow($col, $this->_row)->getValue();
        }

        $this->_highestRow = $highestRow;
        $this->_highestColumn = $highestColumnIndex;
        $this->_numOfSheets  = $numOfSheets;
        $this->_headers = $data;
        $this->_reader = $objPHPExcel;

        $this->createProducts();
    }

    public function createProducts() {
        $collection = $this->collectProduct();

        $final_products = array();

        foreach ($collection as $data) {
            if(!empty($data['Код'])) {
                $checkProductExist = $this->checkProductExist($data['Код']);
            } else {
                $checkProductExist = array();
            }

            $product = array();

            if(empty($checkProductExist)) {

                $product['product_description'] = array();

                if(!empty($data['Наименование'])) {
                    $title_data = explode('/', $data['Наименование']);

                    $temp_data_array = explode(' ', $title_data[0]);

                    $product['product_description'][$this->config->get('config_language_id')] = array(
                        'name' => $temp_data_array[0] . ' ' . $temp_data_array[1],
                        'description' => null,
                        'meta_title' => $temp_data_array[0] . ' ' . $temp_data_array[1],
                        'meta_description' => $temp_data_array[0] . ' ' . $temp_data_array[1],
                        'meta_keyword' => $temp_data_array[0] . ' ' . $temp_data_array[1]
                    );

                }
                
                if (!empty($data['Вендор'])) {
                    $temp_model_array = explode(' ', $data['Вендор']);
                    $product['model'] = !empty($temp_model_array[0]) ? $temp_model_array[0] : '';
                } else {
                    $product['model'] = '';
                }

                $product['product_categories'] = $this->checkCategoryExist($data['Подкатегория']);;

                $product['price'] = (float)$data['Рек.цена'];
                $product['status'] = 0;
                $product['product_kod'] = $data['Код'];
                $product['in_stock'] = ($data['Статус'] == 'доступен') ? 1 : 0;
                $product['tax_class_id'] = (int)$data[''];
                $product['article'] = '';
                $product['sort_order'] = 0;
                $product['image'] = '';
                $product['update'] = false;

                $final_products[] = $product;
            } else {
                if ($checkProductExist['price'] != (float)$data['Рек.цена']) {
                    $product['price'] = (float)$data['Рек.цена'];
                }

                $in_stock = ($data['Статус'] == 'доступен') ? 1 : 0;

                if ($checkProductExist['in_stock'] != $in_stock) {
                    $product['in_stock'] = ($data['Статус'] == 'доступен') ? 1 : 0;
                }

                if (!empty($product)) {
                    $product['update'] = true;
                    $product['product_id'] = $checkProductExist['product_id'];
                    $product['product_kod'] = $checkProductExist['product_kod'];
                    $final_products[] = $product;
                }
            }

        }

        $this->saveProducts($final_products);

        return true;
    }

    public function collectProduct() {
        $collection = array();
        for ($sheet = 0; $this->_numOfSheets - 1 >= $sheet; $sheet++) {

            for ($i = $this->_row + 1; $i <= $this->_highestRow; $i++) { // skip header
                $tmp = array_combine($this->_headers, $this->getXlsRow($i, $sheet));
                $collection[] = $tmp;
            }
        }
        return $collection;
    }

    public function getXlsRow($row, $sheet){
        $data = array();
        $objWorksheet = $this->_reader->getSheet($sheet);
        for ($coll = 0; $coll <= $this->_highestColumn; ++$coll) {
            $data[] = $objWorksheet->getCellByColumnAndRow($coll, $row)->getValue();
        }
        return $data;
    }

    public function checkCategoryExist($title) {
        $query = $this->db->query("SELECT c.category_id FROM " . DB_PREFIX . "category c 
                INNER JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)
                WHERE cd.name LIKE '" . $this->db->escape($title) . "%' 
                AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        if(!empty($query->row['category_id'])) {
            $result[] = array(
                'category_id' => $query->row['category_id']
            );
        } else {
            $result = array();
        }

        return $result;
    }

    public function checkProductExist($product_kod) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE product_kod = '" . $this->db->escape($product_kod) . "'");

        return $query->row;
    }

    public function saveProducts($data) {
        $this->load->model('catalog/product');

        $updated_products = array();

        foreach ($data as $product) {
            if ($product['update']) {
                $product_id = $this->updateSingleProduct($product);
            } else {
                $product_id = $this->model_catalog_product->addProduct($product);
            }

            $updated_products[] = array(
                'product_id' => $product_id,
                'product_code' => $product['product_kod']
            );
        }

        $this->updateImportLog($updated_products);
    }

    public function updateImportLog($data) {
        if (!empty($data)) {
            $array = serialize($data);
        } else {
            $array = null;
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "import_log SET
                          import_products = '" . $this->db->escape($array) . "', 
                          import_date = NOW()");
    }

    public function updateSingleProduct($data) {
        $sql = "UPDATE " . DB_PREFIX . "product SET ";

        if (isset($data['price']) && isset($data['in_stock'])) {
            $sql .= "price = '" . (int)$data['price'] . "', in_stock = '" . (int)$data['in_stock'] . "'";
        } else if (isset($data['price']) && !isset($data['in_stock'])) {
            $sql .= "price = '" . (int)$data['price'] . "'";
        } else if (!isset($data['price']) && isset($data['in_stock'])) {
            $sql .= "in_stock = '" . (int)$data['in_stock'] . "'";
        }

        $sql .= "WHERE product_id = '" . (int)$data['product_id'] . "'";

        $this->db->query($sql);

        return $data['product_id'];
    }
}