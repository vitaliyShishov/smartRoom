<?php

class ModelCatalogProduct extends Model
{

    public function getProduct($product_id, $category_id = null)
    {
        $sql = "SELECT DISTINCT *, pd.description as product_description, cd.name as category_name,
                pd.name AS name, p.image, 
                pd.meta_title AS product_meta_title, 
                pd.meta_description AS product_meta_description,
                pd.meta_keyword AS product_meta_keyword, 
                p.sort_order, p.in_stock 
                FROM " . DB_PREFIX . "product p 
                INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
                INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
                INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) 
                INNER JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = p2c.category_id)
                INNER JOIN " . DB_PREFIX . "category c ON (c.category_id = p2c.category_id) 
                WHERE p.product_id = '" . (int) $product_id . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "' 
                AND p.status = '1' AND p2s.store_id = '" . (int) $this->config->get('config_store_id') . "'";
        
                if ($category_id) {
                    $sql .= " AND p2c.category_id = '" . (int)$category_id . "' ";
                }
        
                $sql .= "GROUP BY p.product_id";

                $query = $this->db->query($sql);
                
        if ($query->num_rows) {
            return array(
                'product_id'            => $query->row['product_id'],
                'name'                  => $query->row['name'],
                'description'           => $query->row['product_description'],
                'meta_title'            => $query->row['product_meta_title'],
                'meta_description'      => $query->row['product_meta_description'],
                'meta_keyword'          => $query->row['product_meta_keyword'],
                'model'                 => $query->row['model'],
                'image'                 => $query->row['image'],
                'price'                 => $query->row['price'],
                'category_id'           => $query->row['category_id'],
                'category_name'         => $query->row['category_name'],
                'sort_order'            => $query->row['sort_order'],
                'article'               => $query->row['article'],
                'in_stock'              => $query->row['in_stock']
            );
        } else {
            return false;
        }
    }

    public function getProducts($category_id, $offset = 0, $limit = 0)
    {
        $sql = "SELECT p.product_id, 
                p.in_stock, 
                p.model AS model, 
                p.price, 
                p.image, 
                pd.name, 
                p2c.category_id,
                p.sort_order
                FROM " . DB_PREFIX . "product p 
                INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) 
                INNER JOIN " . DB_PREFIX . "product_description pd ON (pd.product_id = p.product_id) 
                WHERE p.status = 1 AND in_stock = 1
                AND p2c.category_id = '" . (int) $category_id . "'
                ORDER BY p.price";
        
        if ($limit) {
            $sql .= " LIMIT " . $offset . ", " . $limit;
        }
        
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getProductsForSiteMap()
    {

        $query = $this->db->query("SELECT p.product_id, p.date_modified FROM " . DB_PREFIX . "product p "
                . "INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) "
                . "INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) "
                . "INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_Id) "
                . "WHERE status = 1 "
                . "AND p2s.store_id = '" . (int) $this->config->get('config_store_id') . "'");

        return $query->rows;
    }
    

    public function getProductsTotal($category_id)
    {
        $sql = "SELECT COUNT(DISTINCT p.product_id) AS total "
            . "FROM " . DB_PREFIX . "product p "
            . "INNER JOIN " . DB_PREFIX . "product_to_category p2c "
            . "ON p2c.product_id = p.product_id "
            . "INNER JOIN " . DB_PREFIX . "product_description pd "
            . "ON pd.product_id = p.product_id "
            . "WHERE p.status = 1 "
            . "AND p2c.category_id = '" . (int) $category_id . "'";
        
        $query = $this->db->query($sql);

        return $query->row['total'];
    }


    public function getProductsWithParams($param_value_array)
    {
        $query = $this->db->query("SELECT product_id, COUNT(DISTINCT param_value_id) AS param_count "
            . "FROM " . DB_PREFIX . "param_value_to_product "
            . "WHERE param_value_id IN ('" . implode("','", $param_value_array) . "') "
            . "GROUP BY product_id "
            . "HAVING param_count = " . count($param_value_array) . ";");

        $products = array();
        foreach ($query->rows as $product) {
            $products[] = $product['product_id'];
        }

        return $products;
    }

    public function getProductImages($productId)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $productId . "' ORDER BY sort_order ASC");

        return $query->rows;
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

        return $products;
    }

    public function addOrder($data) {
        $product_info = $this->getProduct($data['product_id']);

        $this->db->query("INSERT INTO `" . DB_PREFIX . "order` SET
                    store_id = '" . (int)$this->config->get('config_store_id') . "', 
                    firstname = '" . $this->db->escape($data['name']) . "', 
                    email = '',
                    total = '" . (float)$product_info['price'] . "',
                    order_status_id = 1,
                    telephone = '" . $this->db->escape($data['telephone']) . "',
                    date_added = NOW(), date_modified = NOW()");

        $order_id = $this->db->getLastId();


        $this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET 
                      order_id = '" . (int)$order_id . "', 
                      product_id = '" . (int)$data['product_id']  . "', 
                      order_status_id = 1, 
                      `name` = '" . $this->db->escape($product_info['name']) . "', 
                      model = '" . $this->db->escape($product_info['model']) . "', 
                      quantity = 1, 
                      price = '" . (float)$product_info['price'] . "', 
                      total = '" . (float)$product_info['price'] . "', 
                      date_added = NOW(), date_modified = NOW()");

    }
}