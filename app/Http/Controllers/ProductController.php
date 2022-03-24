<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseTransction;
use App\SubCategory;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(){

        try{

            $products=Product::with('category', 'sub_category')
                ->orderBy('id','desc')->paginate(10);

            return respondWithSuccess('Product data found',$products,200);

        }catch(\Exception $e){
            return respondWithError($e->getMessage(),422);
        }

    }


    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|string',
            'category_id' => 'required',
            'cost_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        $input=$request->all();

        $product_id= rand(10000000,99999999);
        $input['product_id']=$product_id;

        if($request->hasFile('image')){
            $input['image'] = imageUpload('image', 'product-images');
        }

        try{

            Product::create($input);

            return respondWithSuccess('Product added successfully', [], 201);

        }catch(\Exception $e){
            return respondWithError($e->getMessage(),422);
        }

    }

    public function show($id){

        try{
            $product=Product::findOrFail($id);
            return respondWithSuccess('Product data found',$product,200);
        }catch(\Exception $e){

            return respondWithError($e->getMessage(),422);
        }

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string',
            'category_id' => 'required',
            'cost_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        $product= Product::findOrFail($id);

        $input=$request->all();

        $input['product_id']=$product->product_id;

        if($request->hasFile('image')){
            if ($product->image && file_exists($product->image)) {
                unlink($product->image);
            }
            $input['image'] = imageUpload('image', 'product-images');
        }

        try{
            $product->update($input);

            return respondWithSuccess('Product updated successfully', [], 200);

        }catch(\Exception $e){
            return respondWithError($e->getMessage(),422);
        }

    }

    public function destroy($id){

        try{
            Product::destroy($id);
            return respondWithSuccess('Product delete success');
        }catch(\Exception $e){
            return respondWithError($e->getMessage(),422);
        }

    }


    public function search($keyword) {

        try {

            $categories = Product::with('category','sub_category')->where('name', 'like', '%' . $keyword . '%')->paginate();

            return respondWithSuccess('Search result fetched successfully', $categories);

        } catch (\Exception $e) {

            return respondWithError($e->getMessage(), 422);
        }
    }

}
