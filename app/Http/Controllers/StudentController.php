<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Mark;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slNo = 1;
        $students = Student::join('tb_student_marks', 'tb_student_details.id', '=', 'tb_student_marks.student_id')
                    ->select('tb_student_details.id', 'tb_student_details.student_name', 'tb_student_marks.mark_1', 'tb_student_marks.mark_2', 'tb_student_marks.mark_3', 'tb_student_marks.total', 'tb_student_marks.rank')
                    ->get();
        return view('students.index')->with('students', $students)->with('slNo', $slNo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = $request->mark1+$request->mark2+$request->mark3;

        if($total <= 100){
            $rank = 3;
        }
        elseif($total > 100 && $total <= 200)
        {
            $rank = 2;
        }
        else{
            $rank = 1;
        }

        $student = Student::create(['student_name'=>$request->studentName]);
        Mark::create([
            'student_id' => $student->id,
            'mark_1'=>$request->mark1,
            'mark_2'=>$request->mark2,
            'mark_3'=>$request->mark3,
            'total'=>$total,
            'rank'=>$rank
            ]);

        return response()->json(array('success' => true)); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $total = $request->mark1+$request->mark2+$request->mark3;

        if($total <= 100){
            $rank = 3;
        }
        elseif($total > 100 && $total <= 200)
        {
            $rank = 2;
        }
        else{
            $rank = 1;
        }

        Student::where('id', $request->id)->update(['student_name'=>$request->studentName]);
        Mark::where('student_id', $request->id)->update([
            'mark_1'=>$request->mark1,
            'mark_2'=>$request->mark2,
            'mark_3'=>$request->mark3,
            'total'=>$total,
            'rank'=>$rank
            ]);

        return response()->json(array('success' => true)); 
    }
}
