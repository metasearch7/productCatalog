<?php
  class Errors
  {
    protected static $errors = array(
      '1' => 'Invalid request',
      '2' => 'Invalid parameters',
      '3' => 'Invalid controller',
      '4' => 'Invalid method'
    );

    public static function get($errorCode)
    {
      $errorJson = json_encode(['errorCode' => $errorCode, 'errorMessage' => self::$errors[$errorCode]]);
      exit($errorJson);
    }
  }