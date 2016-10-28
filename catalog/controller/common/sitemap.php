<?php

class ControllerCommonSitemap extends Controller {
    public function index() {
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');

        $data = array();

        $data['home'] = $this->url->link('common/home');

        $categories = $this->model_catalog_category->getCategoriesForSiteMap();

        foreach ($categories as $category) {
            $data['categories'][] = array(
                'href' => $this->url->link('product/category', 'category_id=' . $category['category_id'])
            );
        }

        $products = $this->model_catalog_product->getProductsForSiteMap();

        foreach ($products as $product) {
            $data['products'][] = array(
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                'date' => $product['date_modified']
            );
        }

        if (!empty($data)) {
            $filename = DIR_TEMP . 'sitemap.xml';
            $this->siteMap($data);
            $this->response->clearHeader();
            $this->response->addHeader('Content-Type: application/xml; charset=utf-8');
            $this->response->setOutput(file_get_contents($filename));
        } else {
            exit('There are no data to create xml files.');
        }
    }

    public function siteMap($data)
    {
        $temp_file = DIR_TEMP . 'sitemap_temp.xml';

        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->setIndent(true);
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('urlset');
        $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 '
            . 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        if (isset($data['home'])) {
            $xmlWriter->startElement('url');
            $xmlWriter->writeElement('loc', str_replace(' ', '', $data['home']));
            $xmlWriter->writeElement('changefreq', 'monthly');
            $xmlWriter->writeElement('priority', 1);
            $xmlWriter->endElement();
        }

        foreach($data['categories'] as $category) {
            $xmlWriter->startElement('url');
            $xmlWriter->writeElement('loc', str_replace(' ', '', $category['href']));
            $xmlWriter->writeElement('changefreq', 'monthly');
            $xmlWriter->writeElement('priority', 0.9);
            $xmlWriter->endElement();
        }

        $i = 0;

        foreach ($data['products'] as $product) {
            $i++;

            if (0 == $i % 100) {
                file_put_contents($temp_file, $xmlWriter->flush(true), FILE_APPEND);
            }

            $xmlWriter->startElement('url');
            $xmlWriter->writeElement('loc', str_replace(' ', '', $product['href']));
            $xmlWriter->writeElement('changefreq', 'weekly');
            $xmlWriter->writeElement('priority', 0.8);
            $xmlWriter->writeElement('lastmod', $product['date']);
            $xmlWriter->endElement();
        }

        $xmlWriter->endElement();

        file_put_contents($temp_file, $xmlWriter->flush(true), FILE_APPEND);

        $this->finalize($temp_file);
    }

    /**
     * Удаление темповых файлов и сохранение в файлы для скачки
     */
    public function finalize($temp_file)
    {
        if (file_exists(DIR_ROOT . 'sitemap.xml')) {
            unlink(DIR_ROOT . 'sitemap.xml');
        }

        rename($temp_file, DIR_ROOT . 'sitemap.xml');
    }
}