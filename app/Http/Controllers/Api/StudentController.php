<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::select('full_name', 'phone', 'school_id')->with('school')->get();

        $students->transform(function($student) {
            return [
                "Nome" => $student->full_name,
                "Telefone" => $student->phone,
                "Instituição escolar" => $student->school->name,
            ];
        });

        return response()->json($students);
    }
}
