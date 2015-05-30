<?php

/**
*    不要按照已有的架子，要整懂来龙去脉
*    面试人需要做：
*    1. 让其写代码，看其代码的正确，规范，工整。
*    2. 提问问题，一个一个深入，从简单的认知到为什么，考察他对新问题的思考能力
*
*    直接写代码到纸上，不要停留在会上面，而且代码要工整含有注释
*    先精通一门语言，PHP，啥都可以先那这个来展开, 熟悉C/C++，了解GO，Java
*    this是指向对象实例的一个指针，在实例化的时候来确定指向；
*    self是对类本身的一个引用，一般用来指向类中的静态变量；
*    parent是对父类的引用，一般使用parent来调用父类的构造函数。
*    this后不加变量$, self后面加变量$
*/

/**
*    Base Class
*/
class Base
{
    function __construct()
    {
        echo "Parent contruct\n";
    }

    function __destruct()
    {
        echo "Parent destruct\n";
    }
};

/**
*    singleton modle
*/
class Sub extends Base
{
    private static $instance = NULL;

    function __construct($id)
    {
        parent::__construct();
        echo "sub class contruct \n";
    }

    function __destruct()
    {
        echo "sub class destruct \n";
        parent::__destruct();
    }

    function __set($field, $value)
    {
        echo "Unknow set {$field} {$value}\n";
    }

    function __get($field)
    {
        return "Unknow {$field} variable\n";
    }
/*
    function __call($method, $args)
    {
        $argStr = implode(',', $args);
        return "Unknow {$method} function {$argStr}\n";
    }
*/
    function say()
    {
        echo "Say hello world\n";
    }

    //Get class instance
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $class = __CLASS__;
            self::$instance = new $class(0);
        }

        return self::$instance;
    }
}

echo Sub::getInstance()->name;
Sub::getInstance()->name = 10;
