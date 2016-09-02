<?php

/**
 * Controller
 *
 */
abstract class Controller
{
    protected $registry;
    protected $args;

    /**
     * Конструкток класса Controller
     * 
     * @param array $registry
     * @param array $args
     */
    public function __construct($registry, $args = array())
    {
        $this->registry = $registry;
        $this->args     = $args;
    }

    /**
     * get
     * 
     * @param array $key
     * @return array
     */
    public function __get($key)
    {
        return $this->registry->get($key);
    }

    /**
     * set
     * 
     * @param array $key
     * @param array $value
     */
    public function __set($key, $value)
    {
        $this->registry->set($key, $value);
    }

    /**
     * Метод возвращает параметры контроллера
     * 
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }
}