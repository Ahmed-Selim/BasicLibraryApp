<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $borrowedBooksId = Borrow::where('user_id', '=', Auth::user()->user_id)-> whereNull('return_date')->pluck('book_id') ;
        $booksToBorrow = Book::whereNotIn('book_id', $borrowedBooksId)->where('available', 1)->get() ;
        
        return view('home', [
            'books' => $booksToBorrow
        ]);
    }
}
