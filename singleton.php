<?php
  
  //共用类的静态变量得到实例化，通过私有变量访问相关资源, 应用于数据库链接，日志记录等一个业务线上

  class DatabaseConnection
  {
      private $_handle = null;
      public static $db = null;

      public static function get()
      {
            if ($db == null)
                $db = new DatabaseConnection();

            return $db->_handle;
      }

      private function __construct()
      {
            $dsn = 'mysql://root:password@localhost/photos';
            $this->_handle =& DB::Connect($dsn, array());
      }
  }

  print("Handle = ".DatabaseConnection::get()."\n");
  print("Handle = ".DatabaseConnection::get()."\n");
