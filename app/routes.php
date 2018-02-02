<?php

// Home page
$app->get('/', "viennamoi\Controller\HomeController::indexAction")
->bind('home');

// Admin zone
$app->get('/admin', "viennamoi\Controller\AdminController::indexAction")
->bind('admin');

// Products page
$app->get('/product', "viennamoi\Controller\HomeController::productAction")
->bind('product');


// Login form
$app->get('/login', "viennamoi\Controller\HomeController::loginAction")
->bind('login');
// Add a user
$app->match('/admin/user/add', "viennamoi\Controller\AdminController::addUserAction")
->bind('admin_user_add');
// Edit an existing user
$app->match('/admin/user/{id}/edit', "viennamoi\Controller\AdminController::editUserAction")
->bind('admin_user_edit');
// Remove a user
$app->get('/admin/user/{id}/delete', "viennamoi\Controller\AdminController::deleteUserAction")
->bind('admin_user_delete');


// register
$app->get('/register', "viennamoi\Controller\HomeController::registerAction")
->bind('register');

// bakery
$app->get('/bakery', "viennamoi\Controller\HomeController::bakeryAction")
->bind('bakery');

// faq
$app->get('/faq', "viennamoi\Controller\HomeController::faqAction")
->bind('faq');


// add fournisseur
$app->match('/admin/provider/add', "viennamoi\Controller\AdminController::addProviderAction")
->bind('admin_provider_add');
// edit fournisseur
$app->match('/admin/provider/{id}/edit', "viennamoi\Controller\AdminController::editProviderAction")
->bind('admin_provider_edit');
// delete fournisseur
$app->get('/admin/provider/{id}/delete', "viennamoi\Controller\AdminController::deleteProviderAction")
->bind('admin_provider_delete');


// add produit
$app->match('/admin/product/add', "viennamoi\Controller\AdminController::addProductAction")
->bind('admin_product_add');
// edit produit
$app->match('/admin/product/{id}/edit', "viennamoi\Controller\AdminController::editProductAction")
->bind('admin_product_edit');
// delete produit
$app->get('/admin/product/{id}/delete', "viennamoi\Controller\AdminController::deleteProductAction")
->bind('admin_product_delete');

