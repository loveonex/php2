<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\ReceiptDetailModel;
use App\Models\ReceiptModel;

class ReceiptController extends Controller {
    public function index() {
        $modelReceipt = new ReceiptModel();
        $receipts = $modelReceipt->getOrder();
        $this->viewAdmin('receipt.index', [
            'receipts' => $receipts,
            'title' => "Danh sách đơn hàng"
        ]);
    }

    public function detail(){
        $carts =[];
        $orders = [];
        $receipts = ReceiptModel::where('user_email', '=', "'" . $_GET['user_email'] . "'")->get();
        foreach ($receipts as $receipt){
            $carts[] = ReceiptDetailModel::where('id', '=', $receipt->receipt_detail_id)->get();
        }
        if ($carts) {
            foreach ($carts as $cart) {
                $product = ProductModel::getOne('id', $cart[0]->product_id);
                $orders[] = (object) [
                    'name' => $product->name,
                    'quantity' => $cart[0]->quantity,
                    'price' => $product->price * $cart[0]->quantity,
                ];
            }
        }
        $this->viewAdmin('receipt.detail', [
            'orders' => $orders,
            'title' => "Chi tiết đơn hàng",
            'inforUser' => $receipts[0]
        ]);
    }

    public function status()
    {
        $receipt_olds = ReceiptModel::where('user_email', "=" , "'" . $_GET['user_email'] . "'")->get();
        $modelReceipt = new ReceiptModel();
        foreach($receipt_olds as $receipt_old){
            if($receipt_old->status == 0){ 
                $modelReceipt->update(['status' => 1, 'id' => $receipt_old->id]);
            } else {
                $modelReceipt->update(['status' => 0, 'id' => $receipt_old->id]);
            }
        }
        header('location: /admin/receipt');
    }
}