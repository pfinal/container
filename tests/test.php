<?php

require __DIR__ . '/../vendor/autoload.php';


interface  IDB
{
}
class DB implements IDB
{
}

class User
{
    //自动注入所需对象
    public function __construct(DB $db)
    {
    }
}


class News
{
    //自动注入所需对象
    public function __construct(IDB $db,$userId)
    {
        var_dump($db);
        var_dump($userId);
    }
}


$app = new \PFinal\Container\Container();

/*
$app['str'] = 'abc';
var_dump($app['str']);// abc
$app['str'] = 'def';
var_dump($app['str']);// def
*/

/*
class stdClass2{}

$app['obj'] = new stdClass();
var_dump($app['obj']);
$app['obj'] = new stdClass2();
var_dump($app['obj']);
exit;

*/


/*

//使用匿名函数申明服务
//var_dump(method_exists(function (){},'__invoke'));exit;

class stdClass2
{
    public function __construct()
    {
        echo '1';
    }
}

$app['obj'] = function ($app) {
    echo '2';
    return new stdClass2();
};
//var_dump($app['obj']);   // 取过值之后, 将不能重新给$app['obj'] 赋值,也不能扩展

//$app['obj'] = function ($app) {return new stdClass2();}; //Cannot override frozen service "obj"

//扩展一个服务
$app['obj'] = $app->extend('obj', function ($obj, $app) {

    var_dump($app);
    $obj->test = '12345';
    return $obj;
});

var_dump($app['obj']);
exit;
*/

/*
//直接make一个类名,每次都实例化一个新对象
$user = $app->make('User');
var_dump($user);
$user2 = $app->make('User');
var_dump($user2);
exit;
*/

/*
//申明服务后,多次make返回同一对象
$app['stdClass'] = function ($app){return new stdClass();};
$user = $app->make('stdClass');
var_dump($user);
$user2 = $app->make('stdClass');
var_dump($user2);
exit;
*/


/*
//工厂模式的服务,每次make返回不同实例
$app['user'] = $app->factory(function () use ($app) {
    return $app->make('User');
});
$user3 = $app->make('user');
var_dump($user3);
$user4 = $app->make('user');
var_dump($user4);
*/


/*
$app['mail'] = function (){
    echo 'send mail';
};

$app['mail']();//这样会报错,因为赋值一个函数,是注册服务,然而函数中并未return对象
*/

/*
//保护一个函数不被解析为"注册服务",而是使用函数本身
$app['mail'] = $app->protect(function (){
    echo 'send mail';
});

$app['mail']();
call_user_func($app->make('mail'));
*/


/*
$app['abc']=function ($app){return new stdClass();};

var_dump($app['abc']);//stdClass
var_dump($app->raw('abc'));//Closure 注册服务的那个原始函数
*/

//注册接口的服务类
$app['IDB']=function ($app){return new DB();};
$news = $app->make('News',['userId'=>1]);
var_dump($news);

