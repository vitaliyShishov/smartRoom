<?php

class ControllerProductProduct extends Controller
{
    /**
     * Index method
     */
    public function index()
    {
        $this->load->language('product/product');
        $this->load->language('catalog/category');

        $this->load->model('catalog/product');

        if (isset($this->request->get['product_id'])) {
            $product_id = (int)$this->request->get['product_id'];
        } else {
            $product_id = 0;
        }

        $data['breadcrubms'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['product'] = array();

        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {

            $data['breadcrumbs'][] = array(
                'text' => $product_info['category_name'],
                'href' => $this->url->link('product/category', 'category_id=' . $product_info['category_id'])
            );

            $data['breadcrumbs'][] = array(
                'text' => $product_info['name']
            );

            if ((float)$product_info['price']) {
                $price = $this->currency->format($product_info['price']);
            } else {
                $price = false;
            }

            $temp_meta_title = $this->config->get('config_meta_title_product');
            $temp_meta_description = $this->config->get('config_meta_description_product');
            $temp_meta_keywords = $this->config->get('config_meta_keyword_product');

            if ($product_info['meta_title']) {
                $meta_title = $product_info['meta_title'];
            } else {

                $meta_title = str_replace('%%category_name%%', $product_info['category_name'], $temp_meta_title);
                $meta_title = str_replace('%%name%%', $product_info['name'], $temp_meta_title);
            }

            if ($product_info['meta_description']) {
                $meta_description = $product_info['meta_description'];
            } else {

                $meta_description = str_replace('%%category_name%%', $product_info['category_name'], $temp_meta_description);
                $meta_description = str_replace('%%name%%', $product_info['name'], $temp_meta_description);
            }

            if ($product_info['meta_keyword']) {
                $meta_keywords = $product_info['meta_keyword'];
            } else {
                $meta_keywords = str_replace('%%category_name%%', $product_info['category_name'], $temp_meta_keywords);
                $meta_keywords = str_replace('%%name%%', $product_info['name'], $temp_meta_keywords);
            }

            $this->document->setTitle($meta_title);
            $this->document->setDescription($meta_description);
            $this->document->setKeywords($meta_keywords);

            $data['heading_title'] = $product_info['name'];

            $data['text_parameters'] = $this->language->get('text_parameters');
            $data['text_description'] = $this->language->get('text_description');
            $data['text_non_description'] = $this->language->get('text_non_description');
            $data['text_order'] = $this->language->get('text_order');
            $data['text_name'] = $this->language->get('text_name');
            $data['text_phone'] = $this->language->get('text_phone');
            $data['error_name'] = $this->language->get('error_name');
            $data['error_phone'] = $this->language->get('error_phone');

            $this->load->model('tool/image');

            $images = array();

            if ($product_info['image'] && (file_exists(DIR_IMAGE . '/' . $product_info['image']))) {
                $image = $product_info['image'];
            } else {
                $image = 'no_image.jpg';
            }

            if ($image) {
                $main_image = $this->model_tool_image->resize($image, $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
            } else {
                $main_image = false;
            }

            $images[] = array(
                'thumb' => $main_image
            );

            $results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

            foreach ($results as $result) {

                if ($result['image'] && (file_exists(DIR_IMAGE . '/' . $result['image']))) {
                    $temp_image = $result['image'];
                } else {
                    $temp_image = 'no_image.jpg';
                }

                if ($temp_image) {
                    $image = $this->model_tool_image->resize($temp_image, $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));

                    $images[] = array(
                        'thumb' => $image
                    );
                }
            }

            //Product Parameters
            $product_parameters = $this->model_catalog_product->getProductParameters($this->request->get['product_id']);

            if (count($product_parameters) <= 1) {
                $data['parameters'] = $product_parameters;
            } else {
                $data['parameters'] = array_chunk($product_parameters, ceil(count($product_parameters) / 2));
            }

            $temp_description = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

            if (strip_tags($temp_description)) {
                $description = $temp_description;
            } else {
                $description = NULL;
            }

            $data['product'] = array(
                'product_id' => $product_info['product_id'],
                'name' => $product_info['name'],
                'model' => $product_info['model'],
                'price' => $price,
                'href' => $this->url->link('product/product&product_id=' . $product_info['product_id']),
                'images' => $images,
                'description' => html_entity_decode($description),
                'article' => $product_info['article']
            );

            $link = $this->url->link('product/product', 'product_id=' . $product_info['product_id']);

            $open_graph = array(
                'og:type' => 'website',
                'og:author' => $this->language->get('text_og_author'),
                'og:site_name' => $this->language->get('text_og_sitename'),
                'og:title' => $product_info['name'],
                'og:description' => strip_tags($description),
                'og:url' => $link,
                'og:image' => $main_image
            );
            $this->document->setOpenGraph($open_graph);

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/product.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/product.tpl', $data));
            }
        } else {

            $this->document->setTitle($this->language->get('text_error'));

            $data['heading_title'] = $this->language->get('text_error');

            $data['text_error'] = $this->language->get('text_error');

            $data['button_continue'] = $this->language->get('button_continue');

            $data['continue'] = $this->url->link('common/home');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }
    }

    public function addOrder() {
        if (isset($this->request->post) && $this->validate()) {

            $this->load->model('catalog/product');

            $this->model_catalog_product->addOrder($this->request->post);

            $data['text_mail'] = $this->language->get('text_mail');

            $text = $data['text_mail'] . "\n" .
                $this->request->post['name'] . "\n" .
                $this->request->post['telephone'];

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->request->post['name']);
            $mail->setSubject($data['text_mail']);
            $mail->setText($text);
            $mail->send();
        }
    }

    public function validate()
    {
        $data = $this->request->post;

        $json = array();

        if ($data['company'] !== "") {
            $json['error']['company'] = 'error';
        }

        if (utf8_strlen($data['name']) < 2) {
            $json['error']['name'] = 'error';
        }

        if ((utf8_strlen($data['telephone']) < 13)) {
            $json['error']['telephone'] = 'error';
        }

        if (isset($json['error'])) {
            $json['status'] = false;
        } else {
            $json['status'] = true;
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

        return $json['status'];
    }
}
