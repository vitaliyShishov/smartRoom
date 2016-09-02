<?php

class ControllerCommonFooter extends Controller
{

    /**
     * Метод для вывода footer
     *
     * @return footer.tpl
     */
    public function index()
    {
        $this->load->model('tool/image');
        $data['logo_white'] = $this->model_tool_image->resize($this->config->get('config_logo_white'),$this->config->get('config_image_logo_width'), $this->config->get('config_image_logo_height'));

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
        } else {
            return $this->load->view('default/template/common/footer.tpl', $data);
        }
    }
}
