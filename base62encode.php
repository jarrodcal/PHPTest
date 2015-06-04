<?php

    //将IP转换为整数，将整数进行base62encode
    //array_reverse str_split array_flip

    $chars = "0123456789abcdefghijklmnopoqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $val = 15011381805;
    $base = 62;
    $result = '';

    do
    {
        $i = $val % $base;
        $result = $chars[$i] . $result;
        $val = ($val - $i) / $base;
    }while ($val);

    echo $result . "\n";

    $arr = str_split($chars);
    $code = array_flip($arr);
    $len = strlen($result);
    $value = 0;

    for ($k=0; $k<$len; $k++)
    {
        $index = $code[$result[$k]];
        $value += $index * pow($base, $len-$k-1);
    }

    echo $value . "\n";

    $base = 256;
    $ip = "111.13.89.97";
    $value = 0;
    $arr = explode('.', $ip);

    foreach ($arr as $key => $v)
    {
        $value += $v * pow($base, 3-$key);
    }

    echo $value . "\n";

    do
    {
        $index = $value % $base;
        $str = "{$index}.{$str}";
        $value = ($value - $index) / $base;
    }while ($value);

    $len = strlen($str);
    echo substr($str, 0, $len-1);
