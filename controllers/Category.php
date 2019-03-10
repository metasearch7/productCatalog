<?php
class Category extends Controller
{
  public function listAction() {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM category';
    $categoryList = $db->selectAll($sql);
    $this->set(compact('categoryList'));
  }
  
  public function addAction(string $name = '')
  {
    $json = $this->params;
    $this->set(compact('json'));
    echo 'Класс <b>'.__CLASS__.'</b>, метод '. __METHOD__ .'<br>';
  }

  public function editAction(int $id = NULL, string $name = '')
  {
    echo 'Класс <b>'.__CLASS__.'</b>, метод '. __METHOD__ .'<br>';
  }

  public function deleteAction(int $id = NULL)
  {
    echo 'Класс <b>'.__CLASS__.'</b>, метод '. __METHOD__ .'<br>';
  }

}