<?php

/**
 * Class ControllerModuleInformationMenu
 */
class ControllerModuleNavigationBlock extends Controller
{
    /**
     * index method
     */
    public function index()
    {
        $this->load->language('common/navigation_block');

        $data['text_main']     = $this->language->get('text_main');
        $data['text_categories'] = $this->language->get('text_categories');
        $data['text_contacts']  = $this->language->get('text_contacts');
        $data['text_about_us']     = $this->language->get('text_about_us');
        $data['text_delivery']  = $this->language->get('text_delivery');

        $data['home'] = $this->request->get['route'] == 'common/home' ? '#home' : $this->url->link('common/home#home');
        $data['products'] = $this->request->get['route'] == 'common/home' ? '#all_products' : $this->url->link('common/home#all_products');
        $data['about_us'] = $this->request->get['route'] == 'common/home' ? '#about_us' : $this->url->link('common/home#about_us');
        $data['delivery'] = $this->request->get['route'] == 'common/home' ? '#delivery' : $this->url->link('common/home#delivery');
        $data['contacts'] = $this->request->get['route'] == 'common/home' ? '#delivery' : $this->url->link('common/home#delivery');

        $this->load->model('tool/image');

        $data['logo_white'] = $this->model_tool_image->resize($this->config->get('config_logo_white'),$this->config->get('config_image_logo_width'), $this->config->get('config_image_logo_height'));

        $this->load->model('catalog/category');

        $categories = $this->model_catalog_category->getCategoriesForMain();

        foreach ($categories as $category) {
            $data['categories'][] = array(
                'name' => $category['name'],
                'href' => $this->url->link('product/category', 'category_id=' . $category['category_id'])
            );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/navigation_block.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/navigation_block.tpl', $data);
        } else {
            return $this->load->view('default/template/module/navigation_block.tpl', $data);
        }
    }
}