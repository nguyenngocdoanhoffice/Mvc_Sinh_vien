<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $major = $request->query('major');
        $sort = $request->query('sort', 'name_asc');

        $query = Student::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($major) {
            $query->where('major', 'like', "%{$major}%");
        }

        $firstLetterExpr = "LOWER(LEFT(TRIM(SUBSTRING_INDEX(name, ' ', -1)), 1))";

        if ($sort === 'name_asc') {
            $query->orderByRaw("{$firstLetterExpr} ASC")->orderByRaw("TRIM(SUBSTRING_INDEX(name, ' ', -1)) ASC");
        } elseif ($sort === 'name_desc') {
            $query->orderByRaw("{$firstLetterExpr} DESC")->orderByRaw("TRIM(SUBSTRING_INDEX(name, ' ', -1)) DESC");
        } else {
            $query->orderBy('id', 'asc');
        }

        $students = $query->paginate(5)->appends($request->only(['search', 'major', 'sort']));

        return view('student_list', compact('students', 'search', 'major', 'sort'));
    }

    public function create()
    {
        return view('add_student');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'major' => 'required|max:255',
        ]);

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công');
    }

    public function edit(Student $student)
    {
        return view('edit_student', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'major' => 'required|max:255',
        ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công');
    }
}
