<?php
namespace App\Controllers\Client;

use App\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class HomeController extends Controller {
    public function index() {
        $banners = BannerModel::all();
        $categories = CategoryModel::all();
        if(!isset($_GET['price'])){
            $products = ProductModel::all();
        } else {
            $products = ProductModel::where('status = 0', 'order by price', $_GET['price'] == 'desc' ? "desc" : 'asc')
            ->get();
        }
        
        $this->viewClient('home.index', [
            'products' => $products, 
            'banners' => $banners,
            'categories' => $categories
        ]);
    }

    public function find(){
        $banners = BannerModel::all();
        $categories = CategoryModel::all();
        $products = ProductModel::where('name', 'like', "'%" . $_POST['find'] . "%'")
            ->andWhere('status', '=', 0)
            ->get();
        $this->viewClient('home.index', [
            'products' => $products, 
            'banners' => $banners,
            'categories' => $categories
        ]);
    }
}

?>