<?php
namespace App\Http\Controllers;
use App\Models\{Category,ActivityLog};
use Illuminate\Http\Request;
class CategoryController extends Controller
{
 public function index(){return view('categories.index',['categories'=>Category::withCount('products')->orderBy('name')->get()]);}
 public function create(){return view('categories.create');}
 public function store(Request $r){$d=$r->validate(['name'=>'required|max:100|unique:categories,name','description'=>'nullable']);$c=Category::create($d);ActivityLog::record("Added category {$c->name}");return redirect()->route('categories.index')->with('success','Category added.');}
 public function edit(Category $category){return view('categories.edit',compact('category'));}
 public function update(Request $r,Category $category){$d=$r->validate(['name'=>'required|max:100|unique:categories,name,'.$category->id,'description'=>'nullable']);$category->update($d);return redirect()->route('categories.index')->with('success','Category updated.');}
 public function destroy(Category $category){if($category->products()->exists())return back()->with('error','Cannot delete a category that has products.');$category->delete();return back()->with('success','Category deleted.');}
}
