@extends('layouts.app')

@section('content')
<div class=container-fluid>
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

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
                                <th class="col-2">Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Language</th>
                                <th>Publication Year</th>
                                <th>Price</th>
                                <th>Borrow</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($books as $book)
                                    <tr class="align-baseline">
                                        <td scope="row">{{ $book->book_id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->category->category }}</td>
                                        <td>{{ $book->author->author_name }}</td>
                                        <td>{{ $book->language->language }} ({{ $book->language->language_abbr }})</td>
                                        <td>{{ $book->publication_year }}</td>
                                        <td>$ {{ number_format($book->price / 100, 2) }}</td>
                                        <td>
                                            <form method="post" action="{{ route('borrow.store') }}">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->book_id }}" >
                                                <input type="submit" class="btn btn-outline-primary" value="+ Borrow">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                
                                @if ($books->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="8">
                                            No Books to borrow yet!
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
