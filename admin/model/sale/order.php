<?php

/**
 * Класс модели для работы с сущностью order
 */
class ModelSaleOrder extends Model
{
    /**
     * Метод для добавления заказа
     * 
     * @param array $data
     * 
     * @return int
     */
    public function addOrder($data)
    {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "order` SET
            firstname = '" . $this->db->escape($data['customer']) . "',
            email = '" . $this->db->escape($data['email']) . "',
            telephone = '" . $this->db->escape("+" . preg_replace("/\D/", "", $data['telephone'])) . "',
            payment_method = '" . $this->db->escape($data['payment_method']) . "',
            shipping_city = '" . $this->db->escape($data['shipping_city']) . "',
            shipping_warehouse = '" . $this->db->escape($data['shipping_warehouse']) . "',
            shipping_method = '" . $this->db->escape($data['shipping_method']) . "',
            total = '" . (float) $data['total'] . "',
            order_status_id = '" . (int) $this->config->get('config_order_status_id') . "',
            date_added = NOW(), date_modified = NOW()");

        $order_id = $this->db->getLastId();

        // Products
        if (isset($data['products'])) {
            foreach ($data['products'] as $product) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET
                    order_id = '" . (int) $order_id . "',
                    product_id = '" . (int) $product['product_id'] . "',
                    name = '" . $this->db->escape($product['name']) . "',
                    model = '" . $this->db->escape($product['model']) . "',
                    quantity = '" . (int) $product['quantity'] . "',
                    price = '" . (float) $product['price'] . "',
                    total = '" . (float) $product['total'] . "', 
                    order_status_id = '" . $data['status'] . "'");
            }
        }
        
