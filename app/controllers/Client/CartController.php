<?php

namespace App\Controllers\Client;

use App\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\ReceiptDetailModel;
use App\Models\ReceiptModel;
use App\Models\UserModel;

class CartController extends Controller
{
    public function index()
    {
        $orders = [];
        $carts = [];
        if (isset($_SESSION['auth'])) {
            $carts = ReceiptDetailModel::where('user_id', '=', $_SESSION['auth']->id)->andWhere('status', '=', 0)->get();
        } else if (isset($_SESSION['cart'])) {
            $carts = $_SESSION['cart'];
        }
        if ($carts) {
            foreach ($carts as $cart) {
                $product = ProductModel::getOne('id', $cart->product_id);
                $orders[] = (object) [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $cart->quantity,
                    'price' => $product->price * $cart->quantity,
                ];
            }
        }
        $this->viewClient('cart.index', [
            'orders' => $orders,
            'carts' => $carts
        ]);
    }

    public function add()
    {
        if (!isset($_SESSION['auth'])) {
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $cart) {
                    if ($cart->product_id == $_REQUEST['product_id']) {
                        $cart->quantity += $_REQUEST['quantity'];
                        header('Location: /cart');
                        return;
                    }
                }
            }
            $_SESSION['cart'][] = (object) [
                'product_id' => $_REQUEST['product_id'],
                'quantity' => $_REQUEST['quantity']
            ];
        } else {
            $modelReceipt = new ReceiptDetailModel();
            $receipt_old = ReceiptDetailModel::where('product_id', "=", $_REQUEST['product_id'])
                ->andWhere('user_id', '=', $_SESSION['auth']->id)
                ->get();
            if ($receipt_old) {
                if ($receipt_old[0]->product_id == $_REQUEST['product_id']) {
                    $receipt_old[0]->quantity += $_REQUEST['quantity'];
                    $modelReceipt->update([
                        'quantity' => $receipt_old[0]->quantity,
                        'id' => $receipt_old[0]->id
                    ]);
                    header('Location: /cart');
                    return;
                }
            }
            $_REQUEST['user_id'] = $_SESSION['auth']->id;
            $modelReceipt->add($_REQUEST);
        }
        header('Location: /cart');
    }

    public function update()
    {
        if ($_REQUEST['quantity'] > 0) {
            if (isset($_SESSION['auth'])) {
                $receipt_old = ReceiptDetailModel::where('product_id', "=", $_REQUEST['product_id'])
                    ->andWhere('user_id', '=', $_SESSION['auth']->id)
                    ->get();
                $modelReceipt = new ReceiptDetailModel();
                $modelReceipt->update([
                    'quantity' => $_REQUEST['quantity'],
                    'id' => $receipt_old[0]->id
                ]);
                header('Location: /cart');
                return;
            } else {
                foreach ($_SESSION['cart'] as $cart) {
                    if ($cart->product_id == $_REQUEST['product_id']) {
                        $cart->quantity = $_REQUEST['quantity'];
                        header('Location: /cart');
                        return;
                    }
                }
            }
        }
        header('Location: /cart');
    }

    public function delete()
    {
        if (isset($_GET['user_id'])) {
            ReceiptDetailModel::deleteByForeign(" where user_id = " . (int) $_GET['user_id'] . ' and product_id = ' . (int) $_GET['product_id']);
        }
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value->product_id == $_GET['product_id']) {

                unset($_SESSION['cart'][$key]);
            }
        }
        header('Location: /cart');
    }

    public function pay()
    {
        $orders = [];
        $carts = [];
        if (isset($_SESSION['auth'])) {
            $carts = ReceiptDetailModel::where('user_id', '=', $_SESSION['auth']->id)->get();
        } else if (isset($_SESSION['cart'])) {
            $carts = $_SESSION['cart'];
        }
        if ($carts) {
            foreach ($carts as $cart) {
                $product = ProductModel::getOne('id', $cart->product_id);
                $orders[] = (object) [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $cart->quantity,
                    'price' => $product->price * $cart->quantity,
                ];
            }
        }
        $errors = [];
        if (!$_REQUEST['user_name']) {
            $errors['user_name'] = "Bạn cần nhập tên";
        }

        if (!$_REQUEST['user_email']) {
            $errors['user_email'] = "Bạn cần nhập email";
        }

        if (!$_REQUEST['user_address']) {
            $errors['user_address'] = "Bạn cần nhập địa chỉ";
        }

        if ($errors) {
            $this->viewClient('cart.index', [
                'orders' => $orders,
                'errors' => $errors,
                'request' => $_REQUEST
            ]);
            return;
        }
        $modelReceipt = new ReceiptModel();
        $modelReceiptDetail = new ReceiptDetailModel();

        if (!isset($_SESSION['auth'])) {

            $checkUser = UserModel::getOne("email", "'" . $_REQUEST['user_email'] . "'");
            if ($checkUser) {
                $errors['fail'] = "Email đã được sử dụng";
                $this->viewClient('cart.index', [
                    'orders' => $orders,
                    'errors' => $errors,
                    'request' => $_REQUEST
                ]);
                return;
            }
            $carts = $_SESSION['cart'];
            foreach ($carts as $cart) {
                $modelReceiptDetail->add((array) $cart);
            }
            $reciept_detail = ReceiptDetailModel::where('user_id', '=', 0)->andWhere('status', '=', 0)->get();
            unset($_SESSION['cart']);
        } else {
            $checkUser = UserModel::getOne("email", "'" . $_REQUEST['user_email'] . "'");
            if ($checkUser->id != $_SESSION['auth']->id) {
                $errors['fail'] = "Email đã được sử dụng";
                $this->viewClient('cart.index', [
                    'orders' => $orders,
                    'errors' => $errors,
                    'request' => $_REQUEST
                ]);
                return;
            }
            $reciept_detail = ReceiptDetailModel::where('user_id', '=', $_SESSION['auth']->id)->andWhere('status', '=', 0)->get();
        }
        $receipt = [];
        foreach ($reciept_detail as $recieptD) {
            $receipt['receipt_detail_id'] = $recieptD->id;
            $receipt['user_name'] = $_REQUEST['user_name'];
            $receipt['user_email'] = $_REQUEST['user_email'];
            $receipt['user_address'] = $_REQUEST['user_address'];
            $modelReceipt->add($receipt);
            $modelReceiptDetail->update(['status' => 1, 'id' => $recieptD->id]);
        }

        echo "<script>alert('Thanh Toán Thành Công !')</script>";
        header("Location: /");
    }
}
