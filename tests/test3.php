<?php
//
//namespace {
//
//    require __DIR__ . '/../vendor/autoload.php';
//
//    use PFinal\Container\Container;
//    use PFinal\Container\ServiceLocator;
//    use Psr\Container\ContainerInterface;
//
//    //Using the PSR-11 ServiceLocator
//
//
//    class Logger
//    {
//        public function __construct()
//        {
//            echo __CLASS__;
//        }
//    }
//
//    class EventDispatcher
//    {
//        public function __construct()
//        {
//            echo __CLASS__;
//        }
//    }
//
//    class MyService
//    {
//        /**
//         * "logger" must be an instance of LoggerInterface
//         * "event_dispatcher" must be an instance of EventDispatcher
//         */
//        private $services;
//
//        public function __construct(ContainerInterface $services)
//        {
//            $this->services = $services;
//        }
//
//        //如果是这种方式，不管是否有真正调用$logger，都会被实例化
////        public function __construct(Logger $logger)
////        {
////        }
//
//        public function demo()
//        {
//            //在使用的时候，才会去实例化
//            $this->services->get('logger');
//            //$this->services->get('event_dispatcher');
//        }
//    }
//
//
//    //有时, 服务需要访问多个其他服务, 而不确保它们都将被实际使用。在这些情况下, 您可能希望服务的实例化是惰性的。
//    //传统的解决方案是注入整个服务容器, 以获得真正需要的服务。但是, 不建议这样做, 因为它使服务对应用程序的其余部分具有太广泛的访问权限, 并隐藏了它们的实际依赖项。
//    //ServiceLocator 的目的是通过提供对一组预定义服务的访问来解决这一问题, 同时仅在实际需要时才实例化。
//    //它还允许您使用不同于注册它们的名称来提供服务。例如, 您可能希望使用一个期望 EventDispatcher 实例在名称 event_dispatcher 下可用的对象, 而您的事件发送器已在名称分配器下注册
//
//    $container = new Container();
//
//    $container['logger'] = function ($c) {
//        return new Logger();
//    };
//
//    $container['dispatcher'] = function () {
//        return new EventDispatcher();
//    };
//
//    $container['service'] = function ($c) {
////        return $c->make('MyService');
//
//        $locator = new ServiceLocator($c, array('logger', 'event_dispatcher' => 'dispatcher'));
//        return new MyService($locator);
//    };
//
//    $controller = function (ContainerInterface $container) {
//        $service = $container->get('service');
//        $service->demo();
//    };
//
//    $controller($container);
//
//}