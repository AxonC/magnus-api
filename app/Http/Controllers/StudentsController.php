<?php

namespace App\Http\Controllers;

use App\Student;

class StudentsController extends Controller
{
	public function index()
	{
		$students = Student::with('course')->get();

		return response()->json(['data' => ['students' => $students]]);
	}
}