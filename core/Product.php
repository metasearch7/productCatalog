<?php
  class Product implements JsonSerializable
  {
    private $id = NULL;
    private $name = NULL;
    private $price = NULL;
    private $categories = array();
  
    public function jsonSerialize() {
      return array(
        'id' => $this->id,
        'name' => $this->name,
        'price' => $this->price,
        'categories' => $this->categories
      );
    }

    public function getName()
    {
      return $this->name;
    }

    public function getPrice()
    {
      return $this->price;
    }

    public function setName($name)
    {
      $this->name = $name;
    }

    public function setPrice($price)
    {
      $this->price = $price;
    }

    public function setCategories($categories = array())
    {
      $this->categories = $categories;
    }

    public function getCategories()
    {
      return $this->categories;
    }

    public function save()
    {
      $db = DB::getInstance();
      if (!$this->id) {
        $sql = 'INSERT INTO product (name, price) VALUES (?, ?)';
        $params = array($this->name, $this->price);
        $lastId = $db->execute($sql, $params);

        if ($this->categories) {
          foreach($this->categories as $category) {
            $sql = 'INSERT INTO product_category (pid, cid) VALUES (?, ?)';
            $params = array($lastId, $category);
            $db->execute($sql, $params);
          }
        }
      } else {
        $sql = 'UPDATE product SET name = ?, price = ? WHERE id = ?';
        $params = array($this->name, $this->price, $this->id);
        $db->execute($sql, $params);

        if ($this->categories) {
          $sql = 'DELETE FROM product_category WHERE pid = ?';
          $db->execute($sql, [$this->id]);

          foreach($this->categories as $category) {
            $sql = 'INSERT INTO product_category (pid, cid) VALUES (?, ?)';
            $params = array($this->id, $category);
            $db->execute($sql, $params);
          }
        }

      }
      
    }

    public function load($id)
    {
      $db = DB::getInstance();
      $sql = 'SELECT * FROM product WHERE id = ?';
      $res = $db->select($sql, [$id]);
      if ($res) {
        $this->id = $res['id'];
        $this->name = $res['name'];
        $this->price = $res['price'];
      }
      
      $sql = 'SELECT * FROM product_category WHERE pid = ?';
      $res = $db->selectAll($sql, [$id]);
      foreach ($res as $category) {
        $this->categories[] = $category['cid'];
      }

    }

    public function delete($id)
    {
      $db = DB::getInstance();
      $sql = 'DELETE FROM product WHERE id = ?';
      $res = $db->execute($sql, [$id]);
      $sql = 'DELETE FROM product_category WHERE pid = ?';
      $res = $db->execute($sql, [$id]);
    }

  }