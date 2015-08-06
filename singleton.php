<?php
	class Mysql
	{
		//必须声明为静态变量，这样访问者不用创建对象而可以直接访问
		private static $_conn;
		private $_handle;

		private $_host = "xxxx:10922";
		private $_user = "xxx";
		private $_pwd = "xxxxxx";
		
		//声明为私有函数，外层无法直接创建对象
		private function __construct()
		{
			$this->_handle = mysql_connect($this->_host, $this->_user, $this->_pwd);

			if (!$this->_handle)
				die('Could not connect: ' . mysql_error());		
		}

		public function __destruct()
		{
			if ($this->_handle)
				mysql_close($this->_handle);
		}

		public static function getInstance()
		{
			if (!self::$_conn instanceof self)
			{
				self::$_conn = new self;
			}

			return self::$_conn;
		}

		public function __clone()
		{
			trigger_error("Clone not allow!");
		}

		public function query($sql)
		{	
			$rs = mysql_query($sql, $this->_handle);

		 	while (($row=mysql_fetch_assoc($rs))!==false)
			{
			        print_r($row);
			}

			mysql_free_result($rs);			 
		}
	}

	$mysql = Mysql::getInstance();
	$sql = "SELECT * FROM `contact_0` . `user_phone_0` LIMIT 0, 10";
	$mysql->query($sql);
