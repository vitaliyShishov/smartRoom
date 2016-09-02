<?php

class ModelCatalogProductParameter extends Model
{
    /**
     * Добавление нового параметра продукта
     *
     * @param array $data
     *
     * @return string
     */
    public function addParameter($data)
    {
        $name_param     = $data['parameter_name'];
        $new_name_param = strtolower($this->translit->getTranslit($name_param));

        $is_in_category = isset($data['parameter_in_category']) ? 1 : 0;
        $sort           = isset($data['parameter_sort_order']) ? $data['parameter_sort_order'] : 0;

        $this->db->query("INSERT INTO `" . DB_PREFIX . "param` "
            . "SET name = '" . $this->db->escape($data['parameter_name']) . "', "
            . "param_id = '" . $this->db->escape($new_name_param) . "', "
            . "sort_order = '" . (int) $sort . "', "
            . "is_in_category = '" . (int) $is_in_category . "'");

        if(isset($data['parameter_category'])) {
            foreach ($data['parameter_category'] as $category) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "param_to_category` SET
                param_id = '" . $this->db->escape($new_name_param) . "',
                category_id = '" . (int)$category['category_id'] . "'");
            }
        }

        if(isset($data['parameter_value'])) {
            foreach ($data['parameter_value'] as $parameter_value) {
                if (!empty($parameter_value['value'])) {
                    $name     = str_replace(' ', '-', $parameter_value['value']);
                    $new_name = $new_name_param . '-' . strtolower($this->translit->getTranslit($name));

                    $this->db->query("INSERT INTO `" . DB_PREFIX . "param_value` SET param_value_id = '" . $this->db->escape($new_name) .
                        "', value = '" . $this->db->escape($parameter_value['value']) . "', param_id = '" . $this->db->escape($new_name_param) . "'");
                }
            }
        }

        if(isset($data['filters'])) {
            foreach ($data['filters'] as $filter) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "param_filters SET
                param_id = '" . $this->db->escape($new_name_param) . "', 
                title = '" . $this->db->escape($filter['title']) . "', 
                min_value = '" . $this->db->escape($filter['min']) . "', 
                max_value = '" . $this->db->escape($filter['max']) . "'");
            }
        }

        return $new_name_param;
    }

    public function editParameter($param_id, $data)
    {
        $param_filters = array();
        $old_param_id  = $param_id;
        $new_param_id  = strtolower($this->translit->getTranslit($data['parameter_name']));
        
        $param_filters['old_parameter_id'] = $old_param_id;
        $param_filters['new_parameter_id'] = $new_param_id;

        $this->db->query("DELETE FROM " . DB_PREFIX . "param_to_category "
            . "WHERE param_id = '" . $this->db->escape($old_param_id) . "'");

        $is_in_category = isset($data['parameter_in_category']) ? 1 : 0;
        $sort           = isset($data['parameter_sort_order']) ? $data['parameter_sort_order'] : 0;

        $this->db->query("UPDATE " . DB_PREFIX . "param SET "
            . "name = '" . $this->db->escape($data['parameter_name']) . "', "
            . "title = '" . $this->db->escape($data['parameter_title']) . "', "
            . "sort_order = '" . (int) $sort . "', "
            . "param_id = '" . $this->db->escape($new_param_id) . "', "
            . "is_in_category = '" . (int) $is_in_category . "' "
            . "WHERE param_id = '" . $this->db->escape($old_param_id) . "'");

        if (isset($data['parameter_category'])) {
            foreach ($data['parameter_category'] as $key => $category) {
                if (isset($category['category_id'])) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "param_to_category "
                        . "SET param_id = '" . $this->db->escape($new_param_id) . "', "
                        . "category_id = '" . (int) $category['category_id'] . "'");
                }
                if (isset($category['old_category_id']) && (!isset($category['category_id'])  ||  $category['old_category_id'] !== $category['category_id'])) {
                    $param_filters['category_id'][] = $category['old_category_id'];
                }
            }
        }
        
        if (isset($data['parameter_value'])) {
            foreach ($data['parameter_value'] as $parameter_value) {
                if (isset($parameter_value['old_value']) && isset($parameter_value['value']) && $parameter_value['old_value'] == $parameter_value['value']) {
                    $old_parameter_value_id = $old_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['value']));
                    $new_parameter_value_id = $new_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['value']));
                } else if (isset($parameter_value['old_value']) && isset($parameter_value['value'])) {
                    $old_parameter_value_id = $old_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['old_value']));
                    $new_parameter_value_id = $new_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['value']));
                } else if (!isset($parameter_value['value'])){
                    $old_parameter_value_id = $old_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['old_value']));
                } else {
                    $new_parameter_value_id = $new_param_id . '-' . strtolower($this->translit->getTranslit($parameter_value['value']));
                }

                if (!isset($old_parameter_value_id) && isset($new_parameter_value_id)) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "param_value SET "
                        . "param_value_id = '" . $this->db->escape($new_parameter_value_id) . "', "
                        . "value = '" . $this->db->escape($parameter_value['value']) . "', "
                        . "param_id = '" . $this->db->escape($new_param_id) . "'");
                } else if (isset($old_parameter_value_id) && !isset($new_parameter_value_id)) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "param_value "
                        . "WHERE param_value_id = '" . $this->db->escape($old_parameter_value_id) . "'");
                    $this->db->query("DELETE FROM " . DB_PREFIX . "param_value_to_product "
                        . "WHERE param_value_id = '" . $this->db->escape($old_parameter_value_id) . "'");
                    $param_filters['parameter_value_id'][] = array(
                        'old_parameter_value_id' => $old_parameter_value_id,
                    );
                } else if ($old_parameter_value_id !== $new_parameter_value_id) {
                    $this->db->query("UPDATE " . DB_PREFIX . "param_value SET "
                        . "param_value_id = '" . $this->db->escape($new_parameter_value_id) . "', "
                        . "value = '" . $this->db->escape($parameter_value['value']) . "', "
                        . "param_id = '" . $this->db->escape($new_param_id) . "' "
                        . "WHERE param_value_id = '" . $this->db->escape($old_parameter_value_id) . "'");
                    $this->db->query("UPDATE " . DB_PREFIX . "param_value_to_product SET "
                        . "param_value_id = '" . $this->db->escape($new_parameter_value_id) . "' "
                        . "WHERE param_value_id = '" . $this->db->escape($old_parameter_value_id) . "'");
                    $param_filters['parameter_value_id'][] = array(
                        'old_parameter_value_id' => $old_parameter_value_id,
                        'new_parameter_value_id' => $new_parameter_value_id
                    );
                }
                if (isset($old_parameter_value_id)) {
                    unset($old_parameter_value_id);
                }
                if (isset($new_parameter_value_id)) {
                    unset($new_parameter_value_id);
                }
            }
        }

        if(isset($data['filters'])) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "param_filters WHERE param_id = '" . $this->db->escape($old_param_id) . "'");

            foreach ($data['filters'] as $filter) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "param_filters SET
                param_id = '" . $this->db->escape($new_param_id) . "', 
                title = '" . $this->db->escape($filter['title']) . "', 
                min_value = '" . $this->db->escape($filter['min']) . "', 
                max_value = '" . $this->db->escape($filter['max']) . "'");
            }
        }

        return $param_filters;
    }

    /**
     * Удаление существующего параметра продукта
     *
     * @param string $param_id
     */
    public function deleteParameter($param_id)
    {
        $this->event->trigger('pre.admin.product_parameter.delete', $param_id);

        $exist_param_values = $this->db->query("SELECT param_value_id FROM " . DB_PREFIX . "param_value
        WHERE param_id = '" . $this->db->escape($param_id) . "'");

        foreach($exist_param_values->rows as $param_value){
            $this->db->query("DELETE FROM " . DB_PREFIX . "param_value_to_product
                WHERE param_value_id = '" . $this->db->escape($param_value['param_value_id']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "param_value WHERE param_id = '" . $this->db->escape($param_id) . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "param_to_category WHERE param_id = '" . $this->db->escape($param_id) . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "param WHERE param_id = '" . $this->db->escape($param_id) . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "param_filters WHERE param_id = '" . $this->db->escape($param_id) . "'");

        $this->event->trigger('post.admin.product_parameters.delete', $param_id);
    }

    /**
     * Выбор данных о параметре продукта
     *
     * @param string $param_id
     *
     * @return array
     */
    public function getParameter($param_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param p
                 LEFT JOIN " . DB_PREFIX . "param_value pv ON (p.param_id = pv.param_id)
                 WHERE p.param_id = '" . $this->db->escape($param_id) . "'");

        return $query->row;
    }


    /**
     * Выбор возможных параметров для продукта, соответственно категориям
     *
     * @param int $product_id
     *
     * @return array
     */
    public function getParametersForProduct($product_id)
    {
        $query = $this->db->query("SELECT DISTINCT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");

        $result = $query->rows;

        $category_array = array();

        foreach ($result as $res) {
            $category_array[] = "'" . $res['category_id'] . "'";
        }

        $category_id_string = implode(",", $category_array);

        $result = array();

        if ($category_id_string) {
            $param_to_category_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param_to_category pc
                    INNER JOIN " . DB_PREFIX . "param p ON (p.param_id = pc.param_id)
                    WHERE category_id IN (" . $category_id_string . ")");

            $result = $param_to_category_query->rows;
        }

        return $result;
    }

    /**
     * Выбор списка возможных параметров продукта, или выбор списка параметров продукта по фильтру
     *
     * @param array $data
     *
     * @return array
     */
    public function getParameters($data = array())
    {

        $sql = "SELECT GROUP_CONCAT(DISTINCT cd.name) as categoryName,
                p.param_id,
                p.sort_order,
                p.name as paramName
                FROM " . DB_PREFIX . "param p
                LEFT JOIN " . DB_PREFIX . "param_value pv ON (p.param_id = pv.param_id)
                LEFT JOIN " . DB_PREFIX . "param_to_category pc ON (pc.param_id = p.param_id)
                LEFT JOIN " . DB_PREFIX . "category c ON (pc.category_id = c.category_id)
                LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)";


        if (!empty($data['filter_category']) && !empty($data['filter_name'])) {
            $sql .= " WHERE p.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
            $sql .= " AND cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
        } elseif (!empty($data['filter_category']) && empty($data['filter_name'])) {
            $sql .= " WHERE cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
        } elseif (empty($data['filter_category']) && !empty($data['filter_name'])) {
            $sql .= " WHERE p.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sql .= " GROUP BY p.param_id";

        $sort_data = array(
            'p.name',
            'cd.name',
            'p.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY paramName";
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
     * Выбор списка возможных категорий для параметров продукта
     *
     * @param string $param_id
     *
     * @return type
     */
    public function getParameterCategories($param_id)
    {

        $query = $this->db->query("SELECT DISTINCT cd.name, pc.category_id
                FROM " . DB_PREFIX . "param_to_category pc
                LEFT JOIN " . DB_PREFIX . "category_description cd ON (pc.category_id = cd.category_id)
                WHERE pc.param_id = '" . $this->db->escape($param_id) . "'");

        return $query->rows;
    }

    /**
     * Выбор всех значений параметра
     *
     * @param string $param_id
     *
     * @return array
     */
    public function getParameterValues($param_id)
    {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "param_value` WHERE param_id = '" . $this->db->escape($param_id) . "'");
        return $query->rows;
    }

    /**
     * Выбор всех значений для всех параметров продукта
     *
     * @param int $product_id
     *
     * @return array
     */
    public function getProductParametersValues($product_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param_value_to_product WHERE product_id = '" . (int) $product_id . "'");

        return $query->rows;
    }

    /**
     * Выбор колличества всех параметров
     *
     * @return string
     */
    public function getTotalParameters()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "param`");

        return $query->row['total'];
    }
    
    /**
     * Метод, возвращающий имена всех параметров
     * 
     * @return array
     */
    public function getAllParametersNames() {
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "param");
        
        return $query->rows;
    }

    public function getParameterFilters($param_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param_filters 
                WHERE param_id = '" . $this->db->escape($param_id) . "'");

        return $query->rows;
    }
}
