<?php

namespace App\Http\Controllers;
use App\Models\OrderItem;

class MbaController extends Controller
{
public function getAllOrders()
{
$allData = OrderItem::with('product')->get()->toArray();
// Loop through each order item and filter out unwanted fields
foreach ($allData as &$order) {
unset($order['product']['media']);
unset($order['product']['gallery']);
// You can unset other fields here if needed
}
return response()->json($allData);
}
}