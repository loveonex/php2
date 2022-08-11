<?php
session_start();
require_once __DIR__ . "'./../vendor/autoload.php";

use App\Controllers\AccountController;
use App\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Controllers\Admin\HomeController as AdminHomeController;
use App\Controllers\Admin\ProductController as AdminProductController;
use App\Controllers\Admin\ReceiptController as AdminReceiptController;
use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Client\CartController as ClientCartController;
use App\Controllers\Client\HomeController as ClientHomeController;
use App\Controllers\Client\ProductController as ClientProductController;
use App\Views\Router;

//client
Router::get('/', [ClientHomeController::class, 'index']);
Router::post('/', [ClientHomeController::class, 'find']);

Router::get('/product', [ClientProductController::class, 'index']);
Router::get('/detail', [ClientProductController::class, 'detail']);

Router::get('/login', [AccountController::class, 'login']);
Router::post('/login', [AccountController::class, 'saveLogin']);

Router::get('/logout', [AccountController::class, 'logout']);

Router::get('/register', [AccountController::class, 'register']);
Router::post('/register', [AccountController::class, 'saveRegister']);

Router::get('/cart', [ClientCartController::class, 'index']);
Router::post('/cart', [ClientCartController::class, 'add']);
Router::post('/cart/update', [ClientCartController::class, 'update']);
Router::get('/cart/delete', [ClientCartController::class, 'delete']);

Router::post('/cart/pay', [ClientCartController::class, 'pay']);

//admin

Router::get('/admin', [AdminHomeController::class, 'index']);

//admin/product

Router::get('/admin/product', [AdminProductController::class, 'index']);
Router::get('/admin/product/add', [AdminProductController::class, 'add']);
Router::post('/admin/product/add', [AdminProductController::class, 'saveAdd']);
Router::get('/admin/product/edit', [AdminProductController::class, 'edit']);
Router::post('/admin/product/edit', [AdminProductController::class, 'saveEdit']);
Router::get('/admin/product/status', [AdminProductController::class, 'status']);
Router::get('/admin/product/bin', [AdminProductController::class, 'bin']);
Router::get('/admin/product/bin/delete', [AdminProductController::class, 'delete']);

//admin/category

Router::get('/admin/category', [AdminCategoryController::class, 'index']);
Router::get('/admin/category/add', [AdminCategoryController::class, 'add']);
Router::post('/admin/category/add', [AdminCategoryController::class, 'saveAdd']);
Router::get('/admin/category/edit', [AdminCategoryController::class, 'edit']);
Router::post('/admin/category/edit', [AdminCategoryController::class, 'saveEdit']);
Router::get('/admin/category/delete', [AdminCategoryController::class, 'delete']);
Router::get('/admin/category/status', [AdminCategoryController::class, 'status']);

//admin/user

Router::get('/admin/user', [AdminUserController::class, 'index']);
Router::get('/admin/user/add', [AdminUserController::class, 'add']);
Router::post('/admin/user/add', [AdminUserController::class, 'saveAdd']);
Router::get('/admin/user/edit', [AdminUserController::class, 'edit']);
Router::post('/admin/user/edit', [AdminUserController::class, 'saveEdit']);
Router::get('/admin/user/status', [AdminUserController::class, 'status']);
Router::get('/admin/user/bin', [AdminUserController::class, 'bin']);
Router::get('/admin/user/bin/delete', [AdminUserController::class, 'delete']);

//admin/receipt

Router::get('/admin/receipt', [AdminReceiptController::class, 'index']);
Router::get('/admin/receipt/detail', [AdminReceiptController::class, 'detail']);
Router::get('/admin/receipt/status', [AdminReceiptController::class, 'status']);

Router::run();
?>