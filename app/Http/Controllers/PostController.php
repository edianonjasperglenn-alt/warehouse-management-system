<?php
namespace App\Http\Controllers;
use App\Models\{Post,ActivityLog};
use Illuminate\Http\Request;
class PostController extends Controller
{
 public function index(){return view('posts.index',['posts'=>Post::with('author')->latest()->paginate(10)]);}
 public function create(){return view('posts.create');}
 public function store(Request $r){$d=$r->validate(['title'=>'required|max:200','body'=>'required','status'=>'required|in:Draft,Published']);$d['author_id']=auth()->id();$p=Post::create($d);ActivityLog::record("Created post {$p->title}");return redirect()->route('posts.index')->with('success','Post saved.');}
 public function edit(Post $post){return view('posts.edit',compact('post'));}
 public function update(Request $r,Post $post){$d=$r->validate(['title'=>'required|max:200','body'=>'required','status'=>'required|in:Draft,Published']);$post->update($d);return redirect()->route('posts.index')->with('success','Post updated.');}
 public function destroy(Post $post){$post->delete();return back()->with('success','Post deleted.');}
 public function show(Post $post){$post->increment('views');return view('posts.show',compact('post'));}
}
