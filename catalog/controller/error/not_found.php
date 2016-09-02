<?php
/**
 * Контроллер страницы c 404 ошибкой
 *
 * PHP version 5.3
 *
 */
class ControllerErrorNotFound extends Controller
{
    /**
     * Метод первичной загрузки страницы
     */
    public function index()
    {
        $this->load->language('error/not_found');

        $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $meta_robot = array(
            'index'  => 'noindex',
            'follow' => 'follow'
        );
        $this->document->setMetaRobots($meta_robot);

        if (isset($this->request->get['route'])) {
            $url_data = $this->request->get;

            unset($url_data['_route_']);

            $route = $url_data['route'];

            unset($url_data['route']);

            $url = '';

            if ($url_data) {
                $url = '&' . urldecode(http_build_query($url_data, '', '&'));
            }

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($route, $url, $this->request->server['HTTPS'])
            );
        }

        $data['heading_title']  = $this->language->get('heading_title');
        $data['text_error']     = $this->language->get('text_error');
        $data['text_main']      = $this->language->get('text_main');

        $data['footer']         = $this->load->controller('common/footer');
        $data['header']         = $this->load->controller('common/header');

        $data['href_home'] = $this->url->link('common/home');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
        }
    }

}
