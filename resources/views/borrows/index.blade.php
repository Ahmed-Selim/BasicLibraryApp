@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('My inventory') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover  table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Borrow Date</th>
                                <th>Due Date</th>
                                <th>Price</th>
                                <th>Return</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($borrows as $borrow)
                                    <tr class="align-baseline">
                                        <td scope="row">{{ $borrow->book->book_id }}</td>
                                        <td>{{ $borrow->book->title }}</td>
                                        <td>{{ $borrow->borrow_date }}</td>
                                        <td>{{ $borrow->due_date }}</td>
                                        <td>$ {{ number_format($borrow->book->price / 100, 2) }}</td>
                                        <td>
                                            <form method="post" action="{{ route('borrow.update', $borrow) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="book_id" value="{{ $borrow->book->book_id }}" >
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}" >
                                                <input type="submit" class="btn btn-outline-dark" value="Return -">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                @if ($borrows->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="8">
                                            No Books borrowed yet!
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
