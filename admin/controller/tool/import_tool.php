<?php

class ControllerToolImportTool extends Controller {
    public function index() {
        $this->load->model('tool/import_tool');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_import_heading'),
            'href' => $this->url->link('tool/import_tool', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['import_start'] = $this->url->link('tool/import_tool/importStart', 'token=' . $this->session->data['token']);

        $filter_data = array(
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $queries = $this->model_tool_import_tool->getQueries($filter_data);

        $data['queries'] = array();

        foreach ($queries as $query) {
            $temp_products = !empty($query['import_products']) ? unserialize($query['import_products']) : array();
            $products = array();

            if(!empty($temp_products)) {
                foreach($temp_products as $product) {
                    $products[] = array(
                        'code' => $product['product_code'],
                        'href' => $this->url->link('catalog/product/edit', 'product_id=' . $product['product_id'] . '&token=' . $this->session->data['token'])
                    );
                }
            }

            $data['queries'][] = array(
                'date' => $query['import_date'],
                'products' => $products
            );
        }
        $data['column_date'] = $this->language->get('column_date');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_products']  = $this->language->get('column_products');
        $data['text_import']  = $this->language->get('text_import');
        $data['text_list']  = $this->language->get('text_list');
        $data['heading_title']  = $this->language->get('text_import_heading');
        $data['text_no_results']  = $this->language->get('text_no_results');
        $data['text_choose_file']  = $this->language->get('text_choose_file');
        $data['text_import_start']  = $this->language->get('text_import_start');

        $total_log_queries = $this->model_tool_import_tool->getTotalQueries($filter_data);

        $pagination = new Pagination();
        $pagination->total = $total_log_queries;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total_log_queries) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total_log_queries - $this->config->get('config_limit_admin'))) ? $total_log_queries : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total_log_queries, ceil($total_log_queries / $this->config->get('config_limit_admin')));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('tool/import_tool.tpl', $data));
    }

    public function importStart() {
        $this->load->model('tool/import_tool');

        if (isset($this->request->files['import_file'])) {
            $import_result = $this->model_tool_import_tool->saveFile($this->request->files['import_file']);

            if ($import_result['status']) {
                $this->model_tool_import_tool->loadFileXls(DIR_UPLOADS . $import_result['file']);
            }
        }

        $this->response->redirect($this->url->link('tool/import_tool', 'token=' . $this->session->data['token'], 'SSL'));
    }
}