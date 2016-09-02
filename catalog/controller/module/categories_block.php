<?php

class ControllerModuleCategoriesBlock extends Controller {

    /**
     *  index method
     */
    public function index() {
        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        $categories = $this->model_catalog_category->getCategoriesForMain();

        $data['categories'] = array();

        foreach ($categories as $category) {
            if($category['image'] && file_exists(DIR_IMAGE . $category['image'])) {
                $image = $this->model_tool_image->resize($category['image'], $this->config->get('config_image_tab_category_width'), $this->config->get('config_image_tab_category_height'));
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_tab_category_width'), $this->config->get('config_image_tab_category_height'));
            }

            $data['categories'][] = array(
                'name' => $category['name'],
                'href' => $this->url->link('product/category', 'category_id=' . $category['category_id']),
                'image' => $image
            );
        }

        $data['text_more'] = $this->language->get('text_more');
        $data['text_choose_category'] = $this->language->get('text_choose_category');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/categories_block.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/categories_block.tpl', $data);
        } else {
            return $this->load->view('default/template/module/categories_block.tpl', $data);
        }
    }
}