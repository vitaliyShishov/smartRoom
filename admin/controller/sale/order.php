<?php

/**
 * Класс контроллера для работы с заказами
 */
class ControllerSaleOrder extends Controller
{

    /**
     * Массив ошибок
     * 
     * @var array 
     */
    private $error = array();

    /**
     * Метод для вывода списка заказов
     */
    public function index()
    {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/order');

        $this->getList();
    }

    /**
     * Метод для создания заказа
     */
    public function add()
    {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/order');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_sale_order->addOrder($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_order_status'])) {
                $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
            }

            if (isset($this->request->get['filter_total'])) {
                $url .= '&filter_total=' . $this->request->get['filter_total'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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

            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод для редактирования заказа
     */
    public function edit()
    {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/order');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_sale_order->editOrder($this->request->get['order_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_order_status'])) {
                $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
            }

            if (isset($this->request->get['filter_total'])) {
                $url .= '&filter_total=' . $this->request->get['filter_total'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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

            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод для удаления заказа
     */
    public function delete()
    {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/order');

        if (isset($this->request->get['order_id']) && $this->validate()) {

            $this->model_sale_order->deleteOrder($this->request->get['order_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_order_status'])) {
                $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
            }

            if (isset($this->request->get['filter_total'])) {
                $url .= '&filter_total=' . $this->request->get['filter_total'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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

            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    /**
     * Метод для вывода списка заказов
     */
    protected function getList()
    {
        if (isset($this->request->get['filter_order_id'])) {
            $filter_order_id = $this->request->get['filter_order_id'];
        } else {
            $filter_order_id = null;
        }

        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = $this->request->get['filter_customer'];
        } else {
            $filter_customer = null;
        }

        if (isset($this->request->get['filter_order_status'])) {
            $filter_order_status = $this->request->get['filter_order_status'];
        } else {
            $filter_order_status = null;
        }

        if (isset($this->request->get['filter_total'])) {
            $filter_total = $this->request->get['filter_total'];
        } else {
            $filter_total = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
        } else {
            $filter_date_modified = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.order_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status'])) {
            $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
        }

        if (isset($this->request->get['filter_total'])) {
            $url .= '&filter_total=' . $this->request->get['filter_total'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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
            'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'], 'SSL');
        $data['shipping'] = $this->url->link('sale/order/shipping', 'token=' . $this->session->data['token'], 'SSL');
        $data['add'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'], 'SSL');

        $data['orders'] = array();

        $filter_data = array(
            'filter_order_id' => $filter_order_id,
            'filter_customer' => $filter_customer,
            'filter_order_status' => $filter_order_status,
            'filter_total' => $filter_total,
            'filter_date_added' => $filter_date_added,
            'filter_date_modified' => $filter_date_modified,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $order_total = $this->model_sale_order->getTotalOrders($filter_data);

        $results = $this->model_sale_order->getOrders($filter_data);

        foreach ($results as $result) {
            $data['orders'][] = array(
                'order_id' => $result['order_id'],
                'customer' => $result['customer'],
                'status' => $result['status'],
                'total' => $this->currency->format($result['total']),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
                'view' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
                'edit' => $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
                'delete' => $this->url->link('sale/order/delete', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_missing'] = $this->language->get('text_missing');

        $data['column_order_id'] = $this->language->get('column_order_id');
        $data['column_customer'] = $this->language->get('column_customer');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_total'] = $this->language->get('column_total');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_action'] = $this->language->get('column_action');

        $data['entry_return_id'] = $this->language->get('entry_return_id');
        $data['entry_order_id'] = $this->language->get('entry_order_id');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_date_modified'] = $this->language->get('entry_date_modified');

        $data['button_invoice_print'] = $this->language->get('button_invoice_print');
        $data['button_shipping_print'] = $this->language->get('button_shipping_print');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_view'] = $this->language->get('button_view');

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

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status'])) {
            $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
        }

        if (isset($this->request->get['filter_total'])) {
            $url .= '&filter_total=' . $this->request->get['filter_total'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_total'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status'])) {
            $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
        }

        if (isset($this->request->get['filter_total'])) {
            $url .= '&filter_total=' . $this->request->get['filter_total'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

        $data['filter_order_id'] = $filter_order_id;
        $data['filter_customer'] = $filter_customer;
        $data['filter_order_status'] = $filter_order_status;
        $data['filter_total'] = $filter_total;
        $data['filter_date_added'] = $filter_date_added;
        $data['filter_date_modified'] = $filter_date_modified;

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/order_list.tpl', $data));
    }

    /**
     * Метод для вывода формы оформления/редактирования заказа
     */
    public function getForm()
    {
        $this->load->model('sale/customer');

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['order_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_product'] = $this->language->get('text_product');
        $data['text_order'] = $this->language->get('text_order');
        $data['text_total'] = $this->language->get('text_total');
        $data['text_cash_on_delivery'] = $this->language->get('text_cash_on_delivery');
        $data['text_cash_on_bank'] = $this->language->get('text_cash_on_bank');
        $data['text_own_delivery'] = $this->language->get('text_own_delivery');
        $data['text_nova_poshta'] = $this->language->get('text_nova_poshta');
        $data['text_shipping_warehouse'] = $this->language->get('text_shipping_warehouse');
        $data['text_shipping_city'] = $this->language->get('text_shipping_city');

        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_telephone'] = $this->language->get('entry_telephone');
        $data['entry_comment'] = $this->language->get('entry_comment');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_quantity'] = $this->language->get('entry_quantity');
        $data['entry_shipping_method'] = $this->language->get('entry_shipping_method');
        $data['entry_shipping_city'] = $this->language->get('entry_shipping_city');
        $data['entry_shipping_warehouse'] = $this->language->get('entry_shipping_warehouse');
        $data['entry_payment_method'] = $this->language->get('entry_payment_method');
        $data['entry_order_status'] = $this->language->get('entry_order_status');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_model'] = $this->language->get('column_model');
        $data['column_quantity'] = $this->language->get('column_quantity');
        $data['column_price'] = $this->language->get('column_price');
        $data['column_total'] = $this->language->get('column_total');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_continue'] = $this->language->get('button_continue');
        $data['button_back'] = $this->language->get('button_back');
        $data['button_product_add'] = $this->language->get('button_product_add');
        $data['button_apply'] = $this->language->get('button_apply');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['tab_order'] = $this->language->get('tab_order');
        $data['tab_customer'] = $this->language->get('tab_customer');
        $data['tab_payment'] = $this->language->get('tab_payment');
        $data['tab_product'] = $this->language->get('tab_product');
        $data['tab_total'] = $this->language->get('tab_total');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status'])) {
            $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
        }

        if (isset($this->request->get['filter_total'])) {
            $url .= '&filter_total=' . $this->request->get['filter_total'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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

        if (!isset($this->request->get['order_id'])) {
            $data['action'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL');
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
        }

        if (!empty($order_info)) {
            $data['order_id'] = $this->request->get['order_id'];

            $data['customer'] = $order_info['customer'];
            $data['email'] = $order_info['email'];
            $data['telephone'] = $order_info['telephone'];
            $data['total'] = $this->currency->format($order_info['total']);

            $this->load->model('sale/customer');

            $data['payment_method'] = $order_info['payment_method'];

            $data['shipping_city'] = $order_info['shipping_city'];
            $data['shipping_method'] = $order_info['shipping_method'];
            $data['shipping_warehouse'] = $order_info['shipping_warehouse'];

            $data['order_products'] = array();

            $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);

            foreach ($products as $product) {
                $data['order_products'][] = array(
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'model' => $product['model'],
                    'parameters' => $this->model_sale_order->getProductParameters($product['product_id']),
                    'quantity' => $product['quantity'],
                    'price' => $this->currency->format($product['price']),
                    'total' => $this->currency->format($product['total']),
                );
            }

            $data['order_totals'] = array();

            $data['order_totals'] = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);

            $data['order_status_id'] = $order_info['order_status_id'];
            $data['comment'] = $order_info['comment'];
        } else {
            $data['order_id'] = 0;
            $data['customer'] = '';
            $data['email'] = '';
            $data['telephone'] = '';
            $data['fax'] = '';

            $data['payment_method'] = '';

            $data['shipping_city'] = '';
            $data['shipping_method'] = '';
            $data['shipping_warehouse'] = '';

            $data['order_products'] = array();
            $data['order_totals'] = array();
            $data['total'] = $this->currency->format(0);

            $data['order_status_id'] = $this->config->get('config_order_status_id');
            $data['comment'] = '';
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/order_form.tpl', $data));
    }

    /**
     * Метод для вывода информации о заказе
     */
    public function info()
    {
        $this->load->model('sale/order');

        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }

        $order_info = $this->model_sale_order->getOrder($order_id);

        if ($order_info) {
            $this->load->language('sale/order');

            $this->document->setTitle($this->language->get('heading_title'));

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_order_id'] = $this->language->get('text_order_id');
            $data['text_customer'] = $this->language->get('text_customer');
            $data['text_email'] = $this->language->get('text_email');
            $data['text_telephone'] = $this->language->get('text_telephone');
            $data['text_total'] = $this->language->get('text_total');
            $data['text_order_status'] = $this->language->get('text_order_status');
            $data['text_comment'] = $this->language->get('text_comment');
            $data['text_date_added'] = $this->language->get('text_date_added');
            $data['text_date_modified'] = $this->language->get('text_date_modified');
            $data['text_city'] = $this->language->get('text_city');
            $data['text_shipping_method'] = $this->language->get('text_shipping_method');
            $data['text_payment_method'] = $this->language->get('text_payment_method');
            $data['text_history'] = $this->language->get('text_history');
            $data['text_cash_on_delivery'] = $this->language->get('text_cash_on_delivery');
            $data['text_cash_on_bank'] = $this->language->get('text_cash_on_bank');
            $data['text_own_delivery'] = $this->language->get('text_own_delivery');
            $data['text_nova_poshta'] = $this->language->get('text_nova_poshta');
            $data['text_shipping_warehouse'] = $this->language->get('text_shipping_warehouse');
            $data['text_shipping_city'] = $this->language->get('text_shipping_city');

            $data['column_product'] = $this->language->get('column_product');
            $data['column_model'] = $this->language->get('column_model');
            $data['column_quantity'] = $this->language->get('column_quantity');
            $data['column_price'] = $this->language->get('column_price');
            $data['column_total'] = $this->language->get('column_total');

            $data['entry_order_status'] = $this->language->get('entry_order_status');
            $data['entry_notify'] = $this->language->get('entry_notify');
            $data['entry_comment'] = $this->language->get('entry_comment');

            $data['button_edit'] = $this->language->get('button_edit');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_history_add'] = $this->language->get('button_history_add');

            $data['tab_order'] = $this->language->get('tab_order');
            $data['tab_payment_delivery'] = $this->language->get('tab_payment_delivery');
            $data['tab_product'] = $this->language->get('tab_product');
            $data['tab_history'] = $this->language->get('tab_history');

            $data['token'] = $this->session->data['token'];

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_order_status'])) {
                $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
            }

            if (isset($this->request->get['filter_total'])) {
                $url .= '&filter_total=' . $this->request->get['filter_total'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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
                'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
            );

            $data['edit'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int) $this->request->get['order_id'], 'SSL');
            $data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');

            $data['order_id'] = $this->request->get['order_id'];
            $data['customer'] = $order_info['customer'];
            $data['email'] = $order_info['email'];
            $data['telephone'] = $order_info['telephone'];
            $data['comment'] = nl2br($order_info['comment']);
            $data['total'] = $this->currency->format($order_info['total']);
            $data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
            $data['date_modified'] = date($this->language->get('date_format_short'), strtotime($order_info['date_modified']));
            $data['total'] = $this->currency->format($order_info['total']);
            $data['order_status_id'] = $order_info['order_status_id'];
            $data['payment_method'] = $order_info['payment_method'];
            $data['shipping_method'] = $order_info['shipping_method'];
            $data['shipping_city'] = $order_info['shipping_city'];
            $data['shipping_warehouse'] = $order_info['shipping_warehouse'];

            $this->load->model('localisation/order_status');

            $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

            $order_status_info = $this->model_localisation_order_status->getOrderStatus($order_info['order_status_id']);

            if ($order_status_info) {
                $data['order_status'] = $order_status_info['name'];
            } else {
                $data['order_status'] = '';
            }

            $data['products'] = array();

            $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);

            foreach ($products as $product) {

                $parameters = $this->model_sale_order->getProductParameters($product['product_id']);

                $data['products'][] = array(
                    'order_product_id' => $product['order_product_id'],
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'model' => $product['model'],
                    'parameters' => $parameters,
                    'quantity' => $product['quantity'],
                    'price' => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0)),
                    'total' => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0)),
                    'href' => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL')
                );
            }

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('sale/order_info.tpl', $data));
        } else {
            $this->load->language('error/not_found');

            $this->document->setTitle($this->language->get('heading_title'));

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_not_found'] = $this->language->get('text_not_found');

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }
    }
    
    /**
     * Метод проверки наличия права управления разделом Заказы
     * 
     * @return array
     */
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    /**
     * Метод для получения информации о продуктах в заказе
     */
    public function getProductInfoForOrder()
    {
        $json = array();

        $this->load->model('catalog/product');
        $this->load->model('sale/order');

        $product_id = $this->request->post['product_id'];
        $quantity = $this->request->post['quantity'];

        $product_info = $this->model_catalog_product->getProduct($product_id);
        $temp_product_parameters = $this->model_sale_order->getProductParameters($product_id);

        $temp_total = $product_info['price'] * $quantity;
        $total = $this->currency->format($temp_total);

        $product_parameters = array();

        foreach ($temp_product_parameters as $key => $value) {
            $product_parameters[] = $value['name'] . ': ' . $value['value'];
        }

        $json = array(
            'product_id' => $product_info['product_id'],
            'name' => $product_info['name'],
            'model' => $product_info['model'],
            'quantity' => $quantity,
            'price' => $this->currency->format($product_info['price']),
            'total' => $total,
            'parameters' => $product_parameters,
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * Метод обновления статуса заказа
     */
    public function updateOrderHistory()
    {
        $json = array();

        if (isset($this->request->post['comment'])) {
            $order_comment = $this->request->post['comment'];
        } else {
            $order_comment = NULL;
        }

        if (isset($this->request->post['order_status_id'])) {
            $order_status_id = $this->request->post['order_status_id'];
        } else {
            $order_status_id = 0;
        }

        $order_id = $this->request->get['order_id'];

        $this->load->model('sale/order');
        $this->model_sale_order->updateOrderHistory($order_id, $order_status_id, $order_comment);

        $this->model_sale_order->updateOrder($order_id, $order_status_id);

        $json['order_status_name'] = $this->model_sale_order->getOrderStatusName($order_status_id);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * Метод для получения истории смены статусов по заказу
     */
    public function getOrderHistory()
    {
        $this->load->language('sale/order');

        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_notify'] = $this->language->get('column_notify');
        $data['column_comment'] = $this->language->get('column_comment');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['histories'] = array();

        $this->load->model('sale/order');

        $results = $this->model_sale_order->getOrderHistories($this->request->get['order_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $data['histories'][] = array(
                'status' => $result['status'],
                'comment' => nl2br($result['comment']),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $history_total = $this->model_sale_order->getTotalOrderHistories($this->request->get['order_id']);

        $pagination = new Pagination();
        $pagination->total = $history_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('sale/order/getOrderHistory', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('sale/order_history.tpl', $data));
    }

}
