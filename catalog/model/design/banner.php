<?php

class ModelDesignBanner extends Model
{
/**
 * Метод для получения масива банеров
 *
 * @param int $bannerId
 *
 * @return array banner_image
 */
    public function getBanner($bannerId)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi "
            . "LEFT JOIN " . DB_PREFIX . "banner_image_description bid "
            . "ON bi.banner_image_id  = bid.banner_image_id "
            . "WHERE bi.banner_id = '" . (int) $bannerId . "' "
            . "ORDER BY bi.sort_order ASC");

        return $query->rows;
    }
}