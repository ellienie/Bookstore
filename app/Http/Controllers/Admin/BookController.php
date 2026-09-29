<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku.
     */
    public function index(): View
    {
        $books = Book::with('category')
            ->latest()
            ->get();

        return view('admin.books.index', compact('books'));
    }

    /**
     * Menampilkan form tambah buku.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.create', compact('categories'));
    }

    /**
     * Menyimpan data buku baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'author' => [
                'required',
                'string',
                'max:255',
            ],
            'isbn' => [
                'nullable',
                'string',
                'max:50',
                'unique:books,isbn',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /**
         * Jika admin mengupload cover,
         * simpan file ke storage/app/public/books.
         */
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('books', 'public');
        }

        Book::create($validated);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit(Book $book): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.edit', compact(
            'book',
            'categories'
        ));
    }

    /**
     * Memperbarui data buku.
     */
    public function update(
        Request $request,
        Book $book
    ): RedirectResponse {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'author' => [
                'required',
                'string',
                'max:255',
            ],
            'isbn' => [
                'nullable',
                'string',
                'max:50',
                'unique:books,isbn,' . $book->id,
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /**
         * Jika cover baru diupload:
         * 1. Hapus cover lama.
         * 2. Simpan cover baru.
         */
        if ($request->hasFile('cover_image')) {
            if (
                $book->cover_image &&
                Storage::disk('public')->exists($book->cover_image)
            ) {
                Storage::disk('public')
                    ->delete($book->cover_image);
            }

            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('books', 'public');
        }

        $book->update($validated);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku dan cover-nya.
     */
    public function destroy(Book $book): RedirectResponse
    {
        /**
         * Hapus cover dari storage terlebih dahulu
         * jika file masih tersedia.
         */
        if (
            $book->cover_image &&
            Storage::disk('public')->exists($book->cover_image)
        ) {
            Storage::disk('public')
                ->delete($book->cover_image);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}