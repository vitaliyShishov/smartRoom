<?php

/**
 * Модель с запросами в БД для статей
 *
 */
class ModelCatalogInformation extends Model
{

    /**
     * Метод добавления статьи
     *
     * @param array $data
     *
     * @return int $information_id
     */
    public function addInformation($data)
    {
        $this->event->trigger('pre.admin.information.add', $data);

        if (isset($data['publish'])) {
            $publish     = (int) $data['publish'];
            $datePublish = 'NOW()';
        } else {
            $publish     = 0;
            $datePublish = 'NULL';
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "information "
            . "SET sort_order = '" . (int) $data['sort_order'] . "', "
            . "image = '" . $data['image'] . "', "
            . "is_publish = '" . (int) $publish . "', "
            . "publish_date =  " . $datePublish . "");

       
        $information_id = $this->db->getLastId();

        $title = '';
        
        foreach ($data['information_description'] as $languageId => $value) {
            if (!empty($value['tags'])) {
                $tags = $value['tags'];
            } else {
                $tags = 'NULL';
            }
            
            $temp_description = strip_tags(html_entity_decode($value['description']));
            
            if ($temp_description) {
                $description = $value['description'];
            } else {
                $description = NULL;
            }

            $this->db->query("INSERT INTO " . DB_PREFIX . "information_description "
                . "SET information_id = '" . (int) $information_id . "', "
                . "language_id = '" . (int) $languageId . "', "
                . "title = '" . $this->db->escape($value['title']) . "', "
                . "description = '" . $this->db->escape($description) . "', "
                . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");

            $title = $value['title'];
        }
        
        if (isset($data['information_store'])) {
            foreach ($data['information_store'] as $storeId) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store "
                    . "SET information_id = '" . (int) $information_id . "', store_id = '" . (int) $storeId . "'");
            }
        }

        if (isset($data['information_layout'])) {
            foreach ($data['information_layout'] as $storeId => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout "
                    . "SET information_id = '" . (int) $information_id . "', store_id = '" . (int) $storeId . "', layout_id = '" . (int) $layout_id . "'");
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

        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias "
                . "SET query = 'information_id=" . (int) $information_id . "', keyword = '" . $this->db->escape($keyword) . "'");

        $this->cache->delete('information');

        $this->event->trigger('post.admin.information.add', $information_id);

