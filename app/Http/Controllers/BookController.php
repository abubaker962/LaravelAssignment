<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;



class BookController extends Controller
{
    function index()
    {
        $books = Book::paginate(10);
        return view('book.index', ['books' => $books]);
    }

    function showAddBookForm()
    {
        return view('book.addNewBookForm');
    }

    function addBook(Request $request)
    {
        $this->validateFormData($request);
        $book = new Book;
        $book->book_name = $request->input('book_name');
        $book->publisher_name = $request->input('publisher_name');
        $book->isbn = $request->input('isbn');
        $book->cover_image = $this->saveCoverImage($request);
        $book->save();
        return redirect()->route('all-books')->with('message', 'Book Added Successfully');
    }

    function saveCoverImage($request)
    {
        if ($request->hasfile('cover_image')) {
            $file = $request->file('cover_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/', $filename);
            return $filename;
        } else {
            return '';
        }
    }

    function editBook($id)
    {
        $book = Book::find($id);
        return view('book.editBook')->with('book', $book);
    }

    function updateBook(Request $request, $id)
    {
        $this->validateFormData($request);
        $book = Book::find($id);
        $book->book_name = $request->input('book_name');
        $book->publisher_name = $request->input('publisher_name');
        $book->isbn = $request->input('isbn');
        if ($request->hasfile('cover_image')) {
            $book->cover_image = $this->saveCoverImage($request);
        }
        $book->update();
        return redirect()->route('all-books')->with('message', 'Book Updated Successfully');
    }

    function validateFormData($request)
    {
        $this->validate($request, [
            'book_name' => 'required|max:255',
            'publisher_name' => 'required|max:255',
            'isbn' => 'required|numeric',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    function deleteBook($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('all-books')->with('message', 'Book Deleted Successfully');
    }

    function search(Request $request)
    {
        $query = $request->input('search_query');
        $books = Book::whereRaw(
            "MATCH(book_name, publisher_name, isbn) AGAINST(?)",
            array($query)
        )->paginate(10);
        return view('book.index', ['books' => $books]);
    }
}
