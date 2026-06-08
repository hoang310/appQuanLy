<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'category'])->paginate(2);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.createOrUpdate', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:50|unique:books,isbn',

            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',

            'publisher' => 'required|string|max:255',
            'publish_year' => 'required|integer|min:1900|max:' . date('Y'),

            'quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('uploads/books'), $imageName);

            $validated['image'] = 'uploads/books/' . $imageName;
        }

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Thêm sách thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.createOrUpdate', compact(
            'book',
            'authors',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:50|unique:books,isbn,' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'publish_year' => 'required|integer',
            'quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {

            // Xóa ảnh cũ nếu có
            if ($book->image && file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('uploads/books'), $imageName);

            $validated['image'] = 'uploads/books/' . $imageName;
        }

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Cập nhật sách thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