        return $information_id;
    }

    /**
     * Метод редактирования статьи
     *
     * @param int $information_id
     *
     * @param array $data
     */
    public function editInformation($information_id, $data)
    {
        $this->event->trigger('pre.admin.information.edit', $data);

        if (isset($data['publish'])) {
            $publish     = (int) $data['publish'];
            $datePublish = 'NOW()';
        } else {
            $publish     = 0;
            $datePublish = 'NULL';
        }

        if (isset($data['bottom'])) {
            $bottom = (int) $data['bottom'];
        } else {
            $bottom = 0;
        }

        if (isset($data['blog'])) {
            $blog = (int) $data['blog'];
        } else {
            $blog = 0;
        }

        if (isset($data['add_form'])) {
            $add_form = (int) $data['add_form'];
        } else {
            $add_form = 0;
        }
        
        $this->db->query("UPDATE " . DB_PREFIX . "information "
            . "SET sort_order = '" . (int) $data['sort_order'] . "', "
            . "is_bottom = '" . $bottom . "', "
            . "is_blog = '" . $blog . "', "
            . "is_add_form = '" . $add_form . "', "     
            . "image = '" . $data['image'] . "', "
            . "banner = '" . $data['banner'] . "', "
            . "is_publish = '" . $publish . "', "
            . "publish_date = " . $datePublish . " "
            . "WHERE information_id = '" . (int) $information_id . "'");
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_description "
            . "WHERE information_id = '" . (int) $information_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_product 
                WHERE information_id = '" . (int) $information_id . "'");

        $title = '';

        foreach ($data['information_description'] as $languageId => $value) {
            
            $temp_description = strip_tags(html_entity_decode($value['description']));
            
            if ($temp_description) {
                $description = $value['description'];
            } else {
                $description = NULL;
            }

            $this->db->query("INSERT INTO " . DB_PREFIX . "information_description "
                . "SET information_id = '" . (int) $information_id . "', "
                . "language_id = '" . (int) $languageId . "', "
                . "title = '" . $this->db->escape($value['title']) . "', "
                . "description = '" . $this->db->escape($description) . "', "
                . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");

            $title = $value['title'];
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store "
            . "WHERE information_id = '" . (int) $information_id . "'");

        if (isset($data['information_store'])) {
            foreach ($data['information_store'] as $storeId) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store "
                    . "SET information_id = '" . (int) $information_id . "', store_id = '" . (int) $storeId . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout "
            . "WHERE information_id = '" . (int) $information_id . "'");

        if (isset($data['information_layout'])) {
            foreach ($data['information_layout'] as $storeId => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout "
                    . "SET information_id = '" . (int) $information_id . "', store_id = '" . (int) $storeId . "', layout_id = '" . (int) $layout_id . "'");
            }
        }

        $exist_keyword_result = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'information_id=" . (int) $information_id . "'")->row;

        if(isset($exist_keyword_result)){
            $exist_keyword = $exist_keyword_result['keyword'];
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'information_id=" . (int) $information_id . "'");

        if(isset($data['keyword']) && $data['keyword'] && $exist_keyword != $data['keyword']){
            $keyword = $data['keyword'];
        } else {
            $keyword = strtolower($this->translit->getTranslit($title));
        }

        $repeatStatus = $this->translit->checkRepeatUrlKeyword($keyword);

        if($repeatStatus){
            $keyword = $keyword . "_1";
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias "
            . "SET query = 'information_id=" . (int) $information_id . "', keyword = '" . $this->db->escape($keyword) . "'");

        $this->cache->delete('information');

        $this->event->trigger('post.admin.information.edit', $information_id);
    }

    /**
     * Метод удаления статьи
     *
     * @param int $information_id
     */
    public function deleteInformation($information_id)
    {
        $this->event->trigger('pre.admin.information.delete', $information_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "information "
            . "WHERE information_id = '" . (int) $information_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_description "
            . "WHERE information_id = '" . (int) $information_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store "
            . "WHERE information_id = '" . (int) $information_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout "
            . "WHERE information_id = '" . (int) $information_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'information_id=" . (int) $information_id . "'");

        $this->cache->delete('information');

        $this->event->trigger('post.admin.information.delete', $information_id);
    }

    /**
     * Метод получения статьи
     *
     * @param int $information_id
     *
     * @return array
     */
    public function getInformation($information_id)
    {
        $query = $this->db->query("SELECT DISTINCT *, "
            . "(SELECT keyword FROM " . DB_PREFIX . "url_alias "
            . "WHERE query = 'information_id=" . (int) $information_id . "') AS keyword "
            . "FROM " . DB_PREFIX . "information WHERE information_id = '" . (int) $information_id . "'");

        return $query->row;
    }

    /**
     * Метод получения списка статей
     *
     * @param type $data
     *
     * @return array
     */
    public function getInformations($data = array())
    {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "information i "
                . "LEFT JOIN " . DB_PREFIX . "information_description id "
                . "ON i.information_id = id.information_id "
                . "WHERE id.language_id = '" . (int) $this->config->get('config_language_id') . "'";

            $sortData = array(
                'id.title',
                'i.sort_order'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sortData)) {
                $sql .= ' ORDER BY ' . $data['sort'];
            } else {
                $sql .= ' ORDER BY id.title';
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= ' LIMIT ' . (int) $data['start'] . ',' . (int) $data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $informationData = $this->cache->get('information.' . (int) $this->config->get('config_language_id'));

            if (!$informationData) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i "
                    . "LEFT JOIN " . DB_PREFIX . "information_description id "
                    . "ON (i.information_id = id.information_id) "
                    . "WHERE id.language_id = '" . (int) $this->config->get('config_language_id') . "' "
                    . "ORDER BY id.title");

                $informationData = $query->rows;

                $this->cache->set('information.' . (int) $this->config->get('config_language_id'), $informationData);
            }

            return $informationData;
        }
    }

    /**
     * Метод получения Содержания статьи
     *
     * @param int $information_id
     *
     * @return array
     */
    public function getInformationDescriptions($information_id)
    {
        $informationDescriptionData = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_description id
                WHERE id.information_id = '" . (int) $information_id . "'");

        foreach ($query->rows as $result) {
            $informationDescriptionData[$result['language_id']] = array(
                'title'             => $result['title'],
                'description'       => $result['description'],
                'meta_title'        => $result['meta_title'],
                'meta_description'  => $result['meta_description'],
                'meta_keyword'      => $result['meta_keyword'],
            );
        }

        return $informationDescriptionData;
    }

    /**
     * Метод получения магазинов для статьи
     *
     * @param int $information_id
     *
     * @return array
     */
    public function getInformationStores($information_id)
    {
        $information_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_store "
            . "WHERE information_id = '" . (int) $information_id . "'");

        foreach ($query->rows as $result) {
            $information_store_data[] = $result['store_id'];
        }

        return $information_store_data;
    }

    /**
     * Метод дизайна статьи
     *
     * @param int $information_id
     *
     * @return array
     */
    public function getInformationLayouts($information_id)
    {
        $information_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int) $information_id . "'");

        foreach ($query->rows as $result) {
            $information_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $information_layout_data;
    }

    /**
     * Метод получения количества статей
     *
     * @return total
     */
    public function getTotalInformations()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information");

        return $query->row['total'];
    }

    /**
     * Метод получения количества статей по одному дизайну.
     *
     * @param int $layout_id
     *
     * @return int
     */
    public function getTotalInformationsByLayoutId($layout_id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int) $layout_id . "'");

        return $query->row['total'];
    }
}