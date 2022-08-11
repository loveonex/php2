<?php
namespace App\Controllers\Client;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller {
    public function index() {
        $id = $_GET['id'] ?? null;
        if(!$id){
            return header('location: /');
        }
        $products = ProductModel::where('cate_id', '=', $id)
            ->andWhere('status', '=', 0)
            ->get();
        $categories = CategoryModel::all();
        if(!$products){
            return header('location: /');
        }
        $this->viewClient('product.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    
    public function detail() {
        $id = $_GET['id'] ?? null;
        if(!$id){
            return header('location: /');
        }
        $product = ProductModel::getOne("id", $id);
        $categories = CategoryModel::all();
        if(!$product){
            return header('location: /');
        }
        return $this->viewClient('product.detail', [
            'product' => $product,
            'categories' => $categories
        ]);
    }
}

?>