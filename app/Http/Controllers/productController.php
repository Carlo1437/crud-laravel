<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class productController extends Controller
{
    public function productList()
    {
        $products = product::where('status', '=', 'Not_Deleted') // Add your condition here
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('products.list', [
            'products' => $products
        ]);
    }


    public function create(){
        return view('products.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if( $request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }


        $product = new product ();
        $product->product_name = $request->product_name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){


             // pag store og image sa database
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;

        //directory products kung asa ma save ang image
        $image->move(public_path('upload/products'), $imageName);

        // pag save og image sa database
        $product->image = $imageName;
        $product->save();

        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
        }



    }


    public function edit($id){
        $product = product::findorFail($id);
        return view('products.edit',[
            'product'=>$product
        ]);

    }
    public function update($id, Request $request){
        $product = product::findOrFail($id);
        $rules = [
            'product_name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if( $request->image != ""){
            $rules['image'] = 'image';

        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }
        $product->product_name = $request->product_name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            //delete all image sa database
            File::delete(public_path('upload/products/'.$product->image));


            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;

            //directory products kung asa ma save ang image
            $image->move(public_path('upload/products'), $imageName);

            // pag save og image sa database
            $product->image = $imageName;
            $product->save();


        }

            return redirect()->route('dashboard')->with('success', 'Product update successfully.');

    }

    public function destroy($id){
        $product = product::findOrFail($id);

        File::delete(public_path('upload/products/'.$product->image));

        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product delete successfully.');

    }

    public function softDelete($id) {
        Log::info("Soft delete triggered for product ID: $id");

        $product = product::find($id);
        if (!$product) {
            Log::error("Product not found for ID: $id");
            return redirect()->route('products.list')->with('error', 'Product not found.');
        }

        $product->update(['status' => 'Soft_Deleted']);

        Log::info("Product soft-deleted: ", ['id' => $product->id]);

        return redirect()->route('dashboard')->with('success', 'Product archived successfully.');
    }

    public function restore($id) {
        $product = product::find($id);

        $product->update(['status' => 'Not_Deleted']);

        return redirect()->route('products.storedData')->with('success', 'Succes restore Data.');

    }

    public function storedData(){

        $products = product::where('status', '=', 'Soft_Deleted') // Add your condition here
        ->orderBy('created_at', 'DESC')
        ->get();
          Log::info("products", ['products' => $products]);

         return view('products.storedData', [
            'products' => $products
        ]);
    }

public function register(){
    return view('auth.register');
}


}
