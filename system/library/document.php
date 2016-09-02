<?php

/**
 *
 */
class Document {
	private $title;
	private $description;
	private $keywords;
	private $links = array();
	private $styles = array();
	private $scripts = array();

    /**
     * Переменная, для методов setBreadcrumbs и getBreadcrumbs
     *
     * @var array
     */
    private $breadcrumbs = array();
    
    /**
     * Переменная, для методов setCategoryList и getCategoryList
     *
     * @var boolean
     */
    private $category_list = false;

    /**
     * Переменная, для методов setMetaRobots и getMetaRobots
     *
     * @var boolean
     */
    private $meta_robots= false;

    /**
     * Переменная, для методов setYashare и getYashare
     */
    private $yashare;

    /**
     * Переменная, для методов setOpenGraph и getOpenGraph
     */
    private $open_graph;

    /**
     * Флаг цвета страницы
     *
     * @var array
     */
    private $page_options = array(
        'class' => ' page-wrapper',
        'sidebar_colour' => 'black',
        'col_class' => 'col-xs-12 col-sm-10 col-sm-offset-2 main',
        'style_string' => ''
    );
    

    public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function addLink($href, $rel) {
		$this->links[$href] = array(
			'href' => $href,
			'rel'  => $rel
		);
	}

	public function getLinks() {
		return $this->links;
	}

	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		$this->styles[$href] = array(
			'href'  => $href,
			'rel'   => $rel,
			'media' => $media
		);
	}

	public function getStyles() {
		return $this->styles;
	}

    /**
     * Метод передачи скриптов для страницы
     * 
     * @param string $script
     */
    public function addScript($script)
    {
        $this->scripts[$script] = $script;
    }

    /**
     * Метод получения скриптов для страницы
     * 
     * @return array
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * Метод для передачи бредкрамбов в обьект глобального класса Document
     *
     * @param array $data
     *
     * @return array
     */
    public function setBreadcrumbs($data = array())
    {
        return $this->breadcrumbs = $data;
    }

    /**
     * Метод для получения бредкрамбов из обьекта глобально класса Document
     *
     * @return array
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * Метод для передачи выведение meta robots
     *
     * @param array $data
     *
     * @return array
     */
    public function setMetaRobots($data = array())
    {
        return $this->meta_robots = array(
            'index'  => $data['index'],
            'follow' => $data['follow']
        );
    }

    /**
     * Метод определяющий выведение meta robots
     *
     * @return boolean
     */
    public function getMetaRobots()
    {
        return $this->meta_robots;
    }

    /**
     * Метод для передачи yashare
     *
     * @param array $data
     *
     * @return array
     */
    public function setYashare($data)
    {
        return $this->yashare = $data;
    }

    /**
     * Метод получения yashare
     *
     * @return array
     */
    public function getYashare()
    {
        return $this->yashare;
    }

    /**
     * Метод для передачи open graph
     *
     * @param array $data
     *
     * @return array
     */
    public function setOpenGraph($data)
    {
        return $this->open_graph = $data;
    }

    /**
     * Метод получения open graph
     *
     * @return array
     */
    public function getOpenGraph()
    {
        return $this->open_graph;
    }


    /**
     * Метод для передачи page_options
     *
     * @param array $page_options
     *
     * @return array
     */
    public function setPageOptions($page_options)
    {
        $this->page_options = $page_options;
    }

    /**
     * Метод получения page_options
     *
     * @return array
     */
    public function getPageOptions()
    {
        return $this->page_options;
    }

}