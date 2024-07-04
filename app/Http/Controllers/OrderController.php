<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

use Tymon\JWTAuth\Facades\JWTAuth; 

use App\Http\Controllers\MainController;



// Model
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;


class OrderController extends MainController
{

    public function getOrderDetails($id)
    {
        $order = Order::with(['orderDetails.product:id,name,image'])
                    ->find($id);
    
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        return response()->json(['order' => $order]);

    }
    
    public function getProducts()
    {
        // ===>> Get Data from DB (group by Product type from DB)
        $data = ProductType::select('id', 'name')
            ->with([
                'products:id,name,image,type_id,unit_price,stock' // 1:M
            ])
            ->get();

        // ===> Success Response Back to Client
        return response()->json($data, Response::HTTP_OK);
    }
    public function showOrder()
    {
        return view('order');
    }
    public function makeOrder(Request $req){

        // ===>> Check validation
        $this->validate($req, [
            'cart'      => 'required|json'
        ]);

        //==============================>> Get Current Login User to save who make orders.
        $user = JWTAuth::parseToken()->authenticate();

        // ===>> Create Order
        $order                  = new Order;
        $order->cashier_id      = $user->id; // the current login account
        $order->total_price     = 0; // Set to 0 first. Find total Price later
        $order->receipt_number  = $this->_generateReceiptNumber(); // return 6 digit unique random invoice number.

        // ===>> Save To DB
        $order->save();

        // ===>> Find Total Price & Order Detail
        $details    = [];
        $totalPrice = 0;
        $cart       = json_decode($req->cart); // Turn Json String to PHP Array.

        // ===>> Loop Each Product ID along with quantity
        foreach ($cart as $productId => $quantity) {
            // ===>> Find Each Product by ID
            $product = Product::find($productId);
            

            $unitPrice = $product->unit_price;
                if ($product->promotion) {
                    $discountPercentage = $product->promotion->discount_percentage;
                    $unitPrice -= ($unitPrice * $discountPercentage) / 100;
                }
            // ===>> Check if product is valid
            if ($product) { // Yes
                
                // ===>> Add New Record to Array
                $details[] = [
                    'order_id'      => $order->id,
                    'product_id'    => $productId,
                    'quantity'      => $quantity,
                    'unit_price'    => $product->unit_price,
                    'discount'    => $discountPercentage,
                ];

                // ===>> Calculate the total Price
                $totalPrice +=  $quantity * $unitPrice;
                $totalStock = $product->stock - $quantity;


                // ===>> Save Order Detail to DB
                OrderDetail::insert($details);

                // ===>> Update Order
                $order->total_price     = $totalPrice;
                $order->save();
            }
        }

       

        $product->stock = $totalStock;
        $product->save();

        // ===> Get Data for Client Reponse to view the order in Popup.
        // $orderData = Order::select('*')
        // ->with([

        //     'cashier:id,name,type_id', // M:1
        //     'cashier.type:id,name',  // M:1

        //     'orderDetails:id,order_id,product_id,unit_price,quantity', // 1:M
        //     'orderDetails.product:id,name,type_id', // M:1 (order_details -> product)
        //     'orderDetails.product.type:id,name'  // M:1 (product -> products_type)

        // ])
        // ->find($order->id);


        $orderData = Order::with(['orderDetails.product:id,name,image'])
                    ->find($order->id);
    
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        // return response()->json(['order' => $order]);

        // ===>> Send Telegram Notification

        // ===> Success Response Back to Client
        return response()->json([
            'order'         => $orderData,
            'message'       => 'The order was successfully created!'
        ], Response::HTTP_OK);

    }

    private function _generateReceiptNumber(){

        // ===>> Generate 6 Random Number bigger than 1000000 and smaller than 9999999
        $number = rand(1000000, 9999999);

        // ===>> Get Data from DB the random number
        $data  = Order::where('receipt_number', $number)->first();

        // ===>> Check if the number exist in th DB record
        if ($data) { // Yes exist

            // ===>> Check Again
            return $this->_generateReceiptNumber();
        }

        // ===>> Return the unique number back
        return $number;
    }

    
}

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'cashier_id' => 'required|integer',
    //         'receipt_number' => 'required|string|max:255',
    //         'total_price' => 'required|integer',
    //         'discount' => 'nullable|integer',
    //     ]);

    //     // Create the order
    //     $order = Order::create([
    //         'cashier_id' => $request->cashier_id,
    //         'receipt_number' => $request->receipt_number,
    //         'total_price' => $request->total_price,
    //         'discount' => $request->discount,
    //     ]);

    //     return response()->json([
    //         'message' => 'Order created successfully',
    //         'order' => $order,
    //     ], 201);
    // }

