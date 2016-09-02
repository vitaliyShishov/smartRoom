<?php

class Url
{

    private $domain;
    private $ssl;
    private $rewrite = array();

    public function __construct($domain, $ssl = '')
    {
        $this->domain = $domain;
        $this->ssl = $ssl;
    }

    public function addRewrite($rewrite)
    {
        $this->rewrite[] = $rewrite;
    }

    public function link($route, $args = '', $secure = false)
    {
        if (!$secure) {
            $url = $this->domain;
        } else {
            $url = $this->ssl;
        }

        $url .= 'index.php?route=' . $route;

        if ($args) {
            $url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
        }

        foreach ($this->rewrite as $rewrite) {
            $url = $rewrite->rewrite($url);
        }

        return $url;
    }

    /**
     * Метод создания строки параметров
     *
     * @param $get_array
     * @param $unset_param
     *
     * @return string
     */
    public function getParamString($get_array, $unset_param)
    {
        $param_string = '';

        foreach ($get_array as $key => $item) {
            if (!isset($unset_param[$key])) {
                $connect_symbol = ($param_string) ? '?' : '&';

                if ($item) {
                    $param_string = $connect_symbol . $key . '=' . $item;
                } else {
                    $param_string = $connect_symbol . $key;
                }
            }
        }
        return $param_string;
    }

}
