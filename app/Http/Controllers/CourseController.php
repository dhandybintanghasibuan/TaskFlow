<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Menampilkan halaman daftar mata kuliah.
     */
    public function index()
    {
        $courses = Auth::user()->courses()->orderBy('name', 'asc')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Menyimpan mata kuliah baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->courses()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Menghapus mata kuliah.
     */
    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            abort(403);
        }
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}