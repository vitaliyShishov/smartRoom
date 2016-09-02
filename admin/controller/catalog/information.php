<?php

/**
 * Контроллер страницы Статьи
 *
 */
class ControllerCatalogInformation extends Controller
{
    private $error = array();

    /**
     * Метод выводит getList()
     */
    public function index()
    {
        $this->load->language('catalog/information');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/information');

        $this->getList();
    }

    /**
     * Метод добавления статей
     */
    public function add()
    {
        $this->load->language('catalog/information');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/information');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_information->addInformation($this->request->post);

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

            $this->response->redirect($this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод редактирования статей
     */
    public function edit()
    {
        $this->load->language('catalog/information');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/information');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_information->editInformation($this->request->get['information_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод удаляющий статьи
     */
    public function delete()
    {
        $this->load->language('catalog/information');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/information');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $informationId) {
                $this->model_catalog_information->deleteInformation($informationId);
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

            $this->response->redirect($this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    /**
     * Метод страницы статей
     */
    protected function getList()
    {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'id.title';
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
            'href' => $this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add']    = $this->url->link('catalog/information/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('catalog/information/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['informations'] = array();

        $filterData = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $informationTotal = $this->model_catalog_information->getTotalInformations();

        $results = $this->model_catalog_information->getInformations($filterData);

        foreach ($results as $result) {
            $data['informations'][] = array(
                'information_id' => $result['information_id'],
                'title'          => $result['title'],
                'sort_order'     => $result['sort_order'],
                'edit'           => $this->url->link('catalog/information/edit', 'token='
                    . $this->session->data['token'] . '&information_id=' . $result['information_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_List']     = $this->language->get('text_List');
        $data['textNoResults'] = $this->language->get('textNoResults');
        $data['textConfirm']   = $this->language->get('textConfirm');

        $data['column_title']      = $this->language->get('column_title');
        $data['column_sort_order'] = $this->language->get('column_sort_order');
        $data['column_action']     = $this->language->get('column_action');

        $data['button_add']    = $this->language->get('button_add');
        $data['button_edit']   = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

        $data['text_no_results'] = $this->language->get('text_no_results');

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

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sortTitle']     = $this->url->link('catalog/information', 'token='
            . $this->session->data['token'] . '&sort=id.title' . $url, 'SSL');
        $data['sortSortOrder'] = $this->url->link('catalog/information', 'token='
            . $this->session->data['token'] . '&sort=i.sort_order' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination        = new Pagination();
        $pagination->total = $informationTotal;
        $pagination->page  = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url   = $this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($informationTotal) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) >
            ($informationTotal - $this->config->get('config_limit_admin'))) ? $informationTotal : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $informationTotal, ceil($informationTotal / $this->config->get('config_limit_admin')));

        $data['sort']  = $sort;
        $data['order'] = $order;

        $data['header']     = $this->load->controller('common/header');
        $data['columnLeft'] = $this->load->controller('common/column_left');
        $data['footer']     = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/information_list.tpl', $data));
    }

    /**
     * Метод вывода формы добавление/редактирования статьи
     */
    protected function getForm()
    {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['textForm']     = !isset($this->request->get['information_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_default'] = $this->language->get('text_default');
        $data['textEnabled']  = $this->language->get('textEnabled');
        $data['textDisabled'] = $this->language->get('textDisabled');

        $data['entryTitle']            = $this->language->get('entryTitle');
        $data['entryDescription']      = $this->language->get('entryDescription');
        $data['entryMetaTitle']        = $this->language->get('entryMetaTitle');
        $data['entryMetaDescription']  = $this->language->get('entryMetaDescription');
        $data['entryMetaKeyword']      = $this->language->get('entryMetaKeyword');
        $data['entryKeyword']          = $this->language->get('entryKeyword');
        $data['entryStore']            = $this->language->get('entryStore');
        $data['entry_image']           = $this->language->get('entry_image');
        $data['entrySortOrder']        = $this->language->get('entrySortOrder');
        $data['entryPublish']          = $this->language->get('entryPublish');
        $data['entryPublishDate']      = $this->language->get('entryPublishDate');

        $data['helpKeyword'] = $this->language->get('helpKeyword');
        $data['helpBottom']  = $this->language->get('helpBottom');

        $data['button_save']   = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_data']    = $this->language->get('tab_data');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['errorTitle'] = $this->error['title'];
        } else {
            $data['errorTitle'] = array();
        }

        if (isset($this->error['description'])) {
            $data['errorDescription'] = $this->error['description'];
        } else {
            $data['errorDescription'] = array();
        }

        if (isset($this->error['meta_title'])) {
            $data['errorMetaTitle'] = $this->error['meta_title'];
        } else {
            $data['errorMetaTitle'] = array();
        }

        if (isset($this->error['keyword'])) {
            $data['errorKeyword'] = $this->error['keyword'];
        } else {
            $data['errorKeyword'] = '';
        }

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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['information_id'])) {
            $data['action'] = $this->url->link('catalog/information/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('catalog/information/edit', 'token=' . $this->session->data['token'] . '&information_id=' . $this->request->get['information_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['information_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $informationInfo = $this->model_catalog_information->getInformation($this->request->get['information_id']);
        }

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['information_description'])) {
            $data['informationDescription'] = $this->request->post['information_description'];
        } elseif (isset($this->request->get['information_id'])) {
            $data['informationDescription'] = $this->model_catalog_information->getInformationDescriptions($this->request->get['information_id']);
        } else {
            $data['informationDescription'] = array();
        }

        $this->load->model('catalog/category');
        
        $data['categories'] = $this->model_catalog_category->getCategories();

        $this->load->model('setting/store');

        $data['stores'] = $this->model_setting_store->getStores();

        if (isset($this->request->post['information_store'])) {
            $data['informationStore'] = $this->request->post['information_store'];
        } elseif (isset($this->request->get['information_id'])) {
            $data['informationStore'] = $this->model_catalog_information->getInformationStores($this->request->get['information_id']);
        } else {
            $data['informationStore'] = array();
        }
        
        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($informationInfo)) {
            $data['image'] = $informationInfo['image'];
        } else {
            $data['image'] = '';
        }
        
        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($informationInfo) && is_file(DIR_IMAGE . $informationInfo['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($informationInfo['image'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
    
        if (isset($this->request->post['keyword'])) {
            $data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($informationInfo)) {
            $data['keyword'] = $informationInfo['keyword'];
        } else {
            $data['keyword'] = '';
        }

        if (isset($this->request->post['publish'])) {
            $data['publish'] = $this->request->post['publish'];
        } elseif (!empty($informationInfo)) {
            $data['publish'] = $informationInfo['is_publish'];
        } else {
            $data['publish'] = 0;
        }
      
        if (isset($informationInfo['publish_date'])) {
            $data['publishDate'] = $informationInfo['publish_date'];
        } else {
            $data['publishDate'] = $this->language->get('text_no_publish_date');
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sortOrder'] = $this->request->post['sort_order'];
        } elseif (!empty($informationInfo)) {
            $data['sortOrder'] = $informationInfo['sort_order'];
        } else {
            $data['sortOrder'] = 0;
        }
        
        $data['header']     = $this->load->controller('common/header');
        $data['columnLeft'] = $this->load->controller('common/column_left');
        $data['footer']     = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/information_form.tpl', $data));
    }

    /**
     * Метод проверки на валидность формы
     *
     * @return array
     */
    protected function validateForm()
    {
        if (!$this->user->hasPermission('modify', 'catalog/information')) {
            $this->error['warning'] = $this->language->get('errorPermission');
        }

        foreach ($this->request->post['information_description'] as $languageId => $value) {
            if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$languageId] = $this->language->get('errorTitle');
            }

            if (utf8_strlen($value['description']) < 3) {
                $this->error['description'][$languageId] = $this->language->get('errorDescription');
            }

            if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
                $this->error['meta_title'][$languageId] = $this->language->get('errorMetaTitle');
            }
        }

        if (utf8_strlen($this->request->post['keyword']) > 0) {
            $this->load->model('catalog/url_alias');

            $urlAliasInfo = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

            if ($urlAliasInfo && isset($this->request->get['information_id']) && $urlAliasInfo['query'] != 'information_id=' . $this->request->get['information_id']) {
                $this->error['keyword'] = sprintf($this->language->get('errorKeyword'));
            }

            if ($urlAliasInfo && !isset($this->request->get['information_id'])) {
                $this->error['keyword'] = sprintf($this->language->get('errorKeyword'));
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    /**
     * Метод проверки на возможность удаления
     * 
     * @return array
     */
    protected function validateDelete()
    {
        if (!$this->user->hasPermission('modify', 'catalog/information')) {
            $this->error['warning'] = $this->language->get('errorPermission');
        }

        $this->load->model('setting/store');

        foreach ($this->request->post['selected'] as $informationId) {
            if ($this->config->get('config_account_id') == $informationId) {
                $this->error['warning'] = $this->language->get('errorAccount');
            }

            if ($this->config->get('config_checkout_id') == $informationId) {
                $this->error['warning'] = $this->language->get('errorCheckout');
            }

            if ($this->config->get('config_return_id') == $informationId) {
                $this->error['warning'] = $this->language->get('errorReturn');
            }

            $storeTotal = $this->model_setting_store->getTotalStoresByInformationId($informationId);

            if ($storeTotal) {
                $this->error['warning'] = sprintf($this->language->get('errorStore'), $storeTotal);
            }
        }

        return !$this->error;
    }
}