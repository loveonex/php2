<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller {
    public function index() {
        $modelProduct = new ProductModel();
        $products = $modelProduct->all();
        $this->viewAdmin('product.index', [
            'products' => $products,
            'title' => "Danh sách sản phẩm"
        ]);
    }

    public function add(){
        $modelCategory = new CategoryModel();
        $categories = $modelCategory->all();
        $this->viewAdmin('product.add', [
            'categories' => $categories,
            'title' => "Thêm mới sản phẩm"
        ]);
    }

    public function saveAdd(){
        $errors =[];
        $file = $_FILES['image'];
        $image = "";
        if(!$_REQUEST['name']) {
            $errors['name'] = "Bạn cần nhập tên";
        }

        if($_REQUEST['price'] < 0){
            $errors['price'] = "Bạn cần nhập giá lớn hơn 0";
        }

        if(!$_REQUEST['description']){
            $errors['description'] = "Bạn cần nhập mô tả";
        }

        if(strpos($file['type'], 'image') === false){
            $errors['image'] = "Bạn cần chọn file ảnh";
        }

        if(($file['size']) > 2048000){
            $errors['image_size'] = "Bạn cần chọn file ảnh nhỏ hơn 2MB";
        }

        if($errors) {
            $categories = CategoryModel::all();
            $this->viewAdmin('product.add', [
                'categories' => $categories, 
                'errors' => $errors, 
                'request' => $_REQUEST,
                'title' => "Thêm mới sản phẩm"
            ]);
            return;
        }

        if($file['size'] > 0){
            $image = $file['name'];
            move_uploaded_file($file['tmp_name'], 'images/' . $image);
        } else {
            $image = '';
        }
        $modelProduct = new ProductModel();
        $_REQUEST['image'] = $image;
        $modelProduct->add($_REQUEST);
        header('location: /admin/product');
    }

    public function edit()
    {
        $product = ProductModel::getOne('id', $_GET['id']);
        $categories = CategoryModel::all();
        $this->viewAdmin('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'title' => 'Chỉnh sửa sản phẩm'
        ]);
    }
    
    public function saveEdit(){
        $product_old = ProductModel::getOne('id', $_REQUEST['id']);
        $file = $_FILES['image'];
        $image = "";
        $errors =[];
        if(!$_REQUEST['name']) {
            $errors['name'] = "Bạn cần nhập tên";
        }

        if($_REQUEST['price'] < 0){
            $errors['price'] = "Bạn cần nhập giá lớn hơn 0";
        }

        if(!$_REQUEST['description']){
            $errors['description'] = "Bạn cần nhập mô tả";
        }

        if($file['name']){
            if(strpos($file['type'], 'image') === false){
                $errors['image'] = "Bạn cần chọn file ảnh";
            }
    
            if(($file['size']) > 2048000){
                $errors['image_size'] = "Bạn cần chọn file ảnh nhỏ hơn 2MB";
            }
        }

        if($errors) {
            $categories = CategoryModel::all();
            $this->viewAdmin('product.edit', [
                'product' => $product_old ,
                'categories' => $categories, 
                'errors' => $errors, 
                'request' => $_REQUEST,
                'title' => "Chỉnh sửa sản phẩm"
            ]);
            return;
        }

        if($file['size'] > 0){
            $image = $file['name'];
            move_uploaded_file($file['tmp_name'], 'images/' . $image);
            unlink('images/' . $product_old->image);
        } else {
            $image = $product_old->image;
        }
        $_REQUEST['image'] = $image;
        $modelProduct = new ProductModel();
        $modelProduct->update($_REQUEST);
        header('location: /admin/product');
    }

    public function bin(){
        $modelProduct = new ProductModel();
        $products = $modelProduct->where('status', '=', 1)->get();
        $this->viewAdmin('product.bin', [
            'products' => $products,
            'title' => "Sản phẩm đã xóa"
        ]);
    }

    public function delete()
    {
        $product_old = ProductModel::getOne('id', $_GET['id']);
        unlink('images/' . $product_old->image);
        ProductModel::delete($_GET['id']);
        header('location: /admin/product/bin');
    }
    public function status()
    {
        $product_old = ProductModel::getOne('id', $_GET['id']);
        $modelProduct = new ProductModel();
        if($product_old->status == 0){ 
            $modelProduct->update(['status' => 1, 'id' => $_GET['id']]);
        } else {
            $modelProduct->update(['status' => 0, 'id' => $_GET['id']]);
        }
        header('location: /admin/product');
    }

}
