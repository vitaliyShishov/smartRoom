<?php

/**
 * Модель поиска товаров
 */
class ModelCatalogSearch extends Model
{

    /**
     * Метод выбирающий товары
     * @return array
     */
    public function getProducts($keyword)
    {
        $sql = "SELECT p.product_id, 
                p2c.category_id, 
                p.in_stock, 
                p.price, 
                ps.price AS special_price, 
                p.image, 
                pd.name, 
                p.model "
            . "FROM " . DB_PREFIX . "product p INNER JOIN " . DB_PREFIX . "product_to_category p2c ON p2c.product_id = p.product_id "
            . "INNER JOIN " . DB_PREFIX . "category_description cd ON cd.category_id = p2c.category_id "
            . "INNER JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id "
            . "LEFT JOIN " . DB_PREFIX . "product_special ps ON ps.product_id = p.product_id AND ps.date_start <= NOW() AND ps.date_end > NOW() "
            . "WHERE p.status = 1 "
            . "AND pd.name LIKE '%" . $this->db->escape(urldecode($keyword)) . "%' "
            . "GROUP BY p.product_id ORDER BY p.sort_order";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    /**
     * Метод подсчета количества товаров
     *
     * @param string $keyword
     *
     * @return int
     */
    public function getProductsTotal($keyword)
    {
        $sql = "SELECT COUNT(*) AS total "
            . "FROM " . DB_PREFIX . "product p "
            . "INNER JOIN " . DB_PREFIX . "product_to_category p2c "
            . "ON p2c.product_id = p.product_id "
            . "INNER JOIN " . DB_PREFIX . "category_description cd "
            . "ON cd.category_id = p2c.category_id "
            . "INNER JOIN " . DB_PREFIX . "product_description pd "
            . "ON pd.product_id = p.product_id "
            . "WHERE p.status = 1 "
            . "AND pd.name LIKE '%" . $this->db->escape(urldecode($keyword)) . "%' ";

        $query = $this->db->query($sql);
        return $query->row['total'];
    }

    /**
     * Метод, возвращающий параметры товара
     *
     * @param int $product_id
     *
     * @return array
     */
    public function getProductParameters($product_id)
    {
        $sql = "SELECT pv.value, p.name, p.param_id, p.is_in_category FROM " . DB_PREFIX . "param_value_to_product pvp
                 INNER JOIN " . DB_PREFIX . "param_value pv ON (pvp.param_value_id = pv.param_value_id)
                 INNER JOIN " . DB_PREFIX . "param p ON (p.param_id = pv.param_id)
                 WHERE pvp.product_id = '" . (int)$product_id . "' AND p.is_in_category = 1";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * Метод преобразующий массив товаров в массив для вывода в template
     *
     * @param array $data
     *
     * @return array
     */
    public function formatProduct($data = array())
    {
        $products = array();

        $this->load->model('tool/image');
        $this->load->language('product/product');

        foreach ($data as $product) {
            $products[$product['product_id']]['href'] = $this->url->link('product/product&product_id=' . $product['product_id']);
            $products[$product['product_id']]['model'] = $product['model'];
            $products[$product['product_id']]['product_id'] = $product['product_id'];
            $products[$product['product_id']]['name'] = $product['name'];
            $products[$product['product_id']]['in_stock'] = $product['in_stock'];

            if ($product['image'] && (file_exists(DIR_IMAGE . '/' . $product['image']))) {
                $image = $product['image'];
            } else {
                $image = 'placeholder.png';
            }

            $products[$product['product_id']]['image'] = $this->model_tool_image->resize($image, $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));

            $products[$product['product_id']]['price'] = $this->currency->format($product['price']);

            $products[$product['product_id']]['params'] = $this->getProductParameters($product['product_id'], true);
        }

        return $products;
    }

    /**
     * Метод товаров для поиска
     * @return array
     */
    public function getProductsSearch($keyword, $limit)
    {
        $new_keyword = str_replace('\'', '"', $keyword);

        $sql = "SELECT p.product_id, 
                p.model, 
                p.price, 
                ps.price AS special_price, 
                p.image AS image,
                pd.name 
                FROM " . DB_PREFIX . "product p 
                INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) 
                INNER JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = p2c.category_id) 
                INNER JOIN " . DB_PREFIX . "product_description pd ON (pd.product_id = p.product_id) 
                LEFT JOIN " . DB_PREFIX . "product_special ps ON (ps.product_id = p.product_id AND ps.date_start <= NOW() AND ps.date_end > NOW())
                WHERE p.status = 1 AND in_stock = 1 
                AND (pd.name LIKE '" . $new_keyword . "%' 
                OR p.model LIKE '" . $new_keyword . "%' 
                OR cd.name LIKE '" . $new_keyword . "%') 
                GROUP BY p.product_id 
                ORDER BY cd.name, pd.name 
                LIMIT 0, " . $limit;

        $query = $this->db->query($sql);

        return $query->rows;
    }

    /**
     * Метод возвращающий наличие параметров
     *
     * @param int $product_id
     *
     * @return boolean
     */
    public function hasParam($product_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param_value_to_product "
            . "WHERE product_id = '" . (int)$product_id . "'");
        if ($query->row) {
            return true;
        } else {
            return false;
        }
    }
}