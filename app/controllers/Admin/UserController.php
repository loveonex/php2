<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class UserController extends Controller {
    public function index() {
        $modelUser = new UserModel();
        $users = $modelUser->all();
        $this->viewAdmin('user.index', [
            'users' => $users,
            'title' => "Danh sách user"
        ]);
    }

    public function add(){
        $this->viewAdmin('user.add', [
            'title' => "Thêm mới user"
        ]);
    }

    public function saveAdd()
    {
        $errors = [];
        $file = $_FILES['image'];
        $image = "";
        if (!$_REQUEST['name']) {
            $errors['name'] = "Bạn cần nhập tên";
        }

        if ($_REQUEST['email'] < 0) {
            $errors['email'] = "Bạn cần nhập email";
        }

        if (!$_REQUEST['password']) {
            $errors['password'] = "Bạn cần nhập password";
        }

        if ($_REQUEST['re_password'] != $_REQUEST['password']) {
            $errors['re_password'] = "Nhập lại mật khẩu không khớp";
        }

        if (!$file['size'] < 0) {
            if (strpos($file['type'], 'image') === false) {
                $errors['image'] = "Bạn cần chọn file ảnh";
            }

            if (($file['size']) > 2048000) {
                $errors['image_size'] = "Bạn cần chọn file ảnh nhỏ hơn 2MB";
            }
        }

        if ($errors) {
            $this->viewAdmin('user.add', [
                'errors' => $errors,
                'request' => $_REQUEST,
                'title' => 'Thêm mới user'
            ]);
            return;
        }

        if ($file['size'] > 0) {
            $image = $file['name'];
            move_uploaded_file($file['tmp_name'], 'images/' . $image);
        } else {
            $image = '';
        }

        $checkUser = UserModel::getOne("email", "'" . $_REQUEST['email'] . "'");
        if ($checkUser) {
            $errors['fail'] = "Email đã được sử dụng";
            $this->viewAdmin('user.add', [
                'errors' => $errors,
                'request' => $_REQUEST,
                'title' => 'Thêm mới user'
            ]);
            return;
        }
        $modelUser = new UserModel();
        $_REQUEST['password'] = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $_REQUEST['image'] = $image;
        unset($_REQUEST['re_password']);
        $modelUser->add($_REQUEST);
        header('location: /admin/user');
    }

    public function bin(){
        $modelUser = new UserModel();
        $users = $modelUser->where('status', '=', 1)->get();
        $this->viewAdmin('user.bin', [
            'users' => $users,
            'title' => "User đã xóa"
        ]);
    }

    public function delete()
    {
        $user_old = UserModel::getOne('id', $_GET['id']);
        unlink('images/' . $user_old->image);
        UserModel::delete($_GET['id']);
        header('location: /admin/user/bin');
    }
    public function status()
    {
        $user_old = UserModel::getOne('id', $_GET['id']);
        $modelUser = new UserModel();
        if($user_old->status == 0){ 
            $modelUser->update(['status' => 1, 'id' => $_GET['id']]);
        } else {
            $modelUser->update(['status' => 0, 'id' => $_GET['id']]);
        }
        header('location: /admin/user');
    }

}
