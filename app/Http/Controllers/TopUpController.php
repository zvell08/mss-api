<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopUp;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class TopUpController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'student_id' => 'required|exists:students,id',
                'nominal' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $topUp = TopUp::create([
                'user_id' => $request->input('user_id'),
                'student_id' => $request->input('student_id'),
                'nominal' => $request->input('nominal'),
            ]);


            $student = Student::find($request->input('student_id'));

            if (!$student) {
                throw new \Exception('Siswa tidak ditemukan.');
            }

            $student->wallet->amount += $request->input('nominal');
            $student->wallet->save();

            return response()->json(['message' => 'Top-up berhasil', 'top_up' => $topUp], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}