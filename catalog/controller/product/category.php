<?php

class ControllerProductCategory extends Controller
{

    /**
     * index method
     */
    public function index()
    {
        $this->load->language('product/category');
        $this->load->model('catalog/category');

        if (isset($this->request->get['category_id'])) {
            $category_id = $this->request->get['category_id'];
        } else {
            $category_id = 0;
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $category_info = $this->model_catalog_category->getCategory($category_id);

        if ($category_info) {

            $data['breadcrumbs'][] = array(
                'text' => $category_info['name']
            );

            $temp_meta_title = $this->config->get('config_meta_title_category');
            $temp_meta_description = $this->config->get('config_meta_description_category');
            $temp_meta_keywords = $this->config->get('config_meta_keyword_category');

            if ($category_info['meta_title']) {
                $meta_title = $category_info['meta_title'];
            } else {
                $meta_title = str_replace('%%name%%', $category_info['name'], $temp_meta_title);
            }

            if ($category_info['meta_description']) {
                $meta_description = $category_info['meta_description'];
            } else {
                $meta_description = str_replace('%%name%%', $category_info['name'], $temp_meta_description);
            }

            if ($category_info['meta_keyword']) {
                $meta_keywords = $category_info['meta_keyword'];
            } else {
                $meta_keywords = str_replace('%%name%%', $category_info['name'], $temp_meta_keywords);
            }

            $this->document->setTitle($meta_title);
            $this->document->setDescription($meta_description);
            $this->document->setKeywords($meta_keywords);

            $data['text_more'] = $this->language->get('text_more');
            $data['text_no_results'] = $this->language->get('text_no_results');

            $this->load->model('catalog/product');

            $data['products'] = htmlspecialchars(html_entity_decode(json_encode($this->getProducts($category_id))));
            $data['filters'] = htmlspecialchars(html_entity_decode(json_encode($this->getFilters($category_id))));
            $data['url'] = htmlspecialchars(html_entity_decode(json_encode($this->url->link('product/category/getProducts'))));
            $data['category_id'] = $category_id;
            $data['limit'] = (int)$this->config->get('config_product_limit');
            $sort_array = array();

            $sort_array[] = array(
                'title' => 'От дешевых к дорогим',
                'value' => false
            );
            $sort_array[] = array(
                'title' => 'От дорогих к дешевым',
                'value' => true
            );

            $data['sort_array'] = htmlspecialchars(html_entity_decode(json_encode($sort_array)));

            $open_graph = array(
                'og:type' => 'website',
                'og:author' => $this->language->get('text_og_author'),
                'og:site_name' => $this->language->get('text_og_sitename'),
                'og:title' => $meta_title,
                'og:description' => $meta_description,
                'og:url' => $this->url->link('product/category', '&category_id=' . $category_id),
            );

            $this->document->setOpenGraph($open_graph);

            $data['header'] = $this->load->controller('common/header');
            $data['footer'] = $this->load->controller('common/footer');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
            }
        } else {
            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_error'),
            );

            $this->document->setTitle($this->language->get('text_error'));
            $data['text_error'] = $this->language->get('text_error');

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }
    }

    public function getProducts($category_id) {
        $this->load->model('catalog/category');

        if (isset($this->request->post['params'])) {
            $filters = $this->request->post['params'];
        } else {
            $filters = array();
        }

        if (isset($this->request->post['category_id'])) {
            $category_id = $this->request->post['category_id'];
        }

        $temp_products = $this->model_catalog_category->getProducts($category_id, $filters);

        $products = array();

        if (!empty($temp_products)) {
            $products = $this->model_catalog_category->formatProduct($temp_products);
        }

        array_values($products);

        $json['products'] = $products;

        if ((strstr($this->request->server['HTTP_ACCEPT'], ',', true)) == 'application/json') {
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        } else {
            return $products;
        }

    }

    public function getFilters($category_id) {
        $this->load->model('catalog/category');

        $temp_filters = $this->model_catalog_category->getFilters($category_id);

        $filters = array();

        if (!empty($temp_filters)) {
            foreach ($temp_filters as $filter) {
                $filters[$filter['param_id']]['param_name'] = $filter['param_name'];
                $filters[$filter['param_id']]['values'][] = array(
                        'title' => $filter['title'],
                        'min_value' => $filter['min_value'],
                        'max_value' => $filter['max_value']
                );
            }
        }
        return $filters;
    }
}
