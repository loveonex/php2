<?php

namespace App\Controllers;

use App\Models\UserModel;

class AccountController extends Controller
{
    public function login()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: /');
            die;
        }
        $this->viewClient('account.login', []);
    }

    public function saveLogin()
    {
        $errors = [];
        if (!$_REQUEST['email']) {
            $errors['email'] = "Bạn cần nhập email";
        }
        if (!$_REQUEST['password']) {
            $errors['password'] = "Bạn cần nhập password";
        }
        if ($errors) {
            $this->viewClient('account.login', [
                'errors' => $errors,
                'request' => $_REQUEST
            ]);
            return;
        }
        $user = UserModel::getOne('email', "'" . $_REQUEST['email'] . "'");
        if (!$user) {
            $errors['fail'] = "Email sai";
            $this->viewClient('account.login', [
                'errors' => $errors,
                'request' => $_REQUEST
            ]);
            return;
            if (password_verify($_REQUEST['password'], $user->password) == false) {
                $errors['fail'] = "Password sai";
                $this->viewClient('account.login', [
                    'errors' => $errors,
                    'request' => $_REQUEST
                ]);
                return;
            }
        }
        if ($user->status == 1) {
            $errors['fail'] = "Tài khoản của bạn đã bị vô hiệu hóa, vui lòng liên hệ quản trị viên để biết thêm chi tiết";
            $this->viewClient('account.login', [
                'errors' => $errors,
                'request' => $_REQUEST
            ]);
            return;
        }
        $_SESSION['auth'] = $user;
        if ($user->role == 1) {
            header('location: /admin');
            die;
        } else {
            header('location: /');
            die;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    public function register()
    {
        $this->viewClient('account.register', []);
    }

    public function saveRegister()
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
            $this->viewClient('account.register', [
                'errors' => $errors,
                'request' => $_REQUEST
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
            $this->viewClient('account.register', [
                'errors' => $errors,
                'request' => $_REQUEST
            ]);
            return;
        }
        $modelUser = new UserModel();
        $_REQUEST['password'] = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $_REQUEST['image'] = $image;
        unset($_REQUEST['re_password']);
        $modelUser->add($_REQUEST);
        header('location: /login');
    }
}
