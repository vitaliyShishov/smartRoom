<?php

class ControllerCommonHome extends Controller
{

    /**
     * Метод главной страницы
     *
     * @return home.tpl
     */
    public function index()
    {
        $this->load->model('tool/image');

        $this->document->setTitle($this->config->get('config_meta_title_main'));
        $this->document->setDescription($this->config->get('config_meta_description_main'));
        $this->document->setKeywords($this->config->get('config_meta_keyword_main'));
    

        $open_graph = array(
            'og:type' => 'website',
            'og:author' => $this->language->get('text_og_author'),
            'og:site_name' => $this->language->get('text_og_sitename'),
            'og:title' => $this->config->get('config_meta_title_main'),
            'og:description' => $this->config->get('config_meta_description_main'),
            'og:url' => $this->url->link('common/home'),
        );

        $this->document->setOpenGraph($open_graph);

        $this->load->model('catalog/information');

        $data['information_about'] = $this->model_catalog_information->getInformation($this->config->get('config_about_information'));
        $information_delivery = $this->model_catalog_information->getInformation($this->config->get('config_delivery_information'));

        if (!empty($information_delivery)) {
            if ($information_delivery['image'] && file_exists(DIR_IMAGE . $information_delivery['image'])) {
                $image = $this->model_tool_image->resize($information_delivery['image'], 580, 390);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', 580, 390);
            }

            $data['information_delivery'] = array(
                'title' => $information_delivery['title'],
                'text' => $information_delivery['text'],
                'image' => $image
            );
        }

        $phones = $this->config->get('config_telephone');

        $data['phones'] = explode(',', $phones);
        $data['email'] = $this->config->get('config_email');

        $data['text_contacts'] = $this->language->get('text_contacts');
        $data['header'] = $this->load->controller('common/header');
        $data['categories_block'] = $this->load->controller('module/categories_block');
        $data['slideshow'] = $this->load->controller('module/slideshow');
        $data['footer'] = $this->load->controller('common/footer');
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
        }
    }

}
