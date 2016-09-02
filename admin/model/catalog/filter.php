<?php
class ModelCatalogFilter extends Model
{

    /**
     * Метод добавления фильтра
     * 
     * @param array $data
     * @return int
     */
    public function addFilter($data)
    {
        $param_array = array();

        $this->db->query("INSERT INTO `" . DB_PREFIX . "filter` "
            . "SET category_id = '" . (int) $data['filter_category'] . "', "
            . "param_values = '" . $this->db->escape(serialize($data['filter_param'])) . "'");

        $filter_id = $this->db->getLastId();
        
        if (isset($data['filter_description'])) {
            foreach ($data['filter_description'] as $language_id => $value) {
                if (isset($value['description']) && $value['description'] && !strip_tags(html_entity_decode($value['description']))) {
                    $value['description'] = null;
                }
                $this->db->query("INSERT INTO " . DB_PREFIX . "filter_description "
                    . "SET filter_id = '" . (int) $filter_id . "', "
                    . "name = '" . $this->db->escape($value['name']) . "', "
                    . "language_id = '" . (int) $language_id . "', "
                    . "h1 = '" . $this->db->escape($value['h1']) . "', "
                    . "description = '" . $this->db->escape($value['description']) . "', "
                    . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                    . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                    . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
            }
        }

        if (isset($data['keyword']) && !empty($data['keyword'])) {
            foreach ($data['keyword'] as $keyword) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias "
                    . "SET query = 'filter_id=" . (int) $filter_id . "', "
                    . "keyword = '" . $this->db->escape($keyword) . "'");
            }
        }

