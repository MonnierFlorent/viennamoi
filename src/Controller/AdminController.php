<?php

namespace viennamoi\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use viennamoi\Domain\User;
use viennamoi\Form\Type\UserUpdateType;

class AdminController {

 /**
  * Admin home page controller.
  *
  * @param Application $app Silex application
  */
 public function indexAction(Application $app) {
  $users = $app['dao.user']->findAll();
  //$providers = $app['dao.provider']->findAll();

  return $app['twig']->render('admin.html.twig', array(
              'users' => $users));
 }

 /**
  * Add user controller.
  *
  * @param Request $request Incoming request
  * @param Application $app Silex application
  */
 public function addUserAction(Request $request, Application $app) {
  $user = new User();
  $userForm = $app['form.factory']->create(UserUpdateType::class, $user);
  $userForm->handleRequest($request);
  if ($userForm->isSubmitted() && $userForm->isValid()) {
   // generate a random salt value
   $salt = substr(md5(time()), 0, 23);
   $user->setSalt($salt);
   $plainPassword = $user->getPassword();
   // find the default encoder
   $encoder = $app['security.encoder.bcrypt'];
   // compute the encoded password
   $password = $encoder->encodePassword($plainPassword, $user->getSalt());
   $user->setPassword($password);
   $app['dao.user']->save($user);
   $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
  }
  return $app['twig']->render('userupdate_form.html.twig', array(
              'title' => 'Nouvel utilisateur',
              'userForm' => $userForm->createView()));
 }

 /**
  * Edit user controller.
  *
  * @param integer $id User id
  * @param Request $request Incoming request
  * @param Application $app Silex application
  */
 public function editUserAction($id, Request $request, Application $app) {
  $user = $app['dao.user']->find($id);
  $userForm = $app['form.factory']->create(UserUpdateType::class, $user);
  $userForm->handleRequest($request);
  if ($userForm->isSubmitted() && $userForm->isValid()) {
   $plainPassword = $user->getPassword();
   // find the encoder for the user
   $encoder = $app['security.encoder_factory']->getEncoder($user);
   // compute the encoded password
   $password = $encoder->encodePassword($plainPassword, $user->getSalt());
   $user->setPassword($password);
   $app['dao.user']->save($user);
   $app['session']->getFlashBag()->add('success', 'The user was successfully updated.');
  }
//        user_form.html.twig
  return $app['twig']->render('userupdate_form.html.twig', array(
              'title' => 'Modif compte utilisateur',
              'userForm' => $userForm->createView()));
 }

 /**
  * Delete user controller.
  *
  * @param integer $id User id
  * @param Application $app Silex application
  */
 public function deleteUserAction($id, Application $app) {

  $app['dao.user']->delete($id);
  $app['session']->getFlashBag()->add('success', 'The user was successfully removed.');
  // Redirect to admin home page
  return $app->redirect($app['url_generator']->generate('admin'));
 }

}
