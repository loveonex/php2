<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class HomeController extends Controller {
    public function index() {
        $products = ProductModel::all();
        $categories = CategoryModel::all();
        $users = UserModel::all();
        $this->viewAdmin('home.index', [
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
            'title' => 'Home Admin'
        ]);
    }
}
?>