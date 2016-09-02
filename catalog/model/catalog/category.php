<?php

class ModelCatalogCategory extends Model
{

    /**
     * getCategory method
     */
    public function getCategory($category_id)
    {
        $query = $this->db->query("SELECT DISTINCT * "
            . "FROM " . DB_PREFIX . "category c "
            . "INNER JOIN " . DB_PREFIX . "category_description cd "
            . "ON c.category_id = cd.category_id "
            . "WHERE c.category_id = '" . (int) $category_id . "' "
            . "AND c.status = '1'");

        return $query->row;
    }

    /**
     * getCategoriesForMain method
     */
    public function getCategoriesForMain()
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c 
            INNER JOIN " . DB_PREFIX . "category_description cd 
            ON c.category_id = cd.category_id 
            INNER JOIN " . DB_PREFIX . "category_to_store c2s 
            ON c.category_id = c2s.category_id 
            WHERE c.parent_id = '0' 
            AND c2s.store_id = '" . (int) $this->config->get('config_store_id') . "'  
            AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

        return $query->rows;
    }

    /**
     * Метод получения фильтров категории
     *
     * @param int $category_id
     *
     * @return array
     */
    public function getCategoryFilters($category_id)
    {
        $query = $this->db->query("SELECT * "
            . "FROM " . DB_PREFIX . "param_to_category p2c "
            . "INNER JOIN " . DB_PREFIX . "param p ON p.param_id = p2c.param_id "
            . "INNER JOIN " . DB_PREFIX . "param_value pv ON pv.param_id = p2c.param_id "
            . "INNER JOIN " . DB_PREFIX . "param_value_to_product pv2p ON pv.param_value_id = pv2p.param_value_id "
            . "INNER JOIN " . DB_PREFIX . "product pr ON pv2p.product_id = pr.product_id "
            . "INNER JOIN " . DB_PREFIX . "product_to_category pr2c ON pr2c.product_id = pr.product_id "
            . "AND p2c.category_id = pr2c.category_id "
            . "WHERE p2c.category_id = '" . (int) $category_id . "' AND p.is_filter = 1 AND pr.status = 1 "
            . "ORDER BY pv.value");

        return $query->rows;
    }

    
    /**
     * Метод для sitemap.Возвращает id родительских категорий.
     * 
     * @return array
     */
    public function getParentCategoriesForSiteMap() {
    
        $query = $this->db->query("SELECT c.category_id FROM " . DB_PREFIX . "category c "
                . "INNER JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) "
                . "INNER JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) "
                . "WHERE status = 1 "
                . "AND parent_id = 0 "
                . "AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
        
        return $query->rows;
    }

    public function getProducts($category_id, $params, $offset = 0, $limit = 0) {
        $sql = "SELECT pv2p.product_id, 
                p.in_stock, 
                p.model AS model, 
                p.price, ";

        if (!empty($params)) {
            $sql .= " COUNT(DISTINCT pv.param_id) as count_par, ";
        }

        $sql .= " p.image, 
                pd.name, 
                p2c.category_id,
                p.sort_order
                FROM " . DB_PREFIX . "param_value_to_product pv2p 
                INNER JOIN " . DB_PREFIX . "param_value pv ON (pv.param_value_id = pv2p.param_value_id)
                INNER JOIN " . DB_PREFIX . "product p ON (pv2p.product_id = p.product_id)
                INNER JOIN " . DB_PREFIX . "product_description pd ON (pd.product_id = p.product_id)
                INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id)";

        $sql .= " WHERE p.status = 1 AND in_stock = 1
                AND p2c.category_id = '" . (int) $category_id . "'";

        if (!empty($params)) {
            $i = 0;

            $sql .= " AND (";
            foreach ($params as $param_id => $values) {
                $i++;
                $sql .= "(pv.param_id = '" . $this->db->escape($param_id) . "'";

                if ($values['max_value'] == '') {
                    $sql .= " AND pv.value = '" . $this->db->escape($values['min_value']) . "') ";
                } else {
                    $sql .= " AND pv.value BETWEEN '" . $this->db->escape($values['min_value']) . "' 
                             AND '" . $this->db->escape($values['max_value']) . "') ";
                }

                if (count($params) == $i) {
                    $sql .= ") ";
                } else {
                    $sql .= " OR ";
                }
            }
        }

        $sql .= "GROUP BY pv2p.product_id ";

        if (!empty($params)) {
            $sql .= "HAVING (count_par >= '" . (int)count($params) . "') ";
        }

        $sql .= "ORDER BY p.price";

        if ($limit) {
            $sql .= " LIMIT " . $offset . ", " . $limit;
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

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
        }
        array_values($products);
        return $products;
    }

    public function getProductParameters($product_id)
    {
        $sql = "SELECT pv.value, p.name, p.is_in_category, 
                 pv.param_value_id, p.param_id, p.title 
                 FROM " . DB_PREFIX . "param_value_to_product pvp
                 INNER JOIN " . DB_PREFIX . "param_value pv ON (pvp.param_value_id = pv.param_value_id)
                 INNER JOIN " . DB_PREFIX . "param p ON (p.param_id = pv.param_id)
                 WHERE pvp.product_id = '" . (int)$product_id . "'";

        $sql .= " GROUP BY pvp.param_value_id";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getFilters($category_id) {
        $query = $this->db->query("SELECT pf.*, p.name AS param_name FROM " . DB_PREFIX . "param_filters pf 
            INNER JOIN " . DB_PREFIX . "param p ON(p.param_id = pf.param_id) 
            INNER JOIN " . DB_PREFIX . "param_to_category p2c ON (p2c.param_id = p.param_id) 
            WHERE p2c.category_id = '" . (int)$category_id . "' AND p.is_in_category = 1");

        return $query->rows;
    }
}