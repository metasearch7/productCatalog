<?php
  class Router
  {
    protected static $query = [];
    protected static $params = [];
    
    public static function matchQuery($query) {
      if (count($query) > 0) {
        foreach ($query as $q => $params) {
          if (preg_match("#^(?P<controller>[a-z]+)!(?P<method>[a-z]+)$#i", $q, $matches)) {
            foreach ($matches as $k => $v) {
              if (is_string($k)) $tempQuery[$k] = $v;
            }
          } else {
            return FALSE;
          }

          $paramsObject = json_decode($params, TRUE);
          if ($paramsObject) {
            $tempParams = $paramsObject;
          }

          if (isset($tempQuery['controller'])) {
            $tempQuery['controller'] = ucfirst($tempQuery['controller']);
          }
          self::$query = $tempQuery;
          self::$params = isset($tempParams) ? $tempParams : [];
          return TRUE;
        }
      } else {
        return FALSE;
      }
    }
    
    public static function dispatch($url) {
      if (self::matchQuery($url)) {
//        debug(self::$params);
        $controller = self::$query['controller'];
        
        if (class_exists($controller)) {
          $controllerObject = new $controller(self::$query, self::$params);
          $method = self::$query['method'].'Action';
          if (method_exists($controllerObject, $method)) {
            $controllerObject->$method();
            $controllerObject->getView();
          } else {
            Errors::get(4);
          }
        } else {
          Errors::get(3);
        }
      } else {
        Errors::get(1);
      }
        
    }
  }