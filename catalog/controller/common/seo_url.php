<?php

/**
 * Контроллер seo_url
 */
class ControllerCommonSeoUrl extends Controller
{
    /**
     * Массив кастомных урлов
     *
     * @var array
     */
    private $custom_seo_url = array();

    /**
     *Переменная для хранения редиректа
     *
     * @var type
     */
    private $redirect_url = '';

    /**
     *Переменная для редиректа на главную страницу
     *
     * @var type
     */
    private $redirect_home = false;

    /**
     *Код редиректа
     *
     * @var type
     */
    private $redirect_code = 301;

    /**
     * Переменная для хранения названия исполняемого действия
     *
     * @var type
     */
    private $action_name = '';

    /**
     * ControllerCommonSeoUrl constructor.
     *
     * @param array $registry
     * @param array $args
     */
    public function __construct($registry, $args)
    {
        parent::__construct($registry, $args);

        $this->custom_seo_url = array(
            '' => 'common/home',
            'search' => 'product/search',
            'sitemap' => 'common/sitemap'
        );
    }

    /**
     * Метод обрабатывающий seo url
     *
     * @return array
     */
    public function index()
    {
        // Add rewrite to url class
        if ($this->config->get('config_seo_url')) {
            $this->url->addRewrite($this);
        }

        switch (true) {
            case $this->toSlashUrl():
                break;
            case $this->toCustomSeoUrl():
                break;
            case $this->toUrlAlias():
                break;
            case $this->fromCustomSeoUrl():
                break;
            case $this->fromUrlAlias():
                break;
        }

        if ($this->redirect_url || $this->redirect_home) {
            $this->response->redirect(HTTP_SERVER . $this->redirect_url, $this->redirect_code);
        }

        if ($this->action_name) {
            $this->request->get['route'] = $this->action_name;
            return new Action($this->action_name);
        }
    }

    /**
     * toSlashUrl method
     */
    public function toSlashUrl()
    {

        if (isset($this->request->get['route'])) {
            if (preg_match('/index.php/', $this->request->server['REQUEST_URI']) && $this->request->get['route'] != '') {
                $explode_request_uri = explode($this->request->get['route'] . '&amp;', $this->request->server['REQUEST_URI']);
                if (isset($explode_request_uri[1])) {
                    $query_part = explode("=", $explode_request_uri[1]);

                    if ($query_part[0] == 'product_id') {
                        $this->request->get['route'] = 'product/product';
                        $this->request->get['product_id'] = $query_part[1];
                        $this->action_name = $this->request->get['route'];
                        return true;
                    } elseif ($query_part[0] == 'category_id') {
                        $this->request->get['route'] = 'product/category';
                        $this->request->get['category_id'] = $query_part[1];
                        $this->action_name = $this->request->get['route'];
                        return true;
                    } elseif ($query_part[0] == 'search') {
                        $this->request->get['route'] = 'product/search';
                        $this->request->get['search'] = $query_part[1];
                        $this->action_name = $this->request->get['route'];
                        return true;
                    }
                }
            } elseif ($this->request->get['route'] == '') {
                $this->action_name = 'common/home';
                return true;
            }
        } else {
            $this->action_name = 'common/home';
            return true;
        }
    }

    /**
     * toCustomSeoUrl method
     */
    public function toCustomSeoUrl()
    {
        if ($this->config->get('config_seo_url')) {
            if ($this->request->get['route'] == 'common/home') {
                $this->redirect_home = true;
                return true;
            }

            $seo_array = array_flip($this->custom_seo_url);
            $unset_param = array('route' => 'route');
            if (isset($seo_array[$this->request->get['route']])) {
                $param_string = $this->url->getParamString($this->request->get, $unset_param);
                $this->redirect_url = $seo_array[$this->request->get['route']] . $param_string;
            }
        }
    }

    /**
     * fromCustomSeoUrl method
     */
    public function fromCustomSeoUrl()
    {
        if (isset($this->request->get['route'])) {
            if (isset($this->custom_seo_url[$this->request->get['route']])) {
                $this->action_name = $this->custom_seo_url[$this->request->get['route']];

                if (isset($this->request->get['route'])) {
                    $this->document->addLink(HTTP_SERVER . $this->request->get['route'], 'canonical');
                } else {
                    $this->document->addLink(HTTP_SERVER, 'canonical');
                }
                return true;
            }
        }

        return false;
    }

    /**
     * toUrlAlias method
     */
    public function toUrlAlias()
    {
        if (preg_match('/index.php/', $this->request->server['REQUEST_URI'])) {
            $unset_param = array('route' => 'route');
            if ($this->request->get['route'] == 'product/product' && isset($this->request->get['product_id'])) {
                $query = 'product_id=' . $this->request->get['product_id'];
                $unset_param['product_id'] = 'product_id';
            } elseif ($this->request->get['route'] == 'product/category' && isset($this->request->get['category_id'])) {
                $query = 'category_id=' . $this->request->get['category_id'];
            }

            if (isset($query)) {
                $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias
                    WHERE query = '" . $this->db->escape($query) . "'")->row;
                if (isset($result['keyword'])) {
                    $param_string = $this->url->getParamString($this->request->get, $unset_param);
                    $this->redirect_url = $result['keyword'];
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * fromUrlAlias method
     */
    public function fromUrlAlias()
    {
        if (isset($this->request->get['route'])) {
            $explode_route = explode('/', $this->request->get['route']);

            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias
             WHERE keyword = '" . $this->db->escape($explode_route[0]) . "'")->row;

            if (isset($query['query'])) {
                $query_part = explode("=", $query['query']);
                if (isset($query_part[1])) {
                    if ($query_part[0] == 'product_id') {
                        $this->request->get['route'] = 'product/product';
                        $this->request->get['product_id'] = $query_part[1];
                        $this->action_name = $this->request->get['route'];
                        return true;
                    } elseif ($query_part[0] == 'category_id') {
                        $this->request->get['route'] = 'product/category';
                        $this->request->get['category_id'] = $query_part[1];
                        $this->action_name = $this->request->get['route'];
                        return true;
                    }
                }
            }
        }

        return false;
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
