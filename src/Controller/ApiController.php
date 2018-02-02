<?php
namespace viennamoi\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use viennamoi\Domain\Bakery;
use viennamoi\Domain\User;

/**
 * Description of ApiController
 *
 * @author Etudiant
 */
class ApiController {

 public function getBakeryAction(Application $app) {
  $bakerys = $app['dao.bakery']->findAll();
  // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
  $responseData = array();
  foreach ($bakerys as $bakery) {
   $addressId = null;
   if ($bakery->getAddress() != NULL) {
    $addressId = $bakery->getAddress()->getId();
   }
   $responseData[] = $this->buildBakeryArray($bakery, $addressId);
  }
  // Create and return a JSON response
  return $app->json($responseData);
 }

 /**
  * Converts an Article object into an associative array for JSON encoding
  *
  * @param Article $book Article object
  *
  * @return array Associative array whose fields are the article properties.
  */
 private function buildBakeryArray(Bakery $bakery, $addressId) {
  $data = array(
      'bak_id' => $bakery->getId(),
      'bak_name' => $bakery->getName(),
      'bak_content' => $bakery->getContent(),
      'bak_img' => $bakery->getImg(),
      //'bak_user' => $userId,
      'bak_address' => $addressId,
  );
  return $data;
 }
 
// public function getUserAction(Application $app) {
//  $users = $app['dao.role']->findAll();
//  // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
//  $responseData = array();
//  foreach ($users as $user) {
//   $roleId = null;
//   if ($user->getRole() != NULL) {
//    $roleId = $user->getRole()->getId();
//   }
//   $responseData[] = $this->buildUserArray($user, $roleId);
//  }
//  // Create and return a JSON response
//  return $app->json($responseData);
// }
//
// /**
//  * Converts an Article object into an associative array for JSON encoding
//  *
//  * @param Article $book Article object
//  *
//  * @return array Associative array whose fields are the article properties.
//  */
// private function buildUserArray(User $user, $roleId) {
//  $data = array(
//      'user_id' => $user->getId(),
//      'user_name' => $user->getName(),
//      'user_firstname' => $user->getFirstname(),
//      'user_civilite' => $user->getCivilite(),
//      'user_password' => $user->getPassword(),
//      'user_salt' => $user->getSalt(),
//      'user_tel' => $user->getTel(),
//      'user_email' => $user->getEmail(),
//      'user_role' => $roleId,
//  );
//  return $data;
// }

}
