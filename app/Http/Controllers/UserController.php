<?php
namespace App\Http\Controllers;
use App\Models\{User,ActivityLog};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
 public function index(){abort_unless(auth()->user()->role==='Admin',403);return view('users.index',['users'=>User::latest()->paginate(10)]);}
 public function create(){abort_unless(auth()->user()->role==='Admin',403);return view('users.create');}
 public function store(Request $r){abort_unless(auth()->user()->role==='Admin',403);$d=$r->validate(['name'=>'required|max:120','email'=>'required|email|unique:users,email','password'=>'required|min:8','role'=>'required|in:Admin,Editor,Viewer','status'=>'required|in:Active,Inactive']);$d['password']=Hash::make($d['password']);$u=User::create($d);ActivityLog::record("Added user {$u->name}");return redirect()->route('users.index')->with('success','User created.');}
 public function edit(User $user){abort_unless(auth()->user()->role==='Admin',403);return view('users.edit',compact('user'));}
 public function update(Request $r,User $user){abort_unless(auth()->user()->role==='Admin',403);$d=$r->validate(['name'=>'required|max:120','email'=>'required|email|unique:users,email,'.$user->id,'password'=>'nullable|min:8','role'=>'required|in:Admin,Editor,Viewer','status'=>'required|in:Active,Inactive']);if($d['password']??null)$d['password']=Hash::make($d['password']);else unset($d['password']);$user->update($d);return redirect()->route('users.index')->with('success','User updated.');}
 public function destroy(User $user){abort_unless(auth()->user()->role==='Admin',403);if($user->id===auth()->id())return back()->with('error','You cannot delete your own account.');$user->delete();return back()->with('success','User deleted.');}
}
