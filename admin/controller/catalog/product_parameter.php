<?php

/**
 * Класс, наследующий глобальный класс Controller, для управления сущностью param.
 */
class ControllerCatalogProductParameter extends Controller
{
    /**
     *
     * @var array
     */
    private $error = array();

    /**
     *  Метод для первичной загрузки страницы
     */
    public function index()
    {

        $this->load->language('catalog/product_parameter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_parameter');

        $this->getList();
    }

    /**
     * Добавление нового параметра продукта
     */
    public function add()
    {
        $this->load->language('catalog/product_parameter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_parameter');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_catalog_product_parameter->addParameter($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Редактирование существующего параметра продукта
     */
    public function edit()
    {
        $this->load->language('catalog/product_parameter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_parameter');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateEditing()) {

            $param_filters = $this->model_catalog_product_parameter->editParameter($this->request->get['parameter_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     *  Удаление существующего параметра продукта
     */
    public function delete()
    {
        $this->load->language('catalog/product_parameter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_parameter');

        if (isset($this->request->post['selected'])) {
            foreach ($this->request->post['selected'] as $parameter_id) {
                $this->model_catalog_product_parameter->deleteParameter($parameter_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    /**
     * Получение всей информации о выбраном парараметре продукта
     */
    public function getForm()
    {
        $data['text_form']     = !isset($this->request->get['option_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['heading_title'] = $this->language->get('heading_title');

        $data['entry_name']        = $this->language->get('entry_name');
        $data['entry_title']       = $this->language->get('entry_title');
        $data['entry_filter']      = $this->language->get('entry_filter');
        $data['entry_in_category'] = $this->language->get('entry_in_category');
        $data['entry_page']        = $this->language->get('entry_page');
        $data['entry_category']    = $this->language->get('entry_category');
        $data['entry_value']       = $this->language->get('entry_value');
        $data['entry_min_value']   = $this->language->get('entry_min_value');
        $data['entry_max_value']   = $this->language->get('entry_max_value');
        $data['entry_sort_order']  = $this->language->get('entry_sort_order');
        $data['entry_is_multiple'] = $this->language->get('entry_is_multiple');

        $data['tab_data']   = $this->language->get('tab_data');
        $data['tab_values'] = $this->language->get('tab_values');
        $data['tab_filters'] = $this->language->get('tab_filters');

        $data['button_save']                = $this->language->get('button_save');
        $data['button_cancel']              = $this->language->get('button_cancel');
        $data['button_parameter_value_add'] = $this->language->get('button_parameter_value_add');
        $data['button_filter_value_add']    = $this->language->get('button_parameter_value_add');
        $data['button_remove']              = $this->language->get('button_remove');

        $data['error_name'] = $this->language->get('error_name');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }
        
        if (isset($this->error['same_name'])) {
            $data['error_same_name'] = $this->error['same_name'];
        } else {
            $data['error_same_name'] = '';
        }

        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['parameter_id'])) {
            $data['action'] = $this->url->link('catalog/product_parameter/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('catalog/product_parameter/edit', 'token=' . $this->session->data['token'] . '&parameter_id=' . $this->request->get['parameter_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['parameter_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $parameterInfo = $this->model_catalog_product_parameter->getParameter($this->request->get['parameter_id']);
        }

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['parameter_name'])) {
            $data['parameter_name'] = $this->request->post['parameter_name'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $data['parameter_name'] = $parameterInfo['name'];
        } else {
            $data['parameter_name'] = '';
        }
        
        if (isset($this->request->post['parameter_sort_order'])) {
            $data['parameter_sort_order'] = $this->request->post['parameter_sort_order'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $data['parameter_sort_order'] = $parameterInfo['sort_order'];
        } else {
            $data['parameter_sort_order'] = '';
        }

        if (isset($this->request->post['parameter_in_category'])) {
            $data['parameter_in_category'] = $this->request->post['parameter_in_category'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $data['parameter_in_category'] = $parameterInfo['is_in_category'];
        } else {
            $data['parameter_in_category'] = '';
        }

        if (isset($this->request->post['parameter_value'])) {
            $parameter_values = $this->request->post['parameter_value'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $parameter_values = $this->model_catalog_product_parameter->getParameterValues($this->request->get['parameter_id']);
        } else {
            $parameter_values = array();
        }

        // Categories
        $this->load->model('catalog/category');

        if (isset($this->request->post['parameter_category'])) {
            $categories = $this->request->post['parameter_category'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $categories = $this->model_catalog_product_parameter->getParameterCategories($this->request->get['parameter_id']);
        } else {
            $categories = array();
        }

        $data['parameter_categories'] = array();

        foreach ($categories as $category) {
            $category_info = $this->model_catalog_category->getCategory($category['category_id']);

            if ($category_info) {
                $data['parameter_categories'][] = array(
                    'category_id' => $category_info['category_id'],
                    'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
                );
            }
        }

        $data['parameter_values'] = array();

        foreach ($parameter_values as $parameter_value) {
            $data['parameter_values'][] = $parameter_value['value'];
        }

        if (isset($this->request->post['filters'])) {
            $data['parameter_filters'] = $this->request->post['filters'];
        } elseif (isset($this->request->get['parameter_id'])) {
            $data['parameter_filters'] = $this->model_catalog_product_parameter->getParameterFilters($this->request->get['parameter_id']);
        } else {
            $data['parameter_filters'] = array();
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/product_parameter_form.tpl', $data));
    }

    /**
     * Получение списка всех параметров продукта
     */
    public function getList()
    {
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_category'])) {
            $filter_category = $this->request->get['filter_category'];
        } else {
            $filter_category = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('catalog/product_parameter/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('catalog/product_parameter/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_category' => $filter_category,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $data['parameters'] = array();

        $parameters_total = $this->model_catalog_product_parameter->getTotalParameters();

        $results = $this->model_catalog_product_parameter->getParameters($filter_data);

        foreach ($results as $result) {
            $data['parameters'][] = array(
                'parameter_id' => $result['param_id'],
                'parameter_name' => $result['paramName'],
                'category_name' => $result['categoryName'],
                'sort_order' => $result['sort_order'],
                'edit' => $this->url->link('catalog/product_parameter/edit', 'token=' . $this->session->data['token'] . '&parameter_id=' . $result['param_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_category'] = $this->language->get('entry_category');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_sort_order'] = $this->language->get('column_sort_order');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_category'] = $this->language->get('column_category');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array) $this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_name'] = $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . '&sort=p.name' . $url, 'SSL');
        $data['sort_sort_order'] = $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
        $data['sort_category'] = $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . '&sort=cd.name' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $parameters_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/product_parameter', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($parameters_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($parameters_total - $this->config->get('config_limit_admin'))) ? $parameters_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $parameters_total, ceil($parameters_total / $this->config->get('config_limit_admin')));

        $data['filter_name'] = $filter_name;
        $data['filter_category'] = $filter_category;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/product_parameter_list.tpl', $data));
    }

    /**
     * Проверка на корректный ввод имени параметра
     *
     * @return boolen || array
     */
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'catalog/product_parameter')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('catalog/product_parameter');
        
        $parameter_names = $this->model_catalog_product_parameter->getAllParametersNames();
        
        $all_names = array();
        
        foreach ($parameter_names as $name) {
            $all_names[$name['name']] = $name['name'];
        }
        
        if ((utf8_strlen($this->request->post['parameter_name']) < 1) || (utf8_strlen($this->request->post['parameter_name']) > 128)) {
            $this->error['name'] = $this->language->get('error_name');
        } else if (in_array($this->request->post['parameter_name'], $all_names)) {
            $this->error['same_name'] = $this->language->get('error_same_name');
        }

        return !$this->error;
    }
    
    /**
     * Метод для проверки на корректое имя параметра при редактирования параметра
     * 
     * @return array
     */
    protected function validateEditing() {
        if (!$this->user->hasPermission('modify', 'catalog/product_parameter')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['parameter_name']) < 1) || (utf8_strlen($this->request->post['parameter_name']) > 128)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
    }
}
