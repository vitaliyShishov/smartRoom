<?php

/**
 * Класс модели для работы с сущностью order_status
 */
class ModelLocalisationOrderStatus extends Model
{

    /**
     * Метод для добавления нового статуса
     * 
     * @param array $data
     */
    public function addOrderStatus($data)
    {
        foreach ($data['order_status'] as $language_id => $value) {
            if (isset($order_status_id)) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "order_status "
                        . "SET order_status_id = '" . (int) $order_status_id . "', "
                        . "language_id = '" . (int) $language_id . "', "
                        . "name = '" . $this->db->escape($value['name']) . "', "
                        . "sort_order = '" . (int) $value['sort_order'] . "'");
            } else {
                $this->db->query("INSERT INTO " . DB_PREFIX . "order_status SET "
                        . "language_id = '" . (int) $language_id . "', "
                        . "name = '" . $this->db->escape($value['name']) . "', "
                        . "sort_order = '" . (int) $value['sort_order'] . "'");

                $order_status_id = $this->db->getLastId();
            }
        }

        $this->cache->delete('order_status');
    }

    /**
     * Метод для редатирования статуса
     * 
     * @param int $order_status_id
     * @param array $data
     */
    public function editOrderStatus($order_status_id, $data)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int) $order_status_id . "'");

        foreach ($data['order_status'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "order_status SET "
                    . "order_status_id = '" . (int) $order_status_id . "', "
                    . "language_id = '" . (int) $language_id . "', "
                    . "name = '" . $this->db->escape($value['name']) . "', "
                    . "sort_order = '" . (int) $value['sort_order'] . "'");
        }

        $this->cache->delete('order_status');
    }

    /**
     * Метод для удаления статуса
     * 
     * @param int $order_status_id
     */
    public function deleteOrderStatus($order_status_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int) $order_status_id . "'");

        $this->cache->delete('order_status');
    }

    /**
     * Метод для получения статуса по id
     * 
     * @param id $order_status_id
     * 
     * @return string
     */
    public function getOrderStatus($order_status_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int) $order_status_id . "' AND language_id = '" . (int) $this->config->get('config_language_id') . "'");

        return $query->row;
    }

    /**
     * Метод для получения всех статусов
     * 
     * @param array $data
     * 
     * @return array
     */
    public function getOrderStatuses($data = array())
    {
        if ($data) {

            $sql = "SELECT * FROM " . DB_PREFIX . "order_status "
                    . "WHERE language_id = '" . (int) $this->config->get('config_language_id') . "'";

            $sql .= " ORDER BY " . $this->db->escape($data['sort']) . "";

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
        } else {
            $order_status_data = $this->cache->get('order_status.' . (int) $this->config->get('config_language_id'));

            if (!$order_status_data) {
                $query = $this->db->query("SELECT order_status_id, name "
                        . "FROM " . DB_PREFIX . "order_status "
                        . "WHERE language_id = '" . (int) $this->config->get('config_language_id') . "' "
                        . "ORDER BY name");

                $order_status_data = $query->rows;

                $this->cache->set('order_status.' . (int) $this->config->get('config_language_id'), $order_status_data);
            }

            return $order_status_data;
        }
    }

    /**
     * Метод для получения описания статуса
     * 
     * @param int $order_status_id
     * 
     * @return array
     */
    public function getOrderStatusDescriptions($order_status_id)
    {
        $order_status_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int) $order_status_id . "'");

        foreach ($query->rows as $result) {
            $order_status_data[$result['language_id']] = array('name' => $result['name'], 'sort_order' => $result['sort_order']);
        }

        return $order_status_data;
    }

    /**
     * Метод для получения кол-ва статусов
     * 
     * @return int
     */
    public function getTotalOrderStatuses()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_status WHERE language_id = '" . (int) $this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }

}