        return $order_id;
    }

    /**
     * Метод для редактирования заказа
     * 
     * @param int $order_id
     * @param int $data
     */
    public function editOrder($order_id, $data)
    {
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET
                    firstname = '" . $this->db->escape($data['customer']) . "',
                    email = '" . $this->db->escape($data['email']) . "',
                    telephone = '" . $this->db->escape("+" . preg_replace("/\D/", "", $data['telephone'])) . "',
                    payment_method = '" . $this->db->escape($data['payment_method']) . "',
                    shipping_city = '" . $this->db->escape($data['shipping_city']) . "',
                    shipping_warehouse = '" . $this->db->escape($data['shipping_warehouse']) . "',
                    shipping_method = '" . $this->db->escape($data['shipping_method']) . "',
                    total = '" . (float) $data['total'] . "',
                    date_modified = NOW() 
                    WHERE order_id = '" . (int) $order_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
        
        // Products
        if (isset($data['products'])) {
            foreach ($data['products'] as $product) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET
                    order_id = '" . (int) $order_id . "',
                    product_id = '" . (int) $product['product_id'] . "',
                    name = '" . $this->db->escape($product['name']) . "',
                    model = '" . $this->db->escape($product['model']) . "',
                    quantity = '" . (int) $product['quantity'] . "',
                    price = '" . (float) $product['price'] . "',
                    total = '" . (float) $product['total'] . "', 
                    order_status_id = '" . $data['order_status_id'] . "'");
            }
        }
    }

    /**
     * Метод для удаления заказа
     * 
     * @param int $order_id
     */
    public function deleteOrder($order_id)
    {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int) $order_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int) $order_id . "'");
    }

    /**
     * Метод для получения всей информации о заказе
     * 
     * @param int $order_id
     * 
     * @return array
     */
    public function getOrder($order_id)
    {
        $order_query = $this->db->query("SELECT * "
                . "FROM `" . DB_PREFIX . "order` o "
                . "WHERE o.order_id = '" . (int) $order_id . "'");

        if ($order_query->num_rows) {

            $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product "
                    . "WHERE order_id = '" . (int) $order_id . "'");

            return array(
                'order_id' => $order_query->row['order_id'],
                'customer' => $order_query->row['firstname'],
                'email' => $order_query->row['email'],
                'telephone' => $order_query->row['telephone'],
                'comment' => $order_query->row['comment'],
                'total' => $order_query->row['total'],
                'order_status_id' => $order_query->row['order_status_id'],
                'date_added' => $order_query->row['date_added'],
                'date_modified' => $order_query->row['date_modified'],
                'payment_method' => $order_query->row['payment_method'],
                'shipping_method' => $order_query->row['shipping_method'],
                'shipping_city' => $order_query->row['shipping_city'],
                'shipping_warehouse' => $order_query->row['shipping_warehouse']
            );
        } else {
            return array();
        }
    }

    /**
     * Метод для получения всех заказов
     * 
     * @param array $data
     * 
     * @return array
     */
    public function getOrders($data = array())
    {
        $sql = "SELECT o.order_id, "
                . "o.firstname AS customer, "
                . "(SELECT os.name FROM " . DB_PREFIX . "order_status os "
                . "WHERE os.order_status_id = o.order_status_id "
                . "AND os.language_id = '" . (int) $this->config->get('config_language_id') . "') AS status, "
                . "o.total, o.date_added, o.date_modified FROM `" . DB_PREFIX . "order` o";

        if (isset($data['filter_order_status'])) {
            $implode = array();

            $order_statuses = explode(',', $data['filter_order_status']);

            foreach ($order_statuses as $order_status_id) {
                $implode[] = "o.order_status_id = '" . (int) $order_status_id . "'";
            }

            if ($implode) {
                $sql .= " WHERE (" . implode(" OR ", $implode) . ")";
            } else {
                
            }
        } else {
            $sql .= " WHERE o.order_status_id > '0'";
        }

        if (!empty($data['filter_order_id'])) {
            $sql .= " AND o.order_id = '" . (int) $data['filter_order_id'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND o.firstname LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(o.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(o.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if (!empty($data['filter_total'])) {
            $sql .= " AND o.total = '" . (float) $data['filter_total'] . "'";
        }

        $sort_data = array(
            'o.order_id',
            'customer',
            'status',
            'o.date_added',
            'o.date_modified',
            'o.total'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY o.order_id";
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

    /**
     * Метод для получения продуктов заказа
     * 
     * @param int $order_id
     * 
     * @return array
     */
    public function getOrderProducts($order_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int) $order_id . "'");

        return $query->rows;
    }

    /**
     * Метод, который возвращает параметры продукта
     * 
     * @param int $product_id
     * 
     * @return array
     */
    public function getProductParameters($product_id)
    {
        $query = $this->db->query("SELECT p.name, pv.value "
                . "FROM " . DB_PREFIX . "param p "
                . "INNER JOIN " . DB_PREFIX . "param_value pv ON (p.param_id = pv.param_id )"
                . "INNER JOIN " . DB_PREFIX . "param_value_to_product pv2p ON (pv.param_value_id = pv2p.param_value_id) "
                . "WHERE pv2p.product_id = '" . (int) $product_id . "'");

        return $query->rows;
    }

    /**
     * Метод для обновления истории смены статусов заказа
     * 
     * @param int $order_id
     * @param int $order_status_id
     * @param string $order_comment
     */
    public function updateOrderHistory($order_id, $order_status_id, $order_comment)
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "order_history "
                . "SET order_id = '" . (int) $order_id . "', "
                . "order_status_id = '" . (int) $order_status_id . "', "
                . "comment = '" . $this->db->escape($order_comment) . "', "
                . "date_added = NOW()");
    }

    /**
     * Метод для обновления статуса заказа в таблице order
     * 
     * @param int $order_id
     * @param int $order_status_id
     */
    public function updateOrder($order_id, $order_status_id)
    {
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET "
                . "order_status_id = '" . (int) $order_status_id . "' "
                . "WHERE order_id = '" . (int) $order_id . "'");
    }

    /**
     * Метод для получения имени статуса заказа
     * 
     * @param int $order_status_id
     * 
     * @return string
     */
    public function getOrderStatusName($order_status_id)
    {
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int) $order_status_id . "'");

        return $query->row['name'];
    }

    /**
     * Метод для получения общей суммы заказа
     * 
     * @param int $order_id
     * 
     * @return int
     */
    public function getOrderTotals($order_id)
    {
        $query = $this->db->query("SELECT total FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int) $order_id . "'");

        return $query->rows;
    }

    /**
     * Метод для получения кол-ва заказов
     * 
     * @param array $data
     * 
     * @return int
     */
    public function getTotalOrders($data = array())
    {
        $sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order`";

        if (!empty($data['filter_order_status'])) {
            $implode = array();

            $order_statuses = explode(',', $data['filter_order_status']);

            foreach ($order_statuses as $order_status_id) {
                $implode[] = "order_status_id = '" . (int) $order_status_id . "'";
            }

            if ($implode) {
                $sql .= " WHERE (" . implode(" OR ", $implode) . ")";
            }
        } else {
            $sql .= " WHERE order_status_id > '0'";
        }

        if (!empty($data['filter_order_id'])) {
            $sql .= " AND order_id = '" . (int) $data['filter_order_id'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND firstname LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if (!empty($data['filter_total'])) {
            $sql .= " AND total = '" . (float) $data['filter_total'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    /**
     * Метод для получения кол-ва заказов по магазину
     * 
     * @param int $store_id
     * 
     * @return int
     */
    public function getTotalOrdersByStoreId($store_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE store_id = '" . (int) $store_id . "'");

        return $query->row['total'];
    }

    /**
     * Метод для получения кол-ва заказов по статусу заказа
     * 
     * @param int $order_status_id
     * 
     * @return int
     */
    public function getTotalOrdersByOrderStatusId($order_status_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id = '" . (int) $order_status_id . "' AND order_status_id > '0'");

        return $query->row['total'];
    }

    /**
     * Метод для получения кол-ва заказов по статусу "В процессе"
     * 
     * @return int
     */
    public function getTotalOrdersByProcessingStatus()
    {
        $implode = array();

        $order_statuses = $this->config->get('config_processing_status');

        foreach ($order_statuses as $order_status_id) {
            $implode[] = "order_status_id = '" . (int) $order_status_id . "'";
        }

        if ($implode) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE " . implode(" OR ", $implode));

            return $query->row['total'];
        } else {
            return 0;
        }
    }

    /**
     * Метод для получения кол-ва заказов по статусу "Завершен" 
     * 
     * @return int
     */
    public function getTotalOrdersByCompleteStatus()
    {
        $implode = array();

        $order_statuses = $this->config->get('config_complete_status');

        foreach ($order_statuses as $order_status_id) {
            $implode[] = "order_status_id = '" . (int) $order_status_id . "'";
        }

        if ($implode) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE " . implode(" OR ", $implode) . "");

            return $query->row['total'];
        } else {
            return 0;
        }
    }

    /**
     * Метод для получения истории смены статусов
     * 
     * @param int $order_id
     * @param int $start
     * @param int $limit
     * 
     * @return array
     */
    public function getOrderHistories($order_id, $start = 0, $limit = 10)
    {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT oh.date_added, os.name AS status, oh.comment FROM " . DB_PREFIX . "order_history oh "
                . "INNER JOIN " . DB_PREFIX . "order_status os ON (oh.order_status_id = os.order_status_id) "
                . "WHERE oh.order_id = '" . (int) $order_id . "' "
                . "ORDER BY oh.date_added ASC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    /**
     * Метод для получения кол-ва записей в истории смены статусов
     * 
     * @param int $order_id
     * 
     * @return int
     */
    public function getTotalOrderHistories($order_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_history WHERE order_id = '" . (int) $order_id . "'");

        return $query->row['total'];
    }
}
