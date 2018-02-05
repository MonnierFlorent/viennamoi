<?php

namespace viennamoi\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

 /**
  * Home page controller.
  *
  * @param Application $app Silex application
  */
 public function indexAction(Application $app) {
  //$articles = $app['dao.article']->findAll();
  //$products = $app['dao.products']->findAll();
  //return $app['twig']->render('admin.html.twig', array('provider'=>$providers,));
  //return $app['twig']->render('product.html.twig', array('product'=>$products,));

  return $app['twig']->render('index.html.twig');
 }

 public function bakeryAction(Application $app) {
  $bakery = $app['dao.bakery']->findAll();
  return $app['twig']->render('bakery.html.twig', array('bakery' => $bakery,));
 }

 public function productAction(Application $app) {
  $products = $app['dao.format']->findAll();
  $categories = $app['dao.category']->findAll();
  return $app['twig']->render('product.html.twig', array('products' => $products, 'categories'=>$categories));
 }

//    public function lockBookAction($id, Application $app) {
//	$token = $app['security.token_storage']->getToken();
//	if (null !== $token) {
//	$user = $token->getUser();
//	}
//	var_dump($user);   
//	$book = $app['dao.book']->find($id);
//	$book->setAvailable(0);
//	$book->setUser($user);
//	$app['dao.book']->save($book);
//	return $app->redirect($app['url_generator']->generate('home'));
//    }

 /**
  * User login controller.
  *
  * @param Request $request Incoming request
  * @param Application $app Silex application
  */
 public function loginAction(Request $request, Application $app) {
  return $app['twig']->render('login.html.twig', array(
              'error' => $app['security.last_error']($request),
              'last_username' => $app['session']->get('_security.last_username'),
  ));
 }

 public function faqAction(Application $app) {
  return $app['twig']->render('faq.html.twig');
 }

 public function registerAction(Application $app) {
  return $app['twig']->render('register_form.html.twig');
 }

}
