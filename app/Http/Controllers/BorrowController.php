<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBookBorrowRequest;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;
use App\Http\Requests\UpdateBookBorrowRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Route::currentRouteName() == null)
            return response()->json(Borrow::all(), 200);

            // $borrowedBooks = Book::find(
            //     Borrow::where('user_id', '=', Auth::user()->user_id)
            //             ->whereNull('return_date')
            //             ->pluck('book_id')
            // );
            
            $borrows = Borrow::with('book')->where('user_id', '=', Auth::user()->user_id)
                        ->whereNull('return_date')->get();
    
            return view('borrows.index', [
                'borrows' => $borrows
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
     * @param  \App\Http\Requests\StoreBookBorrowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookBorrowRequest $request)
    {
        $borrow = null ; 
        DB::transaction(function () use ($request, &$borrow) {
            // $user = User::find($request->user_id);
            $book = Book::find($request->book_id);
            $book->available = false ;
            $book->updated_at = Carbon::now() ;

            $book->save();
            
            $request['created_at'] = Carbon::now();
            $borrow = Borrow::create($request->all()) ;
        });

        if (Route::currentRouteName() == null)
            return response()->json($borrow, 201) ;

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        if (Route::currentRouteName() == null)
            return response()->json($borrow, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookBorrowRequest  $request
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookBorrowRequest $request, Borrow $borrow)
    {

        DB::transaction(function () use ($request, &$borrow) {
            // $user = User::find($request->user_id);
            $book = Book::find($request->book_id);
            $book->available = true ;
            $book->updated_at = Carbon::now() ;

            $book->save();
            
            $request['updated_at'] = Carbon::now();
            $request['return_date'] = Carbon::now();
            $borrow->update($request->all()) ;
        });

        if (Route::currentRouteName() == null)
            return response()->json($borrow->refresh(), 205) ;

        return redirect()->route('borrow.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        $borrow->delete() ;

        if (Route::currentRouteName() == null)
            return response()->json([
                'message' => "Borrow Record deleted successfully!"
            ],204);
    }
}
