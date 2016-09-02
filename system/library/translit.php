<?php

/**
 * Глобальный класс, предназначенный для перевод русскоязычного текста в транслит.
 */
class Translit {

    /**
     * Construct method for class
     *
     * @param $db
     */
    public function __construct($db) {
        $this->db = $db;
    }

    // / ? : @ & = + $ #
     function getTranslit($str) {
        $alphavit = array(
               /*--*/
               "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e",
               "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l", "м"=>"m",
               "н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
               "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh",
               "ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya", 
               /*--*/
               "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"Yo",
               "Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K", "Л"=>"L","М"=>"M",
               "Н"=>"N","О"=>"O","П"=>"P", "Р"=>"R","С"=>"S","Т"=>"T","У"=>"Y",
               "Ф"=>"F", "Х"=>"H","Ц"=>"C","Ч"=>"Ch","Ш"=>"Sh","Щ"=>"Sh",
               "Ы"=>"I","Э"=>"E","Ю"=>"U","Я"=>"Ya",
               "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
               /*--*/
              "/"=>"-","\\"=>"-","?"=>"","@"=>"-","&"=>"-","$"=>"-","#"=>"-","^"=>"-","="=>"-",
              "."=>"-",","=>"-","`"=>"","'"=>"",";"=>"-",":"=>"-","*"=>"x","%"=>"-","|"=>"-", " " => "",
              "!"=>""
               );
       return strtr($str, $alphavit);    
    }

    /**
     * Method to find repeat keywords
     *
     * @param $keyword
     * @return bool
     */
    public function checkRepeatUrlKeyword($keyword){
        $query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias
         WHERE keyword = '" . $this->db->escape($keyword) . "'");

        return ($query->num_rows > 0) ? true : false;
    }
}