<?php
  class View
  {
    public $query = [];
    public $view;

    public function __construct($query, $view = '')
    {
      $this->query = $query;
      $this->view = $view;
    }

    public function render($vars)
    {
      if (is_array($vars)) {
        extract($vars);
      }
      $file_view = 'views/'.$this->query['controller'].'/'.$this->view.'.php';
      if(is_file($file_view)) {
        require($file_view);
      } else {
        echo "Вид $file_view не найден";
      }

    }
  }