<?php

/**
 * Контроллер поиска
 */
class ControllerProductSearch extends Controller
{

    /**
     * Метод выводит сраницу товаров
     */
    public function index()
    {
        $this->load->language('product/search');
        $this->load->model('tool/image');
        $this->load->model('catalog/search');

        if (isset($this->request->post['search'])) {
            $this->response->redirect($this->url->link('product/search', 'search=' . $this->request->post['search']));
        } else if (isset($this->request->get['search']) && $this->request->get['search']) {
            $keyword = '';
            
            if (isset($this->request->get['search'])) {
                $keyword = $this->request->get['search'];
            }

            if (isset($this->request->post['keyword'])) {
                $keyword = $this->request->post['keyword'];
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_search'),
                'url'  => $this->url->link('product/search', 'search=' . $keyword) 
            );

            $this->document->setTitle($this->config->get('config_meta_title_search'));
            $this->document->setDescription($this->config->get('config_meta_description_search'));
            $this->document->setKeywords($this->config->get('config_meta_keyword_search'));
            
            $this->document->setBreadcrumbs($data['breadcrumbs']);

            $meta_robot = array(
                'index'  => 'noindex',
                'follow' => 'follow'
            );

            $this->document->setMetaRobots($meta_robot);
            
            $data['keyword'] = $keyword;

            $data['heading_title'] = $this->language->get('heading_title');
            $data['text_no_results'] = $this->language->get('text_no_results');
            $data['text_more'] = $this->language->get('text_more');

            $temp_products = $this->products($keyword);

            if (!empty($temp_products)) {
                $data['products'] = $temp_products;
            } else {
                $data['products'] = array();
            }
            
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/search.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/search.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/search.tpl', $data));
            }
        } else {
            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_search'),
                'url'  => $this->url->link('product/search') 
            );

            $this->document->setBreadcrumbs($data['breadcrumbs']);
            $this->document->setTitle($this->config->get('config_meta_title_search'));
            $this->document->setDescription($this->config->get('config_meta_description_search'));
            $this->document->setKeywords($this->config->get('config_meta_keyword_search'));

            $meta_robot = array(
                'index'  => 'noindex',
                'follow' => 'follow'
            );

            $this->document->setMetaRobots($meta_robot);
            
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            
            $data['heading_title'] = $this->language->get('heading_title');
            $data['text_no_results'] = $this->language->get('text_no_results');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/search.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/search.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/search.tpl', $data));
            }
        }
    }

    /**
     * Метод загрузки товаров
     */
    public function products($keyword)
    {
        $products = array();

        $temp_products = $this->model_catalog_search->getProducts($keyword);

        if (!empty($temp_products)) {
            $products = $this->model_catalog_search->formatProduct($temp_products, $is_same = true);
        }

        return $products;
    }

    /**
     * Method to search product autocomplete
     */
    public function autocomplete()
    {
        $data['products'] = array();

        if (!empty($this->request->post['nameStartsWith'])) {
            $this->load->language('product/search');
            $this->load->model('tool/image');
            $this->load->model('catalog/search');

            $products = $this->model_catalog_search->getProductsSearch($this->request->post['nameStartsWith'], $this->config->get('config_product_search_limit'));

            if (!empty($products)) {
                foreach ($products as $product) {
                    $data['products'][$product['product_id']]['name'] = $product['name'];

                    if ($product['image'] && (file_exists(DIR_IMAGE . '/' . $product['image']))) {
                        $image = $product['image'];
                    } else {
                        $image = 'placeholder.png';
                    }

                    $data['products'][$product['product_id']]['image'] = $this->model_tool_image->resize($image, $this->config->get('config_image_search_width'), $this->config->get('config_image_search_height'));

                    $data['products'][$product['product_id']]['name']        = $product['name'];
                    $data['products'][$product['product_id']]['model']        = $product['model'];
                    $data['products'][$product['product_id']]['href']        = $this->url->link('product/product&product_id=' . $product['product_id']);
                    $data['products'][$product['product_id']]['price']       = $this->currency->format($product['price']);


                    if (isset($product['special_price'])) {
                        $data['products'][$product['product_id']]['special_price'] = $this->currency->format($product['special_price']);
                    } else {
                        $data['products'][$product['product_id']]['special_price'] = '';
                    }

                }
            }
        }

        if (!empty($data['products'])) {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/search_autocomplete.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/search_autocomplete.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/search_autocomplete.tpl', $data));
            }
        }
    }
}