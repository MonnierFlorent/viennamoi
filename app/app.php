<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
    
));
$app['twig'] = $app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
});
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => function () use ($app) {
                return new viennamoi\DAO\UserDAO($app['db']);
            },
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));
//service envoi de mail
$app->register(new Silex\Provider\SwiftmailerServiceProvider());
     
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/viennamoi.log',
    'monolog.name' => 'viennamoi',
    'monolog.level' => $app['monolog.level']
));

// Register services
//$app['dao.region'] = function ($app) {
//    return new viennamoi\DAO\RegionDAO($app['db']);
//};
//
$app['dao.user'] = function ($app) {
    $userDAO = new viennamoi\DAO\UserDAO($app['db']);
    $userDAO->setRoleDAO($app['dao.role']);
    return $userDAO;
};

$app['dao.role'] = function ($app) {
    return new viennamoi\DAO\RoleDAO($app['db']);
};

$app['dao.address'] = function ($app) {
    $addressDAO = new viennamoi\DAO\AddressDAO($app['db']);
    $addressDAO->setCityDAO($app['dao.city']);
    return $addressDAO;
};

$app['dao.bakery'] = function($app) {
    $bakeryDAO = new viennamoi\DAO\BakeryDAO($app['db']);
    $bakeryDAO->setAddressDAO($app['dao.address']);
    return $bakeryDAO;
};

$app['dao.city'] = function ($app) {
    return new viennamoi\DAO\CityDAO($app['db']);
};

$app['dao.product'] = function($app) {
    return new viennamoi\DAO\ProductDAO($app['db']);  
};
$app['dao.format'] = function($app) {
    return new viennamoi\DAO\ProductDAO($app['db']);  
};

$app['dao.category'] = function($app) {
    return new viennamoi\DAO\CategoryDAO($app['db']);  
};

//complexe dao service
//$app['dao.comment'] = function ($app) {
//    $commentDAO = new viennamoi\DAO\CommentDAO($app['db']);
//    $commentDAO->setArticleDAO($app['dao.article']);
//    $commentDAO->setUserDAO($app['dao.user']);
//    return $commentDAO;
//};

// Register error handler
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Access denied.';
            break;
        case 404:
            $message = 'The requested resource could not be found.';
            break;
        default:
            $message = "Something went wrong.";
    }
    return $app['twig']->render('error.html.twig', array('message' => $message));
});

// Register JSON data decoder for JSON requests
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

