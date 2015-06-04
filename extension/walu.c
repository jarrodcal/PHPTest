#include "php_walu.h"

//ZEND_FUNCTION 是一个宏，展开后是void wali_hello(INTERNAL_FUNCTION_PARAMETERS)
//#define INTERNAL_FUNCTION_PARAMETERS int ht, zval *return_value, zval **return_value_ptr, zval *this_ptr, int return_value_used TSRMLS_DC
//巧妙的利用这几个参数，根据不同的情况进行使用
//RETURN_STRING RETURN_LONG 

ZEND_FUNCTION(walu_hello)
{
    php_printf("Hello World!\n");
}

ZEND_FUNCTION(sample_return)
{
    if (return_value_used)
    {
        int i;
        array_init(return_value);

        for(i = 0; i < 1000; i++)
            add_next_index_long(return_value, i);
        
        return;
    }
    else
    {
        //抛出一个E_NOTICE级错误
        php_error_docref(NULL TSRMLS_CC, E_NOTICE, "猫了个咪的，我就知道你没用我的劳动成果！");
        RETURN_NULL();
    }
}

ZEND_FUNCTION(uniq_value)
{
    char *str;
    int len = -1;

    //Thead safe resource manager local storge
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &str, &len) == FAILURE)
        RETURN_NULL();
        
    char result[100] = {0};
    memcpy(result, str, len);
    memcpy(result+len, str, len);

    RETURN_STRING(result, 1);
}

inline static void swapFun(char *result)
{
    char *p = result;
    char *q = result + strlen(result) - 1;
    char c = '\0';

    while (p < q)
    {
        c = *p;
        *p = *q;
        *q = c;
        p++;
        q--;
    }
}

ZEND_FUNCTION(base62encode)
{
    char result[8] = {0};
    char chars[63] = "0123456789abcdefghijklmnopoqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    long num = 0;
    int index = 0;
    
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &num) == FAILURE)
        RETURN_NULL();
    
    if (num <= 0)
        RETURN_NULL();

    int i = 0;

    do
    {
        index = num % 62;
        result[i++] = chars[index];
        num = (num - index) / 62;
    }while(num);

    swapFun(result);
    RETURN_STRING(result, 1);
}

inline static int findIndex(char c)
{
    char chars[63] = "0123456789abcdefghijklmnopoqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    int i;

    for (i=0;i<63;i++)
    {
        if (chars[i] == c)
            return i;
    }
}

ZEND_FUNCTION(base62decode)
{
    long result = 0;
    
    char *str;
    int len = 0;
    
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &str, &len) == FAILURE)
        RETURN_LONG(result);
    
    if (len == 0)
        RETURN_LONG(result);

    int i = 0;
    char val = '\0';
    int k = 0;

    for (; i<len; i++)
    {
        k = findIndex(str[i]);
        result += k * pow(62, len-1-i);
    }

    RETURN_LONG(result);
}

static zend_function_entry walu_functions[] = 
{
    ZEND_FE(walu_hello,     NULL)
    ZEND_FE(sample_return,  NULL)
    ZEND_FE(uniq_value,     NULL)
    ZEND_FE(base62encode,   NULL)
    ZEND_FE(base62decode,   NULL)
    {NULL, NULL, NULL}
};

zend_module_entry walu_module_entry = 
{
#if ZEND_MODULE_API_NO >= 20010901
     STANDARD_MODULE_HEADER,
#endif
    "walu", //这个地方是扩展名称，往往我们会在这个地方使用一个宏。
    walu_functions, /* Functions */
    NULL, /* MINIT */
    NULL, /* MSHUTDOWN */
    NULL, /* RINIT */
    NULL, /* RSHUTDOWN */
    NULL, /* MINFO */
#if ZEND_MODULE_API_NO >= 20010901
    "0.1", //这个地方是我们扩展的版本
#endif
    STANDARD_MODULE_PROPERTIES
};
 
#ifdef COMPILE_DL_WALU
    ZEND_GET_MODULE(walu)
#endif
