<?php

namespace App\Http\Controllers\Owner;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $categories = Kategori::paginate(10); // Example pagination, adjust as needed
        return view('Owner.kategoriread', compact('categories'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('Owner.kategoricreate');
    }

    // Store a new category
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:255|unique:kategori,kode_kategori',
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Create a new category
        Kategori::create([
            'kode_kategori' => $validated['kode_kategori'],
            'nama_kategori' => $validated['nama_kategori'],
        ]);
        return redirect()->route('kategori.index')->with('success', 'Category created successfully.');
    }

    // Show the form to edit an existing category
    public function edit($kode_kategori)
    {
        $category = Kategori::findOrFail($kode_kategori);
        return view('Owner.kategoriedit', compact('category'));
    }

    // Update an existing category
    public function update(Request $request, $kode_kategori)
    {
         // Validate the input data
            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            // Find the category and update it
            $category = Kategori::findOrFail($kode_kategori);
            $category->update([
                'nama_kategori' => $validated['nama_kategori'],
            ]);

        return redirect()->route('kategori.index')->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroy($kode_kategori)
    {
        $category = Kategori::findOrFail($kode_kategori);
        $category->delete();
        return redirect()->route('kategori.index')->with('success', 'Category deleted successfully.');
    }
}
