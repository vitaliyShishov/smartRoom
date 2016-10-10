<?php

/**
 * Создание xml-выгрузки для поисковых систем
 *
 * Class sitemap
 */
class sitemap
{

    private $custom_seo_url = array();
    /**
     * Конструктор
     */
    public function __construct()
    {
        require_once(DIR_SYSTEM . 'startup.php');

        $this->registry = new Registry();
        $this->load = new Loader($this->registry);

        $this->db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $this->config = new Config();
       

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting");

        foreach ($query->rows as $setting) {
            $this->config->set($setting['key'], $setting['value']);
        }
         $this->config->set('config_url', HTTP_SERVER);
         $this->url = new Url($this->config->get('config_url'), $this->config->get('config_secure') ? $this->config->get('config_ssl') : $this->config->get('config_url'));

        $this->registry->set('db', $this->db);
        $this->registry->set('config', $this->config);

        $this->custom_seo_url = array(
            '' => 'common/home',
            'search' => 'product/search'
        );

        $this->run();
    }
    
     /*
     * Запуск скрипта
     */
    public function run()
    {
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');

        $data = array();
        
        $data['home']       = $this->rewrite($this->url->link('common/home'));

        $categories = $this->registry->get('model_catalog_category')->getCategoriesForSiteMap();
        
        foreach ($categories as $category) {
            $data['categories'][] = array(
                'href' => $this->rewrite(html_entity_decode($this->url->link('product/category', 'category_id=' . $category['category_id'])))
            );
        }
        
        $products = $this->registry->get('model_catalog_product')->getProductsForSiteMap();

        foreach ($products as $product) {
            $data['products'][] = array(
                'href' => $this->rewrite(html_entity_decode($this->url->link('product/product', 'product_id=' . $product['product_id']))),
                'date' => $product['date_modified']
            );
        }
        
        if (!empty($data)) {
            $this->siteMap($data);
        } else {
            exit('There are no data to create xml files.');
        }
    }
    
    /**
     * Метод для формирования xml SitMap
     *
     * @param $data
     */
    public function siteMap($data)
    {
        $temp_file = DIR_TEMP . 'sitemap_temp.xml';

        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->setIndent(true);
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('urlset');
            $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
            $xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            $xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 '
                    . 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

            if (isset($data['home'])) {
                $xmlWriter->startElement('url');
                $xmlWriter->writeElement('loc', str_replace(' ', '', $data['home']));
                $xmlWriter->writeElement('changefreq', 'monthly');
                $xmlWriter->writeElement('priority', 1);
                $xmlWriter->endElement();
            }

            foreach($data['categories'] as $category) {
                $xmlWriter->startElement('url');
                $xmlWriter->writeElement('loc', str_replace(' ', '', $category['href']));
                $xmlWriter->writeElement('changefreq', 'monthly');
                $xmlWriter->writeElement('priority', 0.9);
                $xmlWriter->endElement();
            }

            $i = 0;

            foreach ($data['products'] as $product) {
                $i++;

                if (0 == $i % 100) {
                    file_put_contents($temp_file, $xmlWriter->flush(true), FILE_APPEND);
                }

                $xmlWriter->startElement('url');
                $xmlWriter->writeElement('loc', str_replace(' ', '', $product['href']));
                $xmlWriter->writeElement('changefreq', 'weekly');
                $xmlWriter->writeElement('priority', 0.8);
                $xmlWriter->writeElement('lastmod', $product['date']);
                $xmlWriter->endElement();
            }
        
        $xmlWriter->endElement();

        file_put_contents($temp_file, $xmlWriter->flush(true), FILE_APPEND);

        $this->finalize($temp_file);
    }

    /**
     * Удаление темповых файлов и сохранение в файлы для скачки
     */
    public function finalize($temp_file)
    {
        if (file_exists(DIR_ROOT . 'sitemap.xml')) {
            unlink(DIR_ROOT . 'sitemap.xml');
        }

        rename($temp_file, DIR_ROOT . 'sitemap.xml');
        echo($temp_file . ' file is finilized and saved in root directory');
    }

    /**
     * rewrite method
     */
    public function rewrite($link)
    {
        $url_info = parse_url(str_replace('&amp;', '&', $link));
        $url = '';
        $data = array();

        $seo_array = array_flip($this->custom_seo_url);
        parse_str($url_info['query'], $data);

        if (isset($url_info['fragment'])) {
            $data['fragment'] = $url_info['fragment'];
        }

        foreach ($data as $key => $value) {
            if (isset($data['route']) && !isset($data['fragment'])) {
                if ($data['route'] == 'product/product' && $key == 'product_id') {
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

                    if ($query->num_rows) {
                        $url .= $query->row['keyword'];
                        unset($data[$key]);
                    }
                } elseif ($data['route'] == 'product/category' && $key == 'category_id') {
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
                        if ($query->num_rows) {
                            $url .= $query->row['keyword'];
                        } else {
                            $url = '';
                            break;
                        }
                    }
                    unset($data[$key]);
                } else {
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($data['route']) . "'");
                    if ($query->num_rows) {
                        $url .= $query->row['keyword'];
                        unset($data[$key]);
                    }
                }
            } elseif (isset($data['route']) && isset($data['fragment'])) {
                if ($key == 'fragment') {
                    $url .= '#' . $value;
                    unset($data[$key]);
                }
            }
        }
        $route = $data['route'];

        if ($url) {
            unset($data['route']);
            $query = '';
            if ($data) {
                foreach ($data as $key => $value) {
                    $query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
                }
                if ($query) {
                    $query = '&amp;' . str_replace('&', '&amp;', trim($query, '&'));
                }
            }
            $link = $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '')
                . str_replace('/index.php', '', $url_info['path']) . '/' . $url . $query;
        } elseif (isset($seo_array[$route])) {
            $link = $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '')
                . str_replace('/index.php', '', $url_info['path']) . '/' . $seo_array[$route];
        }
        return $link;
    }
}