<?php
/**
 * Контроллер страницы Товаров
 *
 */
class ControllerCatalogProduct extends Controller
{
    /**
     * @var array       
     */
    private $error = array();
    /**
     * Метод первичной загрузки страницы
     */
    public function index()
    {
        $this->load->language('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        $this->getList();
    }

    /**
     * Метод добавления нового товара
     */
    public function add()
    {
        $this->load->language('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_product->addProduct($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_product_kod'])) {
                $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод редактирования существующего товара
     */
    public function edit()
    {
        $this->load->language('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_product_kod'])) {
                $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    /**
     * Метод удаления существующего товара
     */
    public function delete()
    {
        $this->load->language('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product->deleteProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_product_kod'])) {
                $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    /**
     * Метод для копирования товаров
     */
    public function copy()
    {
        $this->load->language('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (isset($this->request->post['selected']) && $this->validateCopy()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product->copyProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_product_kod'])) {
                $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    /**
     * Метод для вывода списка товаров
     */
    protected function getList()
    {
        
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_model'])) {
            $filter_model = $this->request->get['filter_model'];
        } else {
            $filter_model = null;
        }
        
        if (isset($this->request->get['filter_category'])) {
            $filter_category = $this->request->get['filter_category'];
        } else {
            $filter_category = null;
        }

        if (isset($this->request->get['filter_price'])) {
            $filter_price = $this->request->get['filter_price'];
        } else {
            $filter_price = null;
        }

        if (isset($this->request->get['filter_product_kod'])) {
            $filter_product_kod = $this->request->get['filter_product_kod'];
        } else {
            $filter_product_kod = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.name';
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

        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_product_kod'])) {
            $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
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
            'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['products'] = array();

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_category' => $filter_category,
            'filter_model' => $filter_model,
            'filter_price' => $filter_price,
            'filter_product_kod' => $filter_product_kod,
            'filter_status' => $filter_status,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $this->load->model('tool/image');

        $product_total = $this->model_catalog_product->getTotalProducts($filter_data);

        $results = $this->model_catalog_product->getProducts($filter_data);

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], 40, 40);
            } else {
                $image = $this->model_tool_image->resize('no_image.png', 40, 40);
            }

            $special = false;

            $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

            foreach ($product_specials as $product_special) {
                if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
                    $special = $product_special['price'];

                    break;
                }
            }

            $data['products'][] = array(
                'product_id'    => $result['product_id'],
                'image'         => $image,
                'name'          => $result['product_name'],
                'category_name' => $result['category_name'],
                'model'         => $result['model'],
                'price'         => $result['price'],
                'special'       => $special,
                'status'        => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'edit'          => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_image']     = $this->language->get('column_image');
        $data['column_name']      = $this->language->get('column_name');
        $data['column_model']     = $this->language->get('column_model');
        $data['column_category']  = $this->language->get('column_category');
        $data['column_price'] = $this->language->get('column_price');
        $data['column_quantity']  = $this->language->get('column_quantity');
        $data['column_status']    = $this->language->get('column_status');
        $data['column_action']    = $this->language->get('column_action');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_category_filter'] = $this->language->get('entry_category_filter');
        $data['entry_model'] = $this->language->get('entry_model');
        $data['entry_price'] = $this->language->get('entry_price');
        $data['entry_product_kod'] = $this->language->get('entry_product_kod');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_copy'] = $this->language->get('button_copy');
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

        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_product_kod'])) {
            $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
        $data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
        $data['sort_category'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=category_name' . $url, 'SSL');
        $data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
        $data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_product_kod'])) {
            $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
        }

        if (isset($this->request->get['filter_quantity'])) {
            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

        $data['filter_name'] = $filter_name;
        $data['filter_category'] = $filter_category;
        $data['filter_model'] = $filter_model;
        $data['filter_price'] = $filter_price;
        $data['filter_product_kod'] = $filter_product_kod;
        $data['filter_status'] = $filter_status;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/product_list.tpl', $data));
    }

    /**
     * Метод для вывода формы добавления\редактирования товара
     */
    protected function getForm()
    {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_plus'] = $this->language->get('text_plus');
        $data['text_minus'] = $this->language->get('text_minus');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_option'] = $this->language->get('text_option');
        $data['text_option_value'] = $this->language->get('text_option_value');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_percent'] = $this->language->get('text_percent');
        $data['text_amount'] = $this->language->get('text_amount');
        $data['text_in_stock'] = $this->language->get('text_in_stock');

        $data['entry_name']             = $this->language->get('entry_name');
        $data['entry_description']      = $this->language->get('entry_description');
        $data['entry_meta_title']       = $this->language->get('entry_meta_title');
        $data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $data['entry_meta_keyword']     = $this->language->get('entry_meta_keyword');
        $data['entry_keyword']          = $this->language->get('entry_keyword');
        $data['entry_model']            = $this->language->get('entry_model');
        $data['entry_stock_status']     = $this->language->get('entry_stock_status');
        $data['entry_price']            = $this->language->get('entry_price');
        $data['entry_tax_class']        = $this->language->get('entry_tax_class');
        $data['entry_image']            = $this->language->get('entry_image');
        $data['entry_store']            = $this->language->get('entry_store');
        $data['entry_category']         = $this->language->get('entry_category');
        $data['entry_text']             = $this->language->get('entry_text');
        $data['entry_required']         = $this->language->get('entry_required');
        $data['entry_sort_order']       = $this->language->get('entry_sort_order');
        $data['entry_status']           = $this->language->get('entry_status');
        $data['entry_date_start']       = $this->language->get('entry_date_start');
        $data['entry_date_end']         = $this->language->get('entry_date_end');
        $data['entry_priority']         = $this->language->get('entry_priority');
  
        $data['entry_customer_group']   = $this->language->get('entry_customer_group');
        $data['entry_layout']           = $this->language->get('entry_layout');
        $data['entry_product_name']     = $this->language->get('entry_product_name');
        $data['entry_discount_value']   = $this->language->get('entry_discount_value');
        $data['entry_bonus_value']      = $this->language->get('entry_bonus_value');
        $data['entry_information']      = $this->language->get('entry_information');
        $data['entry_article']          = $this->language->get('entry_article');
        $data['entry_additional_category'] = $this->language->get('entry_additional_category');
                
        $data['help_keyword'] = $this->language->get('help_keyword');
        $data['help_stock_status'] = $this->language->get('help_stock_status');
        $data['help_category'] = $this->language->get('help_category');
     
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_discount_add'] = $this->language->get('button_discount_add');
        $data['button_special_add'] = $this->language->get('button_special_add');
        $data['button_image_add'] = $this->language->get('button_image_add');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_data'] = $this->language->get('tab_data');
        $data['tab_parameters'] = $this->language->get('tab_parameters');
        $data['tab_special'] = $this->language->get('tab_special');
        $data['tab_image'] = $this->language->get('tab_image');
        $data['tab_links'] = $this->language->get('tab_links');
        $data['tab_design'] = $this->language->get('tab_design');
        $data['tab_complect'] = $this->language->get('tab_complect');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = array();
        }

        if (isset($this->error['meta_title'])) {
            $data['error_meta_title'] = $this->error['meta_title'];
        } else {
            $data['error_meta_title'] = array();
        }

        if (isset($this->error['model'])) {
            $data['error_model'] = $this->error['model'];
        } else {
            $data['error_model'] = '';
        }

        if (isset($this->error['keyword'])) {
            $data['error_keyword'] = $this->error['keyword'];
        } else {
            $data['error_keyword'] = '';
        }
        
        if (isset($this->request->get['product_id'])) {
            $data['product_id'] = $this->request->get['product_id'];
        } else {
            $data['product_id'] = false;
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_product_kod'])) {
            $url .= '&filter_product_kod=' . $this->request->get['filter_product_kod'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
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
            'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['product_id'])) {
            $data['action'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
        }

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['product_description'])) {
            $data['product_description'] = $this->request->post['product_description'];
        } elseif (isset($this->request->get['product_id'])) {
            $data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
        } else {
            $data['product_description'] = array();
        }

        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($product_info)) {
            $data['image'] = $product_info['image'];
        } else {
            $data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['model'])) {
            $data['model'] = $this->request->post['model'];
        } elseif (!empty($product_info)) {
            $data['model'] = $product_info['model'];
        } else {
            $data['model'] = '';
        }
        
        if (isset($this->request->post['article'])) {
            $data['article'] = $this->request->post['article'];
        } elseif (!empty($product_info)) {
            $data['article'] = $product_info['article'];
        } else {
            $data['article'] = '';
        }

        $this->load->model('setting/store');

        $data['stores'] = $this->model_setting_store->getStores();

        if (isset($this->request->post['product_store'])) {
            $data['product_store'] = $this->request->post['product_store'];
        } elseif (isset($this->request->get['product_id'])) {
            $data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
        } else {
            $data['product_store'] = array(0);
        }

        if (isset($this->request->post['keyword'])) {
            $data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($product_info)) {
            $data['keyword'] = $product_info['keyword'];
        } else {
            $data['keyword'] = '';
        }

        if (isset($this->request->post['in_stock'])) {
            $data['in_stock'] = $this->request->post['in_stock'];
        } elseif (!empty($product_info)) {
            $data['in_stock'] = $product_info['in_stock'];
        } else {
            $data['in_stock'] = 1;
        }

        if (isset($this->request->post['price'])) {
            $data['price']     = $this->request->post['price'];
        } elseif (!empty($product_info)) {
            $data['price']     = $product_info['price'];
        } else {
            $data['price']     = '';
        }

        $this->load->model('catalog/information');
        
        $data['informations'] = $this->model_catalog_information->getInformations();
        
        $this->load->model('localisation/tax_class');

        $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($product_info)) {
            $data['sort_order'] = $product_info['sort_order'];
        } else {
            $data['sort_order'] = 1;
        }

        $this->load->model('localisation/stock_status');

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($product_info)) {
            $data['status'] = $product_info['status'];
        } else {
            $data['status'] = true;
        }

        // Categories
        $this->load->model('catalog/category');

        if (isset($this->request->post['product_categoires'])) {
            $categories = $this->request->post['product_categoires'];
        } elseif (isset($this->request->get['product_id'])) {
            $categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
        } else {
            $categories = array();
        }

        $data['product_categories'] = array();

        if ($categories) {
            foreach ($categories as $category) { 
                $category_info = $this->model_catalog_category->getCategory($category['category_id']);

                if ($category_info) {
                    $data['product_categories'][$category_info['category_id']] = array(
                        'category_id' => $category_info['category_id'],
                        'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
                    );
                }
            }
        }

        // Parameters

        if (isset($this->request->get['product_id'])) {

            $this->load->model('catalog/product_parameter');

            if (isset($this->request->post['product_parameters'])) {
                $product_parameters = $this->request->post['product_parameters'];
            } elseif (isset($this->request->get['product_id'])) {
                $product_parameters = $this->model_catalog_product_parameter->getParametersForProduct($this->request->get['product_id']);
            } else {
                $product_parameters = array();
            }

            $data['product_param'] = array();

            $product_param = $this->model_catalog_product_parameter->getProductParametersValues($this->request->get['product_id']);

            foreach ($product_param as $param) {
                $data['product_param'][] = $param['param_value_id'];
            }

            $data['product_parameters'] = array();

            foreach ($product_parameters as $parameter) {
                $values = $this->model_catalog_product_parameter->getParameterValues($parameter['param_id']);

                $data['product_parameters'][$parameter['param_id']] = array(
                    'param_id' => $parameter['param_id'],
                    'name' => $parameter['name'],
                    'param_values' => $values
                );
            }
        }

        $this->load->model('sale/customer_group');

        $data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

        if (isset($this->request->post['product_special'])) {
            $product_specials = $this->request->post['product_special'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_specials = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
        } else {
            $product_specials = array();
        }

        $data['product_specials'] = array();

        foreach ($product_specials as $product_special) {
            $data['product_specials'][] = array(
                'customer_group_id' => $product_special['customer_group_id'],
                'priority' => $product_special['priority'],
                'price' => $product_special['price'],
                'date_start' => ($product_special['date_start'] != '0000-00-00') ? $product_special['date_start'] : '',
                'date_end' => ($product_special['date_end'] != '0000-00-00') ? $product_special['date_end'] : ''
            );
        }

        // Images
        if (isset($this->request->post['product_image'])) {
            $product_images = $this->request->post['product_image'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
        } else {
            $product_images = array();
        }

        $data['product_images'] = array();

        foreach ($product_images as $product_image) {
            if (is_file(DIR_IMAGE . $product_image['image'])) {
                $image = $product_image['image'];
                $thumb = $product_image['image'];
            } else {
                $image = '';
                $thumb = 'no_image.png';
            }

            $data['product_images'][] = array(
                'image' => $image,
                'thumb' => $this->model_tool_image->resize($thumb, 100, 100),
                'sort_order' => $product_image['sort_order']
            );
        }


        if (isset($this->request->post['product_layout'])) {
            $data['product_layout'] = $this->request->post['product_layout'];
        } elseif (isset($this->request->get['product_id'])) {
            $data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
        } else {
            $data['product_layout'] = array();
        }

        $this->load->model('design/layout');

        $data['layouts'] = $this->model_design_layout->getLayouts();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/product_form.tpl', $data));
    }

    /**
     * Метод для проверки на корректность заполнения формы добалвения товара
     * 
     * @return array||false
     */
    protected function validateForm()
    {
        if (!$this->user->hasPermission('modify', 'catalog/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['product_description'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if (utf8_strlen($this->request->post['keyword']) > 0) {
            $this->load->model('catalog/url_alias');

            $url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

            if ($url_alias_info && isset($this->request->get['product_id']) && $url_alias_info['query'] != 'product_id=' . $this->request->get['product_id']) {
                $this->error['keyword'] = sprintf($this->language->get('error_keyword'));
            }

            if ($url_alias_info && !isset($this->request->get['product_id'])) {
                $this->error['keyword'] = sprintf($this->language->get('error_keyword'));
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    /**
     * Метод проверки прав полномочий для удаления товара
     * 
     * @return true||false
     */
    protected function validateDelete()
    {
        if (!$this->user->hasPermission('modify', 'catalog/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    /**
     * Метод проверки прав полномочий для копирования товара
     * 
     * @return true||false
     */
    protected function validateCopy()
    {
        if (!$this->user->hasPermission('modify', 'catalog/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    /**
     * Метод для автозаполнения некоторы полей формы
     * 
     * return json array
     */
    public function autocomplete()
    {
        $json = array();
        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
            $this->load->model('catalog/product');
            $this->load->model('catalog/option');

            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['filter_model'])) {
                $filter_model = $this->request->get['filter_model'];
            } else {
                $filter_model = '';
            }

            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 5;
            }

            $filter_data = array(
                'filter_name' => $filter_name,
                'filter_model' => $filter_model,
                'start' => 0,
                'limit' => $limit
            );

            $results = $this->model_catalog_product->getProducts($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'product_id' => $result['product_id'],
                    'name' => strip_tags(html_entity_decode($result['product_name'], ENT_QUOTES, 'UTF-8')),
                    'model' => $result['model'],
                    'price' => $result['price']
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