        return $filter_id;
    }

    /**
     * Метод редактирования фильтра
     * 
     * @param int $filter_id
     * @param array $data
     */
    public function editFilter($filter_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "filter "
            . "SET is_popular = '" . (isset($data['is_popular']) ? (int) $data['is_popular'] : 0) . "', "
            . "is_index = '" . (isset($data['is_index']) ? (int) $data['is_index'] : 0) . "' "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_description "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        foreach ($data['filter_description'] as $language_id => $value) {
            if (isset($value['description']) && $value['description'] && !strip_tags(html_entity_decode($value['description']))) {
                $value['description'] = null;
            }
            $this->db->query("INSERT INTO " . DB_PREFIX . "filter_description "
                . "SET filter_id = '" . (int) $filter_id . "', "
                . "name = '" . $this->db->escape($value['name']) . "', "
                . "language_id = '" . (int) $language_id . "', "
                . "h1 = '" . $this->db->escape($value['h1']) . "', "
                . "description = '" . $this->db->escape($value['description']) . "', "
                . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }
    }

    /**
     * Метод получения списка фильтров
     * 
     * @param array $data
     * @return array
     */
    public function getFilters($data = array())
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . "filter` f "
            . "INNER JOIN " . DB_PREFIX . "filter_description fd "
            . "ON (f.filter_id = fd.filter_id) "
            . "INNER JOIN " . DB_PREFIX . "category_description cd "
            . "ON (f.category_id = cd.category_id) "
            . "LEFT JOIN " . DB_PREFIX . "url_alias ua "
            . "ON (CONCAT_WS('=', 'filter_id', f.filter_id) = ua.query) "
            . "WHERE fd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (isset($data['filter_url_alias']) && $data['filter_url_alias']) {
            $sql .= " AND ua.keyword LIKE '%" . $this->db->escape($data['filter_url_alias']) . "%'";
        }

        if (isset($data['filter_category']) && $data['filter_category']) {
            $sql .= " AND cd.name LIKE '%" . $this->db->escape($data['filter_category']) . "%'";
        }

        if (isset($data['filter_param_value']) && $data['filter_param_value']) {
            $sql .= " AND f.param_values LIKE '%" . $this->db->escape(strtolower($this->translit->getTranslit(str_replace(' ', '_', $data['filter_param_value'])))) . "%'";
        }

        $sql .= " GROUP BY f.filter_id";

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
     * Метод получения seo_url
     * 
     * @param int $filter_id
     * 
     * @return string
     */
    public function getFilterUrlAlias($filter_id)
    {
        $query = $this->db->query("SELECT MIN(url_alias_id) as url_alias_id, query, keyword FROM " . DB_PREFIX . "url_alias "
                . "WHERE query = 'filter_id=" . (int) $filter_id . "'")->row;
        if (isset($query['keyword'])) {
            return $query['keyword'];
        } else {
            return false;
        }
    }

    /**
     * Метод получения значений параметров
     * 
     * @param array $param_values
     * @return array
     */
    public function getFilterParamValues($param_values)
    {
        $value = array();

        foreach ($param_values as $param_value) {
            foreach ($param_value as $param_id => $param_value_id) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "param_value "
                        . "WHERE param_value_id = '" . $this->db->escape($param_value_id) . "'")->row;
                if (isset($query['value'])) {
                    $value[$param_value_id] = array(
                        'param_value_name' => $query['value'],
                        'param_name' => $this->getParamName($param_id)
                    );
                        
                }
            }
        }
        return $value;
    }

    public function getParams($category_id)
    {
        $params = $this->db->query("SELECT * FROM " . DB_PREFIX . "param p "
                . "INNER JOIN param_to_category p2c "
                . "ON p.param_id = p2c.param_id "
                . "WHERE p2c.category_id = '" . (int) $category_id . "'")->rows;

        $param_values = array();

        if ($params) {
            foreach ($params as $param) {
                $param_values[$param['param_id']] = array(
                    'param_id'   => $param['param_id'],
                    'name'   => $param['name'],
                    'values' => $this->db->query("SELECT * FROM " . DB_PREFIX . "param_value "
                        . "WHERE param_id = '" . $this->db->escape($param['param_id']) . "'")->rows);
            }
        }

        return $param_values;
    }

    /**
     * Метод получения описания фильтра
     * 
     * @param int $filter_id
     * @return array
     */
    public function getFilterDescription($filter_id)
    {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_description "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        foreach ($query->rows as $result) {
            $filter_data[$result['language_id']] = $result;
        }

        return $filter_data;
    }

    /**
     * Метод получения фильтра
     * 
     * @param int $filter_id
     * @return array
     */
    public function getFilter($filter_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter f "
            . "INNER JOIN category_description cd "
            . "ON f.category_id = cd.category_id "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        return $query->row;
    }

    /**
     * Метод получения количества фильтров
     * 
     * @param array $data
     * @return int
     */
    public function getTotalFilters($data = array())
    {
        $sql = "SELECT COUNT(DISTINCT f.filter_id) AS total FROM `" . DB_PREFIX . "filter` f "
            . "INNER JOIN " . DB_PREFIX . "filter_description fd "
            . "ON (f.filter_id = fd.filter_id) "
            . "INNER JOIN " . DB_PREFIX . "category_description cd "
            . "ON (f.category_id = cd.category_id) "
            . "LEFT JOIN " . DB_PREFIX . "url_alias ua "
            . "ON (CONCAT_WS('=', 'filter_id', f.filter_id) = ua.query) "
            . "WHERE fd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (isset($data['filter_url_alias']) && $data['filter_url_alias']) {
            $sql .= " AND ua.keyword LIKE '%" . $this->db->escape($data['filter_url_alias']) . "%'";
        }

        if (isset($data['filter_category']) && $data['filter_category']) {
            $sql .= " AND cd.name LIKE '%" . $this->db->escape($data['filter_category']) . "%'";
        }

        if (isset($data['filter_param_value']) && $data['filter_param_value']) {
            $sql .= " AND f.param_values LIKE '%" . $this->db->escape(strtolower($this->translit->getTranslit(str_replace(' ', '_', $data['filter_param_value'])))) . "%'";
        }
        
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    /**
     * Метод получения значения параметра
     * 
     * @param string $param_value_id
     * 
     * @return string
     */
    public function getParamValueName($param_value_id)
    {
        $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "param_value "
            . "WHERE param_value_id = '" . $this->db->escape($param_value_id) . "'");
        if (isset($query->row['value'])) {
            return $query->row['value'];
        } else {
            return '';
        }
    }
    /**
     * Метод получения значения параметра
     * 
     * @param string $param_value_id
     * 
     * @return string
     */
    public function getParamName($param_id)
    {
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "param "
            . "WHERE param_id = '" . $this->db->escape($param_id) . "'");
        if (isset($query->row['name'])) {
            return $query->row['name'];
        } else {
            return '';
        }
    }
    
    /**
     * Метод категорий с параметрами.
     * 
     * @return array
     */
    public function getCategoriesWithParam()
    {
        $query = $this->db->query("SELECT c.category_id FROM " . DB_PREFIX . "category c "
            . "LEFT JOIN " . DB_PREFIX . "param_to_category p2c "
            . "ON p2c.category_id = c.category_id "
            . "WHERE p2c.param_id IS NOT NULL "
            . "GROUP BY c.category_id");
        return $query->rows;
    }
    
    /**
     * Метод категорий с параметрами.
     * 
     * @param int $category_id
     * 
     * @return array
     */
    public function getParamForCategory($category_id)
    {
        $query = $this->db->query("SELECT p.param_id, pv.param_value_id "
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
     * Метод добавления новых комбинаций фильтров
     * 
     * @param array $filter_param
     * @param int $category_id
     */
    public function addNewFilter($filter_param, $category_id)
    {
        $i = 0;
        $filter_array = array();
        foreach ($filter_param as $params) {
            foreach ($params as $param_id => $param_value_id) {
                if (!$param_value_id) {
                    $i++;
                }
                $filter_array[][$param_id] = $param_value_id;
            }
        }
        
        if (count($filter_array) > $i) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter "
                    . "WHERE category_id = '" . (int) $category_id . "' "
                    . "AND param_values = '" . $this->db->escape(serialize($filter_array)) . "'");
            
            if (!$query->num_rows) {
                $data['filter_category'] = $category_id;
                $data['filter_param']    = $filter_param;
                $data['is_popular']      = 0;

                $data['filter_description'][$this->config->get('config_language_id')] = array(
                    'h1'               => '',
                    'name'             => '',
                    'description'      => '',
                    'meta_title'       => '',
                    'meta_description' => '',
                    'meta_keyword'     => ''
                );
                
                $data['keyword'] = $this->generateUrlAlias($filter_param);

                $this->addFilter($data);
            } 
        }
    }
    
    /**
     * Метод добавления новых комбинаций фильтров
     * 
     * @param array $filter_param
     */
    public function generateUrlAlias($filter_param)
    {
        $filter_array = array();
        foreach ($filter_param as $params) {
            foreach ($params as $param) {
                if ($param) {
                    $filter_array[] = $param;
                }
            }
        }

        $fac = $this->fac(count($filter_array));

        $varianty = array();
        while (count($varianty) != $fac) {
            shuffle($filter_array);
            if (!in_array($filter_array, $varianty)) {
                $varianty[] = $filter_array;
            }
        }
        
        foreach ($varianty as $values) {
            $url = '';
            foreach ($values as $key => $value) {
                if ($key == 0) {
                    $url = $value;
                } else {
                    $url = $url . '/' . $value;
                }
            }
            $url_array[] = $url;
        }
        return $url_array;
    }
    
    /**
     * Метод расчета факториала
     * 
     * @param int $n
     * 
     * @return int
     */
    public function fac($n)
    {
        if ($n == 1) {
            return $n;
        } else {
            return $n * $this->fac($n - 1);
        }
    }
    
    /**
     * Метод получения фильтров по категори и параметру
     * 
     * @param int $category_id
     * @param string $param
     * 
     * @return array
     */
    public function getFiltersByCategoryAndParam($category_id, $param)
    {
        $query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "filter "
            . "WHERE category_id = '" . (int) $category_id . "' "
            . "AND param_values LIKE '%" . $this->db->escape($param) . "%'");

        return $query->rows;
    }

    /**
     * Метод получения фильтров по значнеию параметра
     * 
     * @param string $param_value
     * 
     * @return array
     */
    public function getFiltersByParamValue($param_value)
    {
        $query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "filter "
            . "WHERE param_values LIKE '%" . $this->db->escape($param_value) . "%'");

        return $query->rows;
    }

    /**
     * Метод редактирования параметров в фильтре
     * 
     * @param int $filter_id
     * @param string $old_parameter_value_id
     * @param string $new_parameter_value_id
     * @param string $old_parameter_id
     * @param string $new_parameter_id
     */
    public function editFilterParamValue($filter_id, $old_parameter_value_id, $new_parameter_value_id, $old_parameter_id, $new_parameter_id)
    {
        $url_alias = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'filter_id=" . (int) $filter_id . "'");

        foreach ($url_alias->rows as $url) {
            $new_keyword = str_replace($old_parameter_value_id, $new_parameter_value_id, $url['keyword']);
            $this->db->query("UPDATE " . DB_PREFIX . "url_alias SET "
                . "keyword = '" . $this->db->escape($new_keyword) . "' "
                . "WHERE query = '" . $this->db->escape($url['query']) . "' "
                . "AND keyword = '" . $this->db->escape($url['keyword']) . "'");
        }

        $filter = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter "
                . "WHERE filter_id = '" . (int) $filter_id . "'")->row;

        foreach (unserialize($filter['param_values']) as $values) {
            foreach ($values as $key => $value) {
                if ($key == $old_parameter_id) {
                    $new_key = $new_parameter_id;
                } else {
                    $new_key = $key;
                }
                if ($value == $old_parameter_value_id) {
                    $new_value = $new_parameter_value_id;
                } else {
                    $new_value = $value;
                }
                $new_param_values[] = array(
                    $new_key => $new_value);
            }
        }

        $this->db->query("UPDATE " . DB_PREFIX . "filter SET "
            . "param_values = '" . $this->db->escape(serialize($new_param_values)) . "' "
            . "WHERE filter_id = '" . (int) $filter_id . "'");
    }

    /**
     * Метод удаления фильра
     * 
     * @param int $filter_id
     */
    public function deleteFilter($filter_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_description "
            . "WHERE filter_id = '" . (int) $filter_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'filter_id=" . (int) $filter_id . "'");
    }
}