@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add New Book
            </div>
            <div class="panel-body">
                @include('common.errors')
                <form action="{{ route('add-book')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="bookName" class="col-sm-3 control-label">Book Name</label>
                        <input type="text" name="book_name" id="book_name" class="form-control" value="{{ old('book_name') }}">
                        <label for="bookPublisher" class="col-sm-3 control-label">Publisher Name</label>
                        <input type="text" name="publisher_name" id="publisher_name" class="form-control" value="{{ old('publisher_name') }}">
                        <label for="bookIsbn" class="col-sm-3 control-label">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}">
                        <label for="bookCover" class="col-sm-3 control-label">Upload Cover Image:</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i> Add Book
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection