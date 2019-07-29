<?php

namespace App\controllers;

/**
 * Description of Controller
 */
abstract class Controller
{
    /**
     * @var mixed
     */
    public $layout = null;

    /**
     * @var string
     */
    public $view;

    /**
     * @var array
     */
    public $data = array();

    
    /**
     * Load view
     *
     * @param string $view
     */
    public function view($view = 'index', $data = null)
    {
        $this->view = $view;
        $content = '[VIEW]';

        if($this->layout) {
            ob_start();
            include APP_PATH . "views/layout/{$this->layout}.php";
            $content = ob_get_clean();
        }

        ob_start();
        include APP_PATH . 'views/' . $view . '.php';
        $viewContent = ob_get_clean();

        $page = str_replace("[VIEW]", $viewContent, $content);

        echo $page;
    }
}