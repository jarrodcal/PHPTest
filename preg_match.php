<?php

    $url = '33317"><a href="http://blog.jobbole.com/category/startup/">创业</a></li><li id';

    //正则表达式需完全按照要匹配的顺序走，#代表的是规范，要对称
    preg_match_all("#<a[^>]*>([^<>]*)<\/a>#", $url, $matches);
    print_r($matches);

    //^ $是针对整个字符串, 按照字符串确实实际的匹配, {}代表次数
    $url = "abcd15011381805xyz";
    preg_match_all("#^\w{4}#", $url, $matches);

    //|的关系需要在()括号内部, 非[.com|.cn]这样的写法
    $url = "128324liqingfang126@126.com2323";
    preg_match("#\w*@\w*.(.com|.cn)#", $url, $matches);
    print_r($matches);
