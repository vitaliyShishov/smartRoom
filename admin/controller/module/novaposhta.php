<?php

/**
 * Контроллер работы с библиотекой Новой Почты
 *
 * PHP version 5.3
 */
class ControllerModuleNovaposhta extends Controller
{

    /**
     * Метод вывода autocomplete городов
     *
     * @return array
     */
    public function index()
    {
        $json = array();

        if (mb_strlen(trim($this->request->get['city_name'])) >= 3) {
            $cities_array = $this->apinovaposhta->getCities();

            $city_name = mb_strtolower($this->request->get['city_name']);
            $count = strlen($city_name);

            foreach ($cities_array['data'] as $city) {

                if (substr(mb_strtolower($city['DescriptionRu']), 0, $count) == $city_name) {
                    $cities[] = $city['DescriptionRu'];
                }
            }

            $json = array_slice($cities, 0, 10);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * Метод вывода складов Новой почты
     */
    public function getWarehouses()
    {
        $json = array();
        
        $ref = $this->getCity($this->request->post['ref']);
        
        $data['warehouses'] = $this->apinovaposhta->getWarehouses($ref);

        foreach ($data['warehouses']['data'] as $key => $warehouse) {
            $json[] = $warehouse['DescriptionRu'];
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    /**
     * Метод получения Ref по имени города
     */
    public function getCity($name)
    {        
        $city = $this->apinovaposhta->getCitiesByName($name);

        if ($city['data'][0]['Ref']) {
        
            return $city['data'][0]['Ref'];
        }
    }
}