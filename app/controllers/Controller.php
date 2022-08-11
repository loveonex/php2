<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ReceiptDetailModel;

class Controller
{
    public function viewClient($path, $data = [])
    {
        extract($data);
        $item_orders = [];
        if (isset($_SESSION['auth'])) {
            $item_carts = ReceiptDetailModel::where('user_id', '=', $_SESSION['auth']->id)->andWhere('status', '=', 0)->get();
            if ($item_carts) {
                foreach ($item_carts as $cart) {
                    $get_product = ProductModel::getOne('id', $cart->product_id);
                    $item_orders[] = (object) [
                        'name' => $get_product->name,
                        'image' => $get_product->image,
                        'quantity' => $cart->quantity,
                        'price' => $get_product->price,
                    ];
                }
            }
        } else if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $cart) {
                $get_product = ProductModel::getOne('id', $cart->product_id);
                $item_orders[] = (object) [
                    'name' => $get_product->name,
                    'image' => $get_product->image,
                    'quantity' => $cart->quantity,
                    'price' => $get_product->price,
                ];
            }
        }
        $path = str_replace('.', '/', $path);
        $view = $path . ".php";
        include_once __DIR__  . "/../views/client/layout.php";
    }
    public function viewAdmin($path, $data = [])
    {
        extract($data);
        $path = str_replace('.', '/', $path);
        $view = $path . ".php";
        include_once __DIR__  . "/../views/admin/layout.php";
    }
    public static function viewNotFound($path)
    {
        $path = str_replace('.', '/', $path);
        include_once __DIR__  . "/../views/" . $path . ".php";
    }
}
