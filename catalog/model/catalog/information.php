<?php

class ModelCatalogInformation extends Model {

    /**
     * getInformation method
     *
     * @param $information_id
     *
     * @return array
     */
    public function getInformation($information_id) {

        $result = array();

        $query = $this->db->query("SELECT id.title, id.description, i.image FROM " . DB_PREFIX . "information i 
            INNER JOIN " . DB_PREFIX . "information_description id ON(i.information_id = id.information_id)
            WHERE i.information_id = '" . (int)$information_id . "'");

        if (!empty($query->row)) {
            $result = array(
                'title' => $query->row['title'],
                'text' => html_entity_decode($query->row['description']),
                'image' => $query->row['image']
            );
        }

        return $result;
    }
}