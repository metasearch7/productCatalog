<?php
  class DB
  {
    protected $pdo;
    protected static $_instance = NULL;
    
    protected function __construct ()
    {
      $dbtype = 'mysql';
      $dbname = 'symfony';
      $username = 'symfony';
      $password = 'symfony';
      $this->pdo = new \PDO($dbtype.':host=localhost;dbname='.$dbname, $username, $password);
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    private function __clone () {}
    private function __wakeup () {}

    public static function getInstance()
    {
      if (self::$_instance === NULL) {
        self::$_instance = new self;
      }
      return self::$_instance;
    }

    public function execute($sql, $params = [])
    {
      $stmt = $this->pdo->prepare($sql);
      $res = $stmt->execute($params);
      return $this->pdo->lastInsertId();
    }

    public function select($sql, $params = [])
    {
      $stmt = $this->pdo->prepare($sql);
      $res = $stmt->execute($params);
      return $stmt->fetch(PDO::FETCH_LAZY);
    }

    public function selectAll($sql, $params = [])
    {
      $stmt = $this->pdo->prepare($sql);
      $res = $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  }