<?php

    $url = '33317"><a href="http://blog.jobbole.com/category/startup/">创业</a></li><li id';

    //正则表达式需完全按照要匹配的顺序走，#代表的是规范，要对称
    preg_match_all("#<a[^>]*>([^<>]*)<\/a>#", $url, $matches);
    
    //注意*的使用
    preg_match_all("#http:\/\/[^\/]*\/#", $url, $matches);
    print_r($matches);

    //^ $是针对整个字符串, 按照字符串确实实际的匹配, {}代表次数
    $url = "abcd15011381805xyz";
    preg_match_all("#^\w{4}#", $url, $matches);

    //|的关系需要在()括号内部, 非[.com|.cn]这样的写法
    $url = "128324liqingfang126@126.com2323";
    preg_match("#\w*@\w*.(.com|.cn)#", $url, $matches);
    print_r($matches);

    if(!preg_match(‘/^[\w.]+@([\w.]+)\.[a-z]{2,6}$/i’,$email))
    
    session_save_path($savePath);
    session_set_cookie_params($lifeTime);
    session_start();
    
    例如: http://www.sina.com.cn/abc/de/fg.php?id=1 需要取出 php 或 .php

答案1:

function getExt($url)
{
    $arr = parse_url($url);
    $file = basename($arr['path']);
    $ext = explode(“.”,$file);
    return $ext[1];
}

Varchar是变长，节省存储空间，char是固定长度。查找效率要char型快，因为varchar是非定长，必须先查找长度，然后进行数据的提取
比char定长类型多了一个步骤，所以效率低一些

function bubble_sort($array)
{
$count = count($array);
if ($count <= 0) return false;
for($i=0; $i<$count; $i++){
for($j=$count-1; $j>$i; $j–){
if ($array[$j] < $array[$j-1]){
$tmp = $array[$j];
$array[$j] = $array[$j-1];
$array[$j-1] = $tmp;
}
}
}
return $array;
}
//快速排序（数组排序）
function quicksort($array) {
if (count($array) <= 1) return $array;
$key = $array[0];
$left_arr = array();
$right_arr = array();
for ($i=1; $i<count($array); $i++){
if ($array[$i] <= $key)
$left_arr[] = $array[$i];
else
$right_arr[] = $array[$i];
}
$left_arr = quicksort($left_arr);
$right_arr = quicksort($right_arr);
return array_merge($left_arr, array($key), $right_arr);
}

HEAD： 只请求页面的首部。
GET： 请求指定的页面信息，并返回实体主体。
POST： 请求服务器接受所指定的文档作为对所标识的URI的新的从属实体。

（1）HTTP 定义了与服务器交互的不同方法，最基本的方法是 GET 和 POST。事实上 GET 适用于多数请求，而保留 POST 仅用于更新站点。

（2）在FORM提交的时候，如果不指定Method，则默认为GET请 求，Form中提交的数据将会附加在url之后，以?分开与url分开。字母数字字符原样发送，但空格转换为“+“号，其它符号转换为%XX,其中XX为 该符号以16进制表示的ASCII（或ISO Latin-1）值。GET请求请提交的数据放置在HTTP请求协议头中，
而POST提交的数据则放在实体数据中；GET方式提交的数据最多只能有1024字节，而POST则没有此限制。

（3）GET 这个是浏览器用语向服务器请求最常用的方法。POST这个方法也是用来传送数据的，但是与GET不同的是，使用POST的时候，数据不是附在URI后面传递的，而是要做为独立的行来传递，此时还必须要发送一个Content_length标题，以标明数据长度，随后一个空白行，然后就是实际传送的数据。网页的表单通常是用POST来传送的。
   
