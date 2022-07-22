<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::oldest()->paginate(5);
        return view('index',compact('products'))->with('i',(request()->input('page',1)-1)*5);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if($image = $request->file('image')){
            $dedpath = 'images/';
            $proimage = date('YmdHis').".". $image->getClientOriginalExtension();
            $image->move($dedpath,$proimage);
            $input['image']="$proimage";
        }

        Product::create($input);
        return redirect()->route('index')->with('success','Product added successfully.');
    }

    public function show(Product $product)
    {
        return view('show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required'
        ]);

        $input = $request->all();

        if($image = $request->file('image')){
            $dedpath = 'images/';
            $proimage = date('YmdHis').".". $image->getClientOriginalExtension();
            $image->move($dedpath,$proimage);
            $input['image']="$proimage";
        }
        else{
            unset($input['image']);
        }

        $product->update($input);
        return redirect()->route('index')->with('success','Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('index')->with('success','Product deleted successfully.');
    }

    public function changeStatus($product){
        $getstatus = Product::select('status')->where('id',$product)->first();
        if($getstatus->status==1){
            $status = 0;
        }
        else{
            $status = 1;
        }
        Product::where('id',$product)->update(['status'=>$status]);
        return redirect()->back();
    }
}
