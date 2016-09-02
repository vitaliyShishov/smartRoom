<?php

class ControllerModuleSlideshow extends Controller
{
    /**
     * index method
     */
    public function index()
    {
        $this->load->model('design/banner');
        $this->load->model('tool/image');
        $this->load->model('catalog/slideshow');

        $data['banners'] = array();

        $setting = $this->model_catalog_slideshow->getSlideshow();

        $results = array();

        if(isset($setting['banner_id'])) {
            $results = $this->model_design_banner->getBanner($setting['banner_id']);
        }

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                    $data['banners'][] = array(
                        'image_alt' => $result['image'],
                        'title' => $result['title'],
                        'link' => $result['link'],
                        'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                    );
            }
        }

        $data['text_choose'] = $this->language->get('text_choose');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/slideshow.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/slideshow.tpl', $data);
        } else {
            return $this->load->view('default/template/module/slideshow.tpl', $data);
        }
    }
}