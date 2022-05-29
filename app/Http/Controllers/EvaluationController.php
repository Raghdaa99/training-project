<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('cms.evaluations.index');
    }
    public function create_student_evaluation($id){

        $guard = Auth('supervisor')->check()?'supervisor':'trainer';
        $questions = Question::where('guard', '=', $guard)->get();
        return response()->view('cms.evaluations.create' ,[
            'questions' =>$questions ,'student_company_id'=>$id]);

    }
    public function show_student_evaluation($id)
    {
        $guard = Auth('supervisor')->check()?'supervisor':'trainer';
        $evaluations = Question::where('guard', '=', $guard)->get();
        return response()->view('cms.evaluations.show', ['evaluations' => $evaluations,
            'student_company_id' => $id]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.evaluations.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->question_id);
        $validator = Validator($request->all(), [

//            'student_company_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
//            'question_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
            'mark' => 'required|numeric',

        ]);

        if (!$validator->fails()) {
            $evaluation = new Evaluation();
            $evaluation->student_company_id = $request->input('student_company_id');
            $evaluation->mark = $request->input('mark');

            $isSaved = $evaluation->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Evaluation created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
            // }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
