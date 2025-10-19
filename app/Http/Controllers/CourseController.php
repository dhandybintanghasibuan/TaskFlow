<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->courses()->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        // Kita tidak perlu halaman terpisah, kita akan pakai modal di index
        return redirect()->route('courses.index');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Auth::user()->courses()->create($request->all());
        return back()->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(Course $course)
    {
        // Kita tidak akan menggunakan method ini, edit akan dilakukan di index
        return redirect()->route('courses.index');
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            abort(403);
        }
        $request->validate(['name' => 'required|string|max:255']);
        $course->update($request->all());
        return back()->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            abort(403);
        }
        $course->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus!');
    }
}