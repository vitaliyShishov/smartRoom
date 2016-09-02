<?php

/**
 * Контроллер настроек Liqpay
 * 
 * PHP version 5.3
 * 
 */
class ControllerPaymentLiqpay extends Controller
{
    private $error = array();

    /**
     * Метод вывода страницы настроек Liqpay
     *
     * @return liqpay.tpl
     */
    public function index()
    {
        $this->language->load('payment/liqpay');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('liqpay', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled']   = $this->language->get('text_enabled');
        $data['text_disabled']  = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_buy']       = $this->language->get('text_buy');
        $data['text_donate']    = $this->language->get('text_donate');

        $data['entry_public_key']   = $this->language->get('entry_public_key');
        $data['entry_private_key']  = $this->language->get('entry_private_key');
        $data['entry_action']       = $this->language->get('entry_action');
        $data['entry_type']         = $this->language->get('entry_type');
        $data['entry_total']        = $this->language->get('entry_total');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_geo_zone']     = $this->language->get('entry_geo_zone');
        $data['entry_status']       = $this->language->get('entry_status');
        $data['entry_sort_order']   = $this->language->get('entry_sort_order');
        $data['entry_pay_way']      = $this->language->get('entry_pay_way');
        $data['entry_language']     = $this->language->get('entry_language');
        $data['entry_sandbox']      = $this->language->get('entry_sandbox');
        $data['entry_sandbox_yes']  = $this->language->get('entry_sandbox_yes');
        $data['entry_sandbox_no']   = $this->language->get('entry_sandbox_no');

        $data['button_save']   = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['public_key'])) {
            $data['error_public_key'] = $this->error['public_key'];
        } else {
            $data['error_public_key'] = '';
        }

        if (isset($this->error['private_key'])) {
            $data['error_private_key'] = $this->error['private_key'];
        } else {
            $data['error_private_key'] = '';
        }

        if (isset($this->error['action'])) {
            $data['error_action'] = $this->error['action'];
        } else {
            $data['error_action'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_payment'),
            'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('payment/liqpay', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

		$data['action'] = $this->url->link('payment/liqpay', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['liqpay_public_key'])) {
            $data['liqpay_public_key'] = $this->request->post['liqpay_public_key'];
        } else {
            $data['liqpay_public_key'] = $this->config->get('liqpay_public_key');
        }

        if (isset($this->request->post['liqpay_private_key'])) {
            $data['liqpay_private_key'] = $this->request->post['liqpay_private_key'];
        } else {
            $data['liqpay_private_key'] = $this->config->get('liqpay_private_key');
        }

        if (isset($this->request->post['liqpay_action'])) {
            $data['liqpay_action'] = $this->request->post['liqpay_action'];
        } else {
            $data['liqpay_action'] = $this->config->get('liqpay_action');
            if (empty($data['liqpay_action'])) {
                $data['liqpay_action'] = 'https://www.liqpay.com/api/checkout';
            }
        }

        if (isset($this->request->post['liqpay_total'])) {
            $data['liqpay_total'] = $this->request->post['liqpay_total'];
        } else {
            $data['liqpay_total'] = $this->config->get('liqpay_total');
        }

        if (isset($this->request->post['liqpay_order_status_id'])) {
            $data['liqpay_order_status_id'] = $this->request->post['liqpay_order_status_id'];
        } else {
            $data['liqpay_order_status_id'] = $this->config->get('liqpay_order_status_id');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['liqpay_geo_zone_id'])) {
            $data['liqpay_geo_zone_id'] = $this->request->post['liqpay_geo_zone_id'];
        } else {
            $data['liqpay_geo_zone_id'] = $this->config->get('liqpay_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['liqpay_status'])) {
            $data['liqpay_status'] = $this->request->post['liqpay_status'];
        } else {
            $data['liqpay_status'] = $this->config->get('liqpay_status');
        }

        if (isset($this->request->post['liqpay_sort_order'])) {
            $data['liqpay_sort_order'] = $this->request->post['liqpay_sort_order'];
        } else {
            $data['liqpay_sort_order'] = $this->config->get('liqpay_sort_order');
        }

        if (isset($this->request->post['liqpay_pay_way'])) {
            $data['liqpay_pay_way'] = $this->request->post['liqpay_pay_way'];
        } else {
            $data['liqpay_pay_way'] = $this->config->get('liqpay_pay_way');
        }

        if (isset($this->request->post['liqpay_language'])) {
            $data['liqpay_language'] = $this->request->post['liqpay_language'];
        } else {
            $data['liqpay_language'] = $this->config->get('liqpay_language');
        }

        if (isset($this->request->post['liqpay_sandbox'])) {
            $data['liqpay_sandbox'] = $this->request->post['liqpay_sandbox'];
        } else {
            $data['liqpay_sandbox'] = $this->config->get('liqpay_sandbox');
        }
        
        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/liqpay.tpl', $data));
    }

    /**
     * Метод проверки настроек
     *
     * @return boolean
     */
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'payment/liqpay')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['liqpay_public_key']) {
            $this->error['public_key'] = $this->language->get('error_public_key');
        }

        if (!$this->request->post['liqpay_private_key']) {
            $this->error['private_key'] = $this->language->get('error_private_key');
        }

        if (!$this->request->post['liqpay_action']) {
            $this->error['action'] = $this->language->get('error_action');
        }

        return !$this->error;
    }
}