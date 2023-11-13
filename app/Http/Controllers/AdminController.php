<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;


class AdminController extends Controller
{
    public function category(){
        $categories=Category::all();

        return view('admin.category',compact('categories'));
    }

    public function Add_category( CategoryRequest $request){


        try {

            $add_category = new Category();
            $add_category->category = $request->category;
            $add_category->save();
            Toastr::success('Category added successfully', 'Success');
            return redirect('add/category');


         }catch (ModelNotFoundException $exception) {
          return back()->withError($exception->getMessage())->withInput();
}

    }

    public function edit_category($id){

        $edit_category=Category::where('id',$id)->first();
        return view('admin.editCategory',compact('edit_category'));
    }
    public function update_category(CategoryRequest $request){
        try {
            $editCategory=Category::find($request->id);
            $editCategory->category=$request->category;
            $editCategory->save();
            Toastr::success('Category updated successfully', 'Success');
            return redirect('add/category');


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


    }

    public function delete_category(Request $request){

        try {
            $deleteCategory=Category::find($request->id);
            $deleteCategory->delete();
            Toastr::error('Category deleted successfully', 'delete');
            return redirect('add/category');

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function view_product(){

        try {

            $categories=Category::all();

            return view('admin.AddProduct',compact('categories'));

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function add_product(ProductRequest $request){

        try {

            $image=$request->image;
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move('product',$imageName);


            $product=new Product();
            $product->title=$request->title;
            $product->description=$request->Description;
            $product->image=$imageName;
            $product->price=$request->price;
            $product->quantity=$request->Quantity;
            $product->category=$request->Category;
            $product->discount_price=$request->Discount;
            $product->save();

            Toastr::success('product added successfully', 'Success');
            return redirect('show/product');


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function show_product(){


        try {

            $products=Product::all();

            return view('admin.ShowProduct',compact('products'));

        }catch (ModelNotFoundException $exception){

            return back()->withError($exception->getMessage())->withInput();
        }
    }

     function edit_product($id){

        try {
            $product=Product::find($id);
            $categories=Category::all();
            return view('admin.editProduct',compact('product','categories'));


        }catch (ModelNotFoundException $exception){

            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function update_product(Request $request){

        try {

            if ($request->image == null){

                $get =Product::find($request->id);
                $imageName= $get->image;
            }
            else{


                $image=$request->image;
                $imageName=time().'.'.$image->getClientOriginalExtension();
                $image->move('product',$imageName);
            }




             $product=Product::find($request->id);
            $product->title=$request->title;
            $product->description=$request->Description;
            $product->image=$imageName;
            $product->price=$request->price;
            $product->quantity=$request->Quantity;
            $product->category=$request->Category;
            $product->discount_price=$request->Discount;
            $product->save();

            Toastr::success('product updated successfully', 'Success');
            return redirect('show/product');


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }


    public function delete_product($id){
        try {

            $deleteProduct=Product::find($id);
            $deleteProduct->delete();
            Toastr::error('Product deleted successfully', 'delete');
            return redirect('show/product');

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }


    public function order(){

        try {
            $orders=Order::all();
            return view('admin.order',compact('orders'));

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function delivered($id){

        try {

            $order=Order::find($id);
            $order->delivery_status='delivered';
            $order->payment_status='paid';
            $order->save();

            Toastr::success('status updated successfully', 'Success');
            return redirect('order');


        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function print_pdf($id){

        try {
            $orders=Order::find($id);
            $pdf=PDF::loadView('admin.pdf',compact('orders'));
            return $pdf->download('order details.pdf');

        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function search(Request $request){

        $searchText=$request->search;
        $orders=Order::where('name','LIKE',"%$searchText%")
            ->orWhere('name','LIKE',"%$searchText%")
            ->orWhere('phone','LIKE',"%$searchText%")
            ->orWhere('product_title','LIKE',"%$searchText%")->get();

        return view('admin.order',compact('orders'));

    }



}
