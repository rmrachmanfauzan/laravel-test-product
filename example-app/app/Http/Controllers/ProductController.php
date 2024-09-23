<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product;
 
class ProductController extends Controller
{
    /**
     * Show the profile for a given user.
     */

    public function index()
    {

        $product = Product::get();

        return $this->response($product);
        
    }

    public function show($id)
    {

        $product = Product::find($id);
        if (!$product) {
            return $this->response(null,$message="Product Not Found");
        }
        return $this->response($product);
    
    }
    
    public function create(Request $request)
    {

        $product = new Product;
        $product->name =  $request->name;
        $product->descriptions =  $request->descriptions;
 
        $product->save();

        return $this->response($product);
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return $this->response(null,$message="Product Not Found");
        }

        if ($product) {
            $product->name =  $request->name;
            $product->descriptions =  $request->descriptions;
            $product->save();
        }
        return $this->response($product);
    }

    public function delete($id)
    {

        $product = Product::find($id);
        $product->delete();

        return $this->response($product);
    }

    public function response($data,$message="OK")    
    {
        $response = $data;

        $resp = [];
        $resp['message'] = $message;
        $resp['data'] = $data;
        return $resp;
    }

    
}