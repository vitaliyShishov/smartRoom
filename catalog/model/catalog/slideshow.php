<?php

class ModelCatalogSlideshow extends Model
{
    /**
     * Метод получения массива слайдшоу
     *
     * @return array
     */
    public function getSlideshow()
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module m WHERE m.code = 'carousel'");

        if ($query->row) {
            return unserialize($query->row['setting']);
        } else {
            return array();
        }
    }
}
