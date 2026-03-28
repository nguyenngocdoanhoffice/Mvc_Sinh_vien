<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $allStudents = Student::orderBy('id')->get();

        $students = Student::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->orderBy('id')->paginate(5);

        return view('student_list', compact('students', 'search', 'allStudents'));
    }

    public function create()
    {
        return view('add_student');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'major' => 'required'
        ]);

        Student::create($request->all());
        return redirect('/');
    }

    public function delete($id)
    {
        Student::find($id)->delete();
        return redirect('/');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return view('edit_student', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'major' => 'required'
        ]);

        Student::find($id)->update($request->all());
        return redirect('/');
    }
}
