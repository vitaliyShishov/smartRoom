<?php

class ModelCatalogCategory extends Model
{

    public function addCategory($data)
    {

        $this->event->trigger('pre.admin.category.add', $data);

        $find_me = '/%/';

        $this->db->query("INSERT INTO " . DB_PREFIX . "category"
                . " SET parent_id = '" . (int) $data['parent_id'] . "', "
                . "sort_order = '" . (int) $data['sort_order'] . "', "
                . "image = '" . $this->db->escape($data['sort_order']) . "', "
                . "status = '" . (int) $data['status'] . "', "
                . "date_modified = NOW(), date_added = NOW()");

        $category_id = $this->db->getLastId();

        $title = '';

        foreach ($data['category_description'] as $language_id => $value) {
            $temp_description = strip_tags(html_entity_decode($value['description']));
            
            if ($temp_description) {
                $description = $value['description'];
            } else {
                $description = NULL;
            }
            
            $this->db->query("INSERT INTO " . DB_PREFIX . "category_description "
                . "SET category_id = '" . (int) $category_id . "', "
                . "language_id = '" . (int) $language_id . "', "
                . "name = '" . $this->db->escape($value['name']) . "', "
                . "description = '" . $this->db->escape($description) . "', "
                . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");

            $title = $value['name'];
        }

        // MySQL Hierarchical Data Closure Table Pattern
        $level = 0;

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $data['parent_id'] . "' ORDER BY `level` ASC");

        foreach ($query->rows as $result) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int) $category_id . "', `path_id` = '" . (int) $result['path_id'] . "', `level` = '" . (int) $level . "'");

            $level++;
        }

        $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int) $category_id . "', `path_id` = '" . (int) $category_id . "', `level` = '" . (int) $level . "'");

        if (isset($data['category_store'])) {
            foreach ($data['category_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int) $category_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        // Set which layout to use with this category
        if (isset($data['category_layout'])) {
            foreach ($data['category_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int) $category_id . "', store_id = '" . (int) $store_id . "', layout_id = '" . (int) $layout_id . "'");
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

        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int) $category_id . "', keyword = '" . $this->db->escape($keyword) . "'");

        $this->cache->delete('category');

        $this->event->trigger('post.admin.category.add', $category_id);

        return $category_id;
    }

    public function editCategory($category_id, $data)
    {
        $this->event->trigger('pre.admin.category.edit', $data);

        $find_me = '/%/';
  
        $this->db->query("UPDATE " . DB_PREFIX . "category SET "
                . "parent_id = '" . (int) $data['parent_id'] . "', "
                . "sort_order = '" . (int) $data['sort_order'] . "', "
                . "image = '" . $this->db->escape($data['image']) . "', "
                . "status = '" . (int) $data['status'] . "', "
                . "date_modified = NOW() "
                . "WHERE category_id = '" . (int) $category_id . "'");

        $title = '';
        
        if (isset($data['category_description']) && !empty($data['category_description'])) {
            foreach ($data['category_description'] as $language_id => $value) {
                $temp_description = strip_tags(html_entity_decode($value['description']));

                if ($temp_description) {
                    $description = $value['description'];
                } else {
                    $description = NULL;
                }

                $this->db->query("UPDATE " . DB_PREFIX . "category_description SET "
                        . "language_id = '" . (int) $language_id . "', "
                        . "name = '" . $this->db->escape($value['name']) . "', "
                        . "description = '" . $this->db->escape($description) . "', "
                        . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                        . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                        . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "' "
                        . "WHERE category_id = '" . (int) $category_id . "'");

                $title = $value['name'];
            }
        }

        // MySQL Hierarchical Data Closure Table Pattern
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE path_id = '" . (int) $category_id . "' ORDER BY level ASC");

        if ($query->rows) {
            foreach ($query->rows as $category_path) {
                // Delete the path below the current one
                $this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $category_path['category_id'] . "' AND level < '" . (int) $category_path['level'] . "'");

                $path = array();

                // Get the nodes new parents
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $data['parent_id'] . "' ORDER BY level ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Get whats left of the nodes current path
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $category_path['category_id'] . "' ORDER BY level ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Combine the paths with a new level
                $level = 0;

                foreach ($path as $path_id) {
                    $this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category_path['category_id'] . "', `path_id` = '" . (int) $path_id . "', level = '" . (int) $level . "'");

                    $level++;
                }
            }
        } else {
            // Delete the path below the current one
            $this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $category_id . "'");

            // Fix for records with no paths
            $level = 0;

            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $data['parent_id'] . "' ORDER BY level ASC");

            foreach ($query->rows as $result) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category_id . "', `path_id` = '" . (int) $result['path_id'] . "', level = '" . (int) $level . "'");

                $level++;
            }

            $this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category_id . "', `path_id` = '" . (int) $category_id . "', level = '" . (int) $level . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int) $category_id . "'");

        if (isset($data['category_store'])) {
            foreach ($data['category_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int) $category_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int) $category_id . "'");

        if (isset($data['category_layout'])) {
            foreach ($data['category_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int) $category_id . "', store_id = '" . (int) $store_id . "', layout_id = '" . (int) $layout_id . "'");
            }
        }

        $exist_keyword_result = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'category_id=" . (int) $category_id . "'")->row;

        if(isset($exist_keyword_result)){
            $exist_keyword = $exist_keyword_result['keyword'];
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int) $category_id . "'");

        if(isset($data['keyword']) && $data['keyword'] && $exist_keyword != $data['keyword']){
            $keyword = $data['keyword'];
        } else {
            $keyword = strtolower($this->translit->getTranslit($title));
        }

        $repeatStatus = $this->translit->checkRepeatUrlKeyword($keyword);

        if($repeatStatus){
            $keyword = $keyword . "_1";
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int) $category_id . "', keyword = '" . $this->db->escape($keyword) . "'");


        $this->cache->delete('category');

        $this->event->trigger('post.admin.category.edit', $category_id);
    }

    public function deleteCategory($category_id)
    {
        $this->event->trigger('pre.admin.category.delete', $category_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "category_path WHERE category_id = '" . (int) $category_id . "'");

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_path WHERE path_id = '" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $this->deleteCategory($result['category_id']);
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "category WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int) $category_id . "'");

        $this->cache->delete('category');

        $this->event->trigger('post.admin.category.delete', $category_id);
    }

    public function repairCategories($parent_id = 0)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int) $parent_id . "'");

        foreach ($query->rows as $category) {
            // Delete the path below the current one
            $this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $category['category_id'] . "'");

            // Fix for records with no paths
            $level = 0;

            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $parent_id . "' ORDER BY level ASC");

            foreach ($query->rows as $result) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category['category_id'] . "', `path_id` = '" . (int) $result['path_id'] . "', level = '" . (int) $level . "'");

                $level++;
            }

            $this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category['category_id'] . "', `path_id` = '" . (int) $category['category_id'] . "', level = '" . (int) $level . "'");

            $this->repairCategories($category['category_id']);
        }
    }

    public function getCategory($category_id)
    {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int) $this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int) $category_id . "') AS keyword FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int) $category_id . "' AND cd2.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getCategories($data = array())
    {
        $sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, cd2.name as short_name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int) $this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sql .= " GROUP BY cp.category_id";

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY sort_order";
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

    public function getCategoryDescriptions($category_id)
    {
        $category_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $category_description_data[$result['language_id']] = array(
                'name'             => $result['name'],
                'meta_title'       => $result['meta_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword'     => $result['meta_keyword'],
                'description'      => $result['description']
            );
        }

        return $category_description_data;
    }

    public function getCategoryStores($category_id)
    {
        $category_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $category_store_data[] = $result['store_id'];
        }

        return $category_store_data;
    }

    public function getCategoryLayouts($category_id)
    {
        $category_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $category_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $category_layout_data;
    }

    public function getTotalCategories()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category");

        return $query->row['total'];
    }

    public function getTotalCategoriesByLayoutId($layout_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_to_layout WHERE layout_id = '" . (int) $layout_id . "'");

        return $query->row['total'];
    }

    /**
     * Метод для вывода всех комплектов продуктов, для выбранной категории
     *
     * @param int $category_id
     *
     * @return array
     */
    public function getCategoryComplect($category_id)
    {
        $product_complect = array();

        $query = $this->db->query("SELECT *, pd.name as product_name FROM " . DB_PREFIX . "product_complect pc
                    INNER JOIN " . DB_PREFIX . "product_description pd ON (pc.bonus_product_id = pd.product_id)
                    WHERE category_id = '" . (int) $category_id . "'");

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

}
