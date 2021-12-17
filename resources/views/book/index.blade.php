@extends('layouts.app')

@section('content')
<div class="float-right">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    <form action="{{ route('new-book-form') }}" method="GET" class="float-right">
        <button type="submit" id="add-book" class="btn btn-primary ">
            <i class="fa fa-btn fa-plus"></i> Add New Book
        </button>
    </form>
    <form action="{{ route('search') }}" method="GET" class="float-right">
        <input type="text" name="search_query" placeholder="Search books...">
        <button type="submit" id="add-book" class="btn btn-secondary ">
            <i class="fa fa-btn fa-search"></i> Search
        </button>
    </form>
</div>
@if (count($books) > 0)
<div class="panel panel-default">

    <div class="panel-heading">
        Books
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>Book Name</th>
                <th>Publisher Number </th>
                <th>ISBN Number</th>
                <th colspan="2">Operations</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td class="table-text">
                        <div>{{ $book->book_name }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $book->publisher_name }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $book->isbn }}</div>
                    </td>
                    <td>
                        <form action="{{ url('editBook/'.$book->id) }}" method="GET">
                            <button type="submit" id="update-book-{{ $book->id }}" class="btn btn-info">
                                <i class="fa fa-btn fa-pencil"></i> Edit
                            </button>
                        </form>
                        <form action="{{ url('deleteBook/'.$book->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" id="delete-book-{{ $book->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $books->render() }}
@endif

@endsection