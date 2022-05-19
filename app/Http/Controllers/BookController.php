<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Borrow;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Route::currentRouteName() == null)
            return response()->json(Book::all(), 200);

        $borrowedBooksId = Borrow::where('user_id', '=', Auth::user()->user_id)-> whereNull('return_date')->pluck('book_id') ;
        $booksToBorrow = Book::whereNotIn('book_id', $borrowedBooksId)->where('available', 1)->get() ;
        
        return view('books.index', [
            'books' => $booksToBorrow
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // {
        //     "title": "What's Love!" ,
        //     "price": 10000,
        //     "available": true,
        //     "author_id": 6,
        //     "category_id": 41,
        //     "language_id": 61,
        //     "publication_year": 2022
        // }
        $request['created_at'] = Carbon::now();

        $book = Book::create($request->all()) ;

        if (Route::currentRouteName() == null)
            return response()->json($book, 201) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        if (Route::currentRouteName() == null)
            return response()->json($book, 200);
        return view('books.show') ;  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // return $request;
        $request['updated_at'] = Carbon::now();
        
        $book->update($request->all()) ;

        if (Route::currentRouteName() == null)
            return response()->json($book, 205) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete() ;

        if (Route::currentRouteName() == null)
            return response()->json([
                'message' => "Book deleted successfully!"
            ],204);
    }
}
