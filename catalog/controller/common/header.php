<?php

/**
 * Class ControllerCommonHeader
 */
class ControllerCommonHeader extends Controller
{

    /**
     * Метод для вывода header
     *
     * @return header.tpl
     */
    public function index()
    {
        if ($this->request->server['HTTPS']) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        $data['title']       = $this->document->getTitle();
        $data['description'] = $this->document->getDescription();
        $data['keywords']    = $this->document->getKeywords();
        $data['links']       = $this->document->getLinks();
        $data['styles']      = $this->document->getStyles();
        $data['scripts']     = $this->document->getScripts();
        $data['direction']   = $this->language->get('direction');
        $data['meta_robots'] = $this->document->getMetaRobots();
        $data['open_graph']  = $this->document->getOpenGraph();

        if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $data['icon'] = $server . 'image/' . $this->config->get('config_icon');
        } else {
            $data['icon'] = '';
        }

        $phones = $this->config->get('config_telephone');

        $data['phones'] = explode(',', $phones);

        $this->load->model('tool/image');

        $data['logo'] = $this->model_tool_image->resize($this->config->get('config_logo'), $this->config->get('config_image_logo_width'), $this->config->get('config_image_logo_height'));

        $this->load->language('common/header');

        $data['text_search_find_product'] = $this->language->get('text_search_find_product');
        $data['home']          = $this->url->link('common/home');
        $data['search_action'] = $this->url->link('product/search');
        $data['navigation_block'] = $this->load->controller('module/navigation_block');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
        } else {
            return $this->load->view('default/template/common/header.tpl', $data);
        }
    }
}