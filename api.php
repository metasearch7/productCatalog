<?php
  
  /*
   * category.list
   * category.add=[cat_name]
   * category.edit=[cat_id]/[cat_name]
   * category.delete=[cat_id]
   * product.get=[cat_id]
   * product.add=[product_name]/[product_price]/[cat1,cat2...]
   * product.edit=[product_id]/[product_name]/[product_price]/[cat1,cat2...]
   * product.delete=[product_id]
   * login=[username]/[password]
   * 
   */

  error_reporting(-1);

  require('core/Db.php');
  require('core/Product.php');
  require('core/Error.php');
  require('core/Router.php');
  require('core/View.php');
  require('core/Controller.php');
  require('libs/Debug.php');
  require('controllers/Category.php');
  
  
  $query = $_REQUEST;
  Router::dispatch($query);