<?php

    //对于某业务，不同动作可以抽象出相同的方法来，可以采用工厂模式
    
    //工厂模式，实际操作动作(各自单独的类)去实现接口方法, 工厂只负责调配不同动作，后续业务扩展直接添加动作类即可
    //像微博的发私信，关注，评论这些其实可以抽象到应用工厂模式

    interface Queue_Adapter
    {
        /**
        *    queue connect
        *    @config array
        */
        public function connect($config);

        /**
        *    pop queue
        *    @handle object
        *    @key string
        */
        public function popqueue($handle, $key);
    }

    //create mcq.php
    class Queue_Adapter_MCQ implements Queue_Adapter
    {
        private static $mcq_link;

        /**
        *
        */
        public static function getConnector($config)
        {
            if (!isset(self::$mcq_link))
                slef::$mcq_link = $this->connect($config);

            return self::$mcq_link;
        }

        /**
        *    Queue connect
        *    @config array
        *    @return resource
        */
        public function connect($config)
        {
            $this->_connect($config);
        }

        /**
        *    pop queue
        *    @handle object
        *    @key string
        */
        public function popqueue($handle, $key){};
    }

    //create redis.php
    class Queue_Adapter_REDIS implements Queue_Adapter
    {
        private static $redis_link;

        /**
        *
        */
        public static function getConnector($config)
        {
            if (!isset(self::$redis_link))
                slef::$redis_link = $this->connect($config);

            return self::$redis_link;
        }

        /**
        *    Queue connect
        *    @config array
        *    @return resource
        */
        public function connect($config)
        {
            $this->_connect($config);
        }

        /**
        *    pop queue
        *    @handle object
        *    @key string
        */
        public function popqueue($handle, $key){};
    }

    class Factory
    {
        public static function factory($type)
        {
            //require_once 和 include_once的区别是，req找不到文件会报fatal error，而inc会报warning
            $className = "Queue_Adapter_{$type}";
            $ret = require_once($className);

            if (ret)
                return new $className;
            else
                throw new Exception ('Driver not found');
        }
    }

