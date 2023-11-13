<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){

        $products=Product::all();

        return view('home.userPage',compact('products'));
    }


    public function redirect(){

        $products=Product::all();

         $total_products=Product::all()->count();
         $total_orders=Order::all()->count();
         $total_customers=User::all()->count();
         $orders=Order::all();
         $total_price=0;
         foreach ($orders as $order){

             $total_price=$total_price+$order->price;

         }

         $OrderDelivered =Order::where('delivery_status','delivered')->get()->count();
         $OrderProcessing =Order::where('delivery_status','processing')->get()->count();



        $userType=Auth::user()->userType;


        if ($userType==1){

            return view('admin.home',compact('total_products','total_orders','total_price','total_customers','OrderDelivered','OrderProcessing'));
        }else{
            return view('home.userPage',compact('products'));
        }
    }


    public function product_details($id){

        try {

            $product=Product::find($id);
            return view('home.productDetails',compact('product'));



        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

     public function add_cart(Request $request,$id){


        try {

            if(Auth::id()){


                $user=Auth::user();

                $product=Product::find($id);


                if($request->quantity <= $product->quantity){

                    $product=Product::find($id);

                    $product->quantity=$product->quantity-$request->quantity;
                    $product->save();


                    $cart=new Cart();
                    $cart->name=$user->name;
                    $cart->email=$user->email;
                    $cart->phone=$user->phone;
                    $cart->address=$user->address;
                    $cart->product_title=$product->title;
                    if($product->discount_price!=null){

                        $cart->price=($product->price - $product->discount_price) * $request->quantity;
                    }


                    $cart->quantity=$request->quantity;
                    $cart->image=$product->image;
                    $cart->product_id=$product->id;
                    $cart->user_id=$user->id;
                    $cart->save();

                    Toastr::success('product added to cart successfully', 'Success');
                    return redirect()->back();



                }else{

                    Toastr::success('quantity you need is not available now', 'Success');
                    return redirect()->back();
                }




            }else{

                return redirect('login');
            }


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function show_cart(){


        try {
            if(Auth::id()) {

                $id = Auth::user()->id;

                $carts = Cart::where('user_id', $id)->get();
                return view('home.showCart', compact('carts'));


            } else {

                return redirect('login');
            }

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


    }

    public  function delete_cart($id){

        try {




            $delete_cart=Cart::find($id);
            $updateproduct=Product::find($delete_cart->product_id);
            $updateproduct->quantity=$delete_cart->quantity+$updateproduct->quantity;
            $updateproduct->save();
            $delete_cart->delete();
            Toastr::error('Product deleted successfully', 'delete');
            return redirect()->back();

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function pay_Delivery(){


        try {
            $userid=Auth::user()->id;

            $carts=  Cart::where('user_id',$userid)->get();

            foreach ($carts as $cart){

                $order =new Order();
                $order->name=$cart->name;
                $order->email=$cart->email;
                $order->phone=$cart->phone;
                $order->address=$cart->address;
                $order->user_id=$cart->user_id;
                $order->product_title=$cart->product_title;
                $order->quantity=$cart->quantity;
                $order->price=$cart->price;
                $order->image=$cart->image;
                $order->product_id=$cart->product_id;
                $order->payment_status='cash on delivery ';
                $order->delivery_status='processing';
                $order->save();

                $delete=Cart::find($cart->id);
                $delete->delete();


            }

            Toastr::success('product added to cart successfully', 'Success');
            return redirect()->back();


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function stripe($total){

        try {

            return view('home.stripe',compact('total'));

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function stripePost(Request $request,$total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "thanks for payment"
        ]);

        $userid=Auth::user()->id;

        $carts=  Cart::where('user_id',$userid)->get();

        foreach ($carts as $cart){

            $order =new Order();
            $order->name=$cart->name;
            $order->email=$cart->email;
            $order->phone=$cart->phone;
            $order->address=$cart->address;
            $order->user_id=$cart->user_id;
            $order->product_title=$cart->product_title;
            $order->quantity=$cart->quantity;
            $order->price=$cart->price;
            $order->image=$cart->image;
            $order->product_id=$cart->product_id;
            $order->payment_status='paid ';
            $order->delivery_status='processing';
            $order->save();

            $delete=Cart::find($cart->id);
            $delete->delete();


        }

        Session::flash('success', 'Payment successful!');

        return redirect('show/cart');
    }

    public function product_search(Request $request){

        try {


            $searchText=$request->search;
            $products=Product::where('title','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();
            return view('home.userPage',compact('products'));

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


    }
}
