<?php

class ModelCatalogProduct extends Model
{

    public function addProduct($data)
    {
        $this->event->trigger('pre.admin.product.add', $data);

        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET
            model = '" . $this->db->escape($data['model']) . "',
            price = '" . (float) $data['price'] . "',
            status = '" . (int) $data['status'] . "', 
            in_stock = '" . (int) $data['in_stock'] . "', 
            article = '" . $this->db->escape($data['article']) . "',     
            product_kod = '" . $this->db->escape(isset($data['product_kod']) ? $data['product_kod'] : '') . "',     
            sort_order = '" . (int) $data['sort_order'] . "',
            date_added = NOW()");
        $product_id = $this->db->getLastId();


        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int) $product_id . "'");
        }

        $title = '';

        foreach ($data['product_description'] as $language_id => $value) {
            $temp_description = strip_tags(html_entity_decode($value['description']));
            
            if ($temp_description) {
                $description = $value['description'];
            } else {
                $description = NULL;
            }
            
            $title = $value['name'];
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET "
                    . "product_id = '" . (int) $product_id . "', "
                    . "language_id = '" . (int) $language_id . "', "
                    . "name = '" . $this->db->escape($value['name']) . "', "
                    . "description = '" . $this->db->escape($description) . "', "
                    . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                    . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                    . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = '" . (int) $this->config->get('config_store_id') . "'");

        if (isset($data['product_parameters'])) {
            foreach ($data['product_parameters'] as $parameter) {
                if ($parameter) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "param_value_to_product "
                        . "SET product_id = '" . (int) $product_id . "', "
                        . "param_value_id = '" . $this->db->escape($parameter) . "'");
                }
            }
        }

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int) $product_id . "', customer_group_id = '" . (int) $product_special['customer_group_id'] . "', priority = '" . (int) $product_special['priority'] . "', price = '" . (float) $product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int) $product_image['sort_order'] . "'");
            }
        }

        if (isset($data['product_categories'])) {
            foreach ($data['product_categories'] as $category) { 
                $sql = "INSERT INTO " . DB_PREFIX . "product_to_category SET 
                    product_id = '" . (int) $product_id . "', 
                    category_id = '" . (int) $category['category_id'] . "'";
                $this->db->query($sql);
            }
        }

        if(isset($data['keyword']) && $data['keyword']){
            $keyword = $data['keyword'];
        } else {
            $keyword = strtolower($this->translit->getTranslit($title));
        }

        $repeatStatus = $this->translit->checkRepeatUrlKeyword($keyword);

        if($repeatStatus){
            $keyword = $keyword . "_1";
        }

        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
        }

        $this->cache->delete('product');

        $this->event->trigger('post.admin.product.add', $product_id);

        return $product_id;
    }

    public function editProduct($product_id, $data)
    {
        $this->event->trigger('pre.admin.product.edit', $data);

        $this->db->query("UPDATE " . DB_PREFIX . "product SET
            model = '" . $this->db->escape($data['model']) . "',
            price = '" . (float) $data['price'] . "',
            status = '" . (int) $data['status'] . "',
            in_stock = '" . (int) $data['in_stock'] . "', 
            sort_order = '" . (int) $data['sort_order'] . "',
            product_kod = '" . $this->db->escape($data['article']) . "',     
            date_modified = NOW()
            WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int) $product_id . "'");
        }

        $title = '';
            
        if (isset($data['product_description']) && !empty($data['product_description'])) {
            foreach ($data['product_description'] as $language_id => $value) {
                $temp_description = strip_tags(html_entity_decode($value['description']));
                
                if ($temp_description) {
                    $description = $value['description'];
                } else {
                    $description = NULL;
                }

                $title = $value['name'];

                $this->db->query("UPDATE " . DB_PREFIX . "product_description SET "
                        . "language_id = '" . (int) $language_id . "', "
                        . "name = '" . $this->db->escape($value['name']) . "', "
                        . "description = '" . $this->db->escape($description) . "', "
                        . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                        . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                        . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "' "
                        . "WHERE product_id = '" . (int) $product_id. "'");
            }
        }
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "param_value_to_product WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_parameters'])) {
            foreach ($data['product_parameters'] as $parameter) {
                if ($parameter) {
                    foreach ($parameter as $array_key => $param_value) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "param_value_to_product "
                            . "SET product_id = '" . (int) $product_id . "', "
                            . "param_value_id = '" . $this->db->escape($param_value) . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_product WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_information'])) {
            foreach ($data['product_information'] as $information_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "information_to_product SET product_id = '" . (int) $product_id . "', information_id = '" . (int) $information_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int) $product_id . "', priority = '" . (int) $product_special['priority'] . "', price = '" . (float) $product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int) $product_image['sort_order'] . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_categories'])) {
            foreach ($data['product_categories'] as $category) { 
                $sql = "INSERT INTO " . DB_PREFIX . "product_to_category SET 
                    product_id = '" . (int) $product_id . "', 
                    category_id = '" . (int) $category['category_id'] . "'";
                $this->db->query($sql);
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int) $product_id . "', layout_id = '" . (int) $layout_id . "'");
            }
        }

        $exist_keyword_result = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'product_id=" . (int) $product_id . "'")->row;

        if(isset($exist_keyword_result)){
            $exist_keyword = $exist_keyword_result['keyword'];
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product_id . "'");

        if(isset($data['keyword']) && $data['keyword'] && $exist_keyword != $data['keyword']){
            $keyword = $data['keyword'];
        } else {
            $keyword = strtolower($this->translit->getTranslit($title));
        }

        $repeatStatus = $this->translit->checkRepeatUrlKeyword($keyword);

        if($repeatStatus){
            $keyword = $keyword . "_1";
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product_id . "', keyword = '" . $this->db->escape($keyword) . "'");

        $this->cache->delete('product');
        $this->event->trigger('post.admin.product.edit', $product_id);
    }

    public function copyProduct($product_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p"
                . " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)"
                . " WHERE p.product_id = '" . (int) $product_id . "' "
                . "AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if ($query->num_rows) {
            $data = $query->row;

            $data['viewed'] = '0';
            $data['keyword'] = '';
            $data['status'] = '0';

            $data['product_description'] = $this->getProductDescriptions($product_id);
            $data['product_image'] = $this->getProductImages($product_id);
            $data['product_special'] = $this->getProductSpecials($product_id);
            $data['product_category'] = $this->getProductCategory($product_id);
            $data['product_layout'] = $this->getProductLayouts($product_id);
            $data['product_store'] = $this->getProductStores($product_id);
            $data['product_information'] = $this->getInformationForProduct($product_id);

            $this->addProduct($data);
        }
    }

    public function deleteProduct($product_id)
    {
        $this->event->trigger('pre.admin.product.delete', $product_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_product WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product_id . "'");

        $this->cache->delete('product');

        $this->event->trigger('post.admin.product.delete', $product_id);
    }

    public function getProduct($product_id)
    {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int) $product_id . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getProducts($data = array())
    {
        $sql = "SELECT *, p.product_id AS product_id, ptc.product_id AS category_product_id, cd.name as category_name, pd.name AS product_name FROM " . DB_PREFIX . "product p "
                . "INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) "
                . "LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id = ptc.product_id) "
                . "LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = ptc.category_id) "
                . "WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }
        
        if (!empty($data['filter_category'])) {
            $sql .= " AND cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
        }

        if (!empty($data['filter_model'])) {
            $sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
        }

        if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
            $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_product_kod']) && !is_null($data['filter_product_kod'])) {
            $sql .= " AND p.product_kod LIKE '" . $this->db->escape($data['filter_product_kod']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
        }

        $sql .= " GROUP BY p.product_id";

        $sort_data = array(
            'pd.name',
            'p.model',
            'p.price',
            'p.status',
            'p.sort_order',
            'category_name'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY pd.name";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getProductsByCategoryId($category_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int) $category_id . "' ORDER BY pd.name ASC");

        return $query->rows;
    }

    public function getProductDescriptions($product_id)
    {
        $product_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_description_data[$result['language_id']] = array(
                'name' => $result['name'],
                'description' => $result['description'],
                'meta_title' => $result['meta_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword' => $result['meta_keyword']
            );
        }

        return $product_description_data;
    }

    /**
     * Метод возвращающий категории продукта
     * 
     * @param int $product_id
     * 
     * @return array
     */
    public function getProductCategories($product_id)
    {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "
                    product_to_category 
                    WHERE product_id = '" . (int) $product_id . "'");

        return $query->rows;
    }

    /**
     * Метод, возвращающий все комплекты, привязанные к конкретному продукту
     * 
     * @param int $product_id
     * 
     * @return array
     */
    public function getProductComplects($product_id)
    {

        $product_complect = array();

        $query = $this->db->query("SELECT *, pd.name as product_name FROM " . DB_PREFIX . "product_complect pc
                    LEFT JOIN " . DB_PREFIX . "product_description pd ON (pc.bonus_product_id = pd.product_id) 
                    WHERE pc.product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_complect[] = array(
                'product_discount' => $result['discount_value'],
                'bonus_discount' => $result['bonus_discount_value'],
                'product_discount_type' => $result['discount_type'],
                'bonus_discount_type' => $result['bonus_discount_type'],
                'product_name' => $result['product_name'],
                'product_id' => $result['bonus_product_id'],
                'date_start' => $result['date_start'],
                'date_end' => $result['date_end'],
                'sort_order' => $result['sort_order']
            );
        }
        return $product_complect;
    }


    public function getProductImages($product_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "' ORDER BY sort_order ASC");

        return $query->rows;
    }


    public function getProductSpecials($product_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "' ORDER BY priority, price");

        return $query->rows;
    }

    public function getProductStores($product_id)
    {
        $product_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            if(isset($result['store_id'])) {
                $product_store_data[] = $result['store_id'];
            }
        }

        return $product_store_data;
    }

    public function getProductLayouts($product_id)
    {
        $product_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_layout_data[] = $result['layout_id'];
        }

        return $product_layout_data;
    }

    public function getTotalProducts($data = array())
    {
        $sql = "SELECT COUNT(DISTINCT p.product_id) AS total "
                . "FROM " . DB_PREFIX . "product p "
                . "INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)"
                . "LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id = ptc.product_id) "
                . "LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = ptc.category_id)";

        $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }
        
        if (!empty($data['filter_category'])) {
            $sql .= " AND cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
        }

        if (!empty($data['filter_model'])) {
            $sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
        }

        if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
            $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_product_kod']) && !is_null($data['filter_product_kod'])) {
            $sql .= " AND p.product_kod LIKE '" . $this->db->escape($data['filter_product_kod']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalProductsByTaxClassId($tax_class_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int) $tax_class_id . "'");

        return $query->row['total'];
    }


    public function getTotalProductsByLayoutId($layout_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int) $layout_id . "'");

        return $query->row['total'];
    }
    
    /**
     * Метод возвращающий статьи привязанные к товару
     * 
     * @param int $product_id
     * 
     * @return array
     */
    public function getInformationForProduct ($product_id) {
        $information_data = array();
        
        $query = $this->db->query("SELECT information_id  FROM " . DB_PREFIX . "information_to_product "
                . "WHERE product_id = '" . (int)$product_id . "'");
        foreach($query->rows as $result) {
            $information_data[] = $result['information_id'];
        }
        
        return $information_data;
    }
    
    /**
     * Метод, возвращающий главную катугорию товара
     * 
     * @param int $product_id
     * 
     * @return int
     */
    public function getMainCategory($product_id)
    {
        $query = $this->db->query("SELECT category_id
                    FROM " . DB_PREFIX . "product_to_category 
                    WHERE product_id = '" . (int) $product_id . "' 
                    AND is_main = 1");
       
        if (!empty($query->row)) {
            $category_id = $query->row['category_id'];
        } else {
            $category_id = 0;
        }
        
        return $category_id;
    }
}