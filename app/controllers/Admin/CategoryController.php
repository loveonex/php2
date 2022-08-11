<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class CategoryController extends Controller {
    public function index() {
        $categories = CategoryModel::where('1', '=', '1')->get();
        $this->viewAdmin('category.index', [
            'categories' => $categories,
            'title' => "Danh sách danh mục"
        ]);
    }

    public function add(){
        $this->viewAdmin('category.add', [
            'title' => "Thêm mới danh mục"
        ]);
    }

    public function saveAdd(){
        $errors =[];
        if(!$_REQUEST['name']) {
            $errors['name'] = "Bạn cần nhập tên";
        }

        if($errors) {
            $this->viewAdmin('category.add', [
                'errors' => $errors, 
                'request' => $_REQUEST,
                'title' => "Thêm mới danh mục"
            ]);
            return;
        }
        $modelCategory = new CategoryModel();
        $modelCategory->add($_REQUEST);
        header('location: /admin/category');
    }

    public function edit()
    {
        $category = CategoryModel::getOne('id', $_GET['id']);
        $this->viewAdmin('category.edit', [
            'category' => $category,
            'title' => 'Chỉnh sửa danh mục'
        ]);
    }
    
    public function saveEdit(){
        $category = CategoryModel::getOne('id', $_REQUEST['id']);
        $errors =[];
        if(!$_REQUEST['name']) {
            $errors['name'] = "Bạn cần nhập tên";
        }

        if($errors) {
            $this->viewAdmin('category.edit', [
                'category' => $category ,
                'errors' => $errors, 
                'request' => $_REQUEST,
                'title' => "Chỉnh sửa danh mục"
            ]);
            return;
        }
        $modelCategory = new CategoryModel();
        $modelCategory->update($_REQUEST);
        header('location: /admin/category');
    }

    public function delete()
    {
        CategoryModel::delete($_GET['id']);
        header('location: /admin/category');
    }

    public function status()
    {
        $category_old = CategoryModel::getOne('id', $_GET['id']);
        $modelCategory = new CategoryModel();
        if($category_old->status == 0){ 
            $modelCategory->update(['status' => 1, 'id' => $_GET['id']]);
        } else {
            $modelCategory->update(['status' => 0, 'id' => $_GET['id']]);
        }
        header('location: /admin/category');
    }
}
?>