<?php
namespace App\Http\Controllers;
use App\Models\{User,Product,Post,ActivityLog};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'users'=>User::count(), 'products'=>Product::count(), 'posts'=>Post::count(),
            'views'=>Post::sum('views'), 'lowStock'=>Product::where('stock_quantity','<=',5)->orderBy('stock_quantity')->get(),
            'activities'=>ActivityLog::with('user')->latest()->limit(8)->get(),
            'topPosts'=>Post::orderByDesc('views')->limit(5)->get(),
        ]);
    }
}
