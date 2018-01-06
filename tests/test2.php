<?php
//
//namespace {
//
//    require __DIR__ . '/../vendor/autoload.php';
//
//    use PFinal\Container\Container;
//    use Psr\Container\ContainerInterface;
//
//    class Service
//    {
//    }
//
//    //The PSR-11 container class
//
//    $container = new Container();
//    $container['service'] = function ($c) {
//        return new Service();
//    };
//
//    $controller = function (ContainerInterface $container) {
//        $service = $container->get('service');
//        var_dump($service);
//    };
//
//    $controller($container);
//
//}