<?php
namespace App\Http\Controllers;
use App\Models\{Product,Category,ActivityLog};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $q=$request->string('q');
        $products=Product::with('category')->when($q,fn($x)=>$x->where('name','like',"%$q%")->orWhere('sku','like',"%$q%"))->latest()->paginate(10)->withQueryString();
        return view('products.index',compact('products','q'));
    }
    public function create(){return view('products.create',['categories'=>Category::orderBy('name')->get()]);}
    public function store(Request $r){$d=$r->validate(['sku'=>'required|max:50|unique:products,sku','name'=>'required|max:150','category_id'=>'required|exists:categories,id','price'=>'required|numeric|min:0','stock_quantity'=>'required|integer|min:0','description'=>'nullable']); $p=Product::create($d); ActivityLog::record("Added product {$p->name}"); return redirect()->route('products.index')->with('success','Product added.');}
    public function edit(Product $product){return view('products.edit',['product'=>$product,'categories'=>Category::orderBy('name')->get()]);}
    public function update(Request $r,Product $product){$d=$r->validate(['sku'=>'required|max:50|unique:products,sku,'.$product->id,'name'=>'required|max:150','category_id'=>'required|exists:categories,id','price'=>'required|numeric|min:0','stock_quantity'=>'required|integer|min:0','description'=>'nullable']); $product->update($d); ActivityLog::record("Updated product {$product->name}"); return redirect()->route('products.index')->with('success','Product updated.');}
    public function destroy(Product $product){$name=$product->name;$product->delete();ActivityLog::record("Deleted product {$name}");return back()->with('success','Product deleted.');}
    public function show(Product $product){return redirect()->route('products.edit',$product);}
}
