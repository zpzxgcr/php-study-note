<?php
// <!-- 基本数据类型 --> 
### 变量声明
/**
 * 定义变量的五条基本规则
  1.必须要以$开始。如变量x必须要写成$x
  2.变量的首字母不能以数字开始
  3.变量的名字区分大小写
  4.变量不要用特殊符号、中文，_不算特殊符号
  5.变量命名要有意义（别写xxx，aaa，ccc这种 变量名）
  $ 叫作美元符，英文单词：dollar。PHP的变量必须以美元符开始。说明搞PHP有“钱”途。 哈哈

  PHP_EOL 是换行符号
 */
### 基本数据类型
/**
  php中的数据类型
  int 整形
  
  boolan  布尔值

  True False true false

  string 字符串 三种声明方式
               1.用单引号声明
               2.用双引号声明
               3.用字界符声明（需要输入非常大段的字符串时使用）
              
   字符串的单双引号的区别
    1.双引号解析变量，但是单引号不解析变量。

    2.在双引号里面插入变量，变量后面如果有英文或中文字符，它会把这个字符和变量拼接起来，视为一整个变量。一定要在变量后面接上特殊字符，例如空格等分开。

    3.如果在双引号里面插变量的时候，后面不想有空格，可以拿大括号将变量包起来。

    4.双引号解析转义字符，单引号不解析转义字符。但，单引号能解析\' 和\

    5.单引号效率高于双引号，尽可能使用单引号

    6.双号和单引号可以互插！！！双引号当中插入单引号，单引号当中插入变量，这个变量会被解析。

    7.神奇的字符串拼接胶水——（.）点，用来拼接字符串。

    8.我们将定界符声明字符串视为双引号一样的功能来看待。
    
    补充：因为单引号只会对特定的几个字符转义，而且不会对变量进行引用所以效率比双引号要高
         一般来说单引号双引号混用时，用.号连接变量和字符串能使代码更清晰

  float 浮点型
        1.普通声明

        2.科学声明
        var_dump() 是一个函数。向括号()中间插入变量。这个函数，会打印出来数据类型，还会对应显示变量的长度和值。

   NUll 空在英文里面表示是null，它是代表没有。空(null)不是false，不是0，也不是空格。和js 里面差不多
       主要有以下三空情况会产生空（null）类型：

       1.通过变量赋值明确指定为变量的值为NULL

       2.一个变量没有给任何值

       3.使用函数unset()将变量销毁掉

       empty()可以向括号中间传入一个变量。这个变量的值如果为false或者为null的话，返回true。就是和 if(true) 差不多 函数用于检查一个变量是否为空。
              判断一个变量是否被认为是空的。当一个变量并不存在，或者它的值等同于 FALSE，那么它会被认为不存在。如果变量不存在的话，empty()并不会产生警告。
empty() 5.5 版本之后支持表达式了，而不仅仅是变量。
              当 var 存在，并且是一个非空非零的值时返回 FALSE 否则返回 TRUE。
              以下的变量会被认为是空的：
              "" (空字符串)
              0 (作为整数的0)
              0.0 (作为浮点数的0)
              "0" (作为字符串的0)
              NULL
              FALSE
              array() (一个空数组)
              $var; (一个声明了，但是没有值的变量)

       isset() 可以向括号中间传入一个或者多个变量，变量与变量间用逗号分开。只要有有一个变量为null，则返回false。否则，则返回true。
              $one = 10;
              $two = false;
              $three = 0;
              $four = null;

              $result = isset($one , $two , $three , $four);

       unset 如果在函数中 unset() 一个全局变量，则只是局部变量被销毁，而在调用环境中的变量将保持调用 unset() 之前一样的值。

 */
/**
 * 数组
 * $shu = array(1,2,3);
 */
$shu = array(1, 2, 3);
var_dump($shu);