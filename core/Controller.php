<?php
  class Controller
  {
    public $query = [];
    public $params = '';
    public $view;
    public $vars = [];

    public function __construct($query, $params)
    {
      $this->query = $query;
      $this->params = $params;
      $this->view = $query['method'];
    }

    public function getView()
    {
      $viewObject = new View($this->query, $this->view);
      $viewObject->render($this->vars);
    }

    public function set($vars)
    {
      $this->vars = $vars;
    }

  }