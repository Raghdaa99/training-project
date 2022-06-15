<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create_student_evaluation($id)
    {

        $guard = Auth('supervisor')->check() ? 'supervisor' : 'trainer';

        $questions = Question::where('guard', '=', $guard)->get();
        $evaluations = Evaluation::whereHas('question', function ($query) use ($guard) {
            $query->where('guard', '=', 'trainer');
        })->where('student_company_id', '=', $id)->get();

        $sum_max_mark = DB::table('questions')->where('guard', '=','trainer' )->sum('max_mark');
        $sum_mark = Evaluation::whereHas('question', function ($query) use ($guard) {
            $query->where('guard', '=', 'trainer');
        })->where('student_company_id', '=', $id)
            ->sum('mark');
        return response()->view('cms.evaluations.create', [
            'questions' => $questions,
            'student_company_id' => $id,
            'guard'=>$guard,
            'evaluations' => $evaluations,
            'sum_max_mark' => $sum_max_mark,
            'sum_mark' => $sum_mark
            ]);

    }

    public function show_student_evaluation($id)
    {
        $guard = Auth('supervisor')->check() ? 'supervisor' : 'trainer';
//        $evaluations = Evaluation::where('student_company_id', '=', $id)->get();
        $evaluations = Evaluation::whereHas('question', function ($query) use ($guard) {
            $query->where('guard', '=', $guard);
        })->where('student_company_id', '=', $id)->get();

        $sum_max_mark = DB::table('questions')->where('guard', '=', $guard)->sum('max_mark');
        $sum_mark = Evaluation::whereHas('question', function ($query) use ($guard) {
            $query->where('guard', '=', $guard);
        })->where('student_company_id', '=', $id)
            ->sum('mark');
//        $sum_mark = DB::table('evaluations')->where('student_company_id', '=', $id)->sum('mark');


        return response()->view('cms.evaluations.show',
            ['evaluations' => $evaluations,
                'student_company_id' => $id,
            'sum_max_mark' => $sum_max_mark,
            'sum_mark' => $sum_mark
        ]);
    }

    public function show_supervisor_evaluation_trainer($id)
    {
//        $guard = Auth('supervisor')->check() ? 'supervisor' : 'trainer';
//        $evaluations = Evaluation::where('student_company_id', '=', $id)->get();
        $evaluations = Evaluation::whereHas('question', function ($query) {
            $query->where('guard', '=', 'trainer');
        })->where('student_company_id', '=', $id)->get();

        $sum_max_mark = DB::table('questions')->where('guard', '=', 'trainer')->sum('max_mark');
        $sum_mark = Evaluation::whereHas('question', function ($query) {
            $query->where('guard', '=', 'trainer');
        })->where('student_company_id', '=', $id)
            ->sum('mark');
        return response()->view('cms.evaluations.show-evaluations-trainer-to-supervisor',
            ['evaluations' => $evaluations, 'student_company_id' => $id, 'sum_max_mark' => $sum_max_mark,
                'sum_mark' => $sum_mark]);
    }

    public function edit_student_evaluation($id)
    {
        $guard = Auth('supervisor')->check() ? 'supervisor' : 'trainer';
//        $evaluations = Evaluation::where('student_company_id', '=', $id)->get();
        $evaluations = Evaluation::whereHas('question', function ($query) use ($guard) {
            $query->where('guard', '=', $guard);
        })->where('student_company_id', '=', $id)->get();
        return response()->view('cms.evaluations.edit', ['evaluations' => $evaluations, 'student_company_id' => $id]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'student_company_id' => 'required|numeric|exists:students_company_field,id',
            'marks.*' => 'required'
//            'question_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
//            'mark' => 'required|numeric',

        ]);

        if (!$validator->fails()) {
//            $evaluation = new Evaluation();
//            $evaluation->student_company_id = $request->input('student_company_id');

            $questions_marks = $request->input('question_id');
            $marks = $request->input('marks');
            $max_marks = $request->input('max_marks');
            $isValid = true;

            foreach ($max_marks as $key => $value) {
                if ($marks[$key] > $max_marks[$key]) {
                    $isValid = false;
                    break;
                }
            }
            if ($isValid) {
                $isSaved = false;
                foreach ($questions_marks as $key => $value) {
                    DB::table('evaluations')->insert([
                        'mark' => $marks[$key],
                        'question_id' => $value,
                        'student_company_id' => $request->input('student_company_id'),
                    ]);
                    if ($key == count($questions_marks) - 1) {
                        $isSaved = true;
                    }
                }
//            $isSaved = $evaluation->save();
                return response()->json(
                    [
                        'message' => $isSaved ? 'Evaluation created successfully' : 'Create failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => 'error in data of max marks'], Response::HTTP_BAD_REQUEST);
            }

            // }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
//        dd($request->marks);
        $validator = Validator($request->all(), [
//            'student_company_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
//            'question_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
//            'mark' => 'required|numeric',

        ]);

        if (!$validator->fails()) {
//            $evaluation = new Evaluation();
//            $evaluation->student_company_id = $request->input('student_company_id');

//            DB::table('evaluations')->where('student_company_id', '=', $request->input('student_company_id'))
//                ->delete();

            $questions_marks = $request->input('question_id');
            $marks = $request->input('marks');
            $max_marks = $request->input('max_marks');
            $isValid = true;

            foreach ($max_marks as $key => $value) {
                if ($marks[$key] > $max_marks[$key]) {
                    $isValid = false;
                    break;
                }
            }


            if ($isValid) {
                $guard = Auth('supervisor')->check() ? 'supervisor' : 'trainer';
                $deleted = Evaluation::whereHas('question', function ($query) use ($guard) {
                    $query->where('guard', '=', $guard);
                })->where('student_company_id', '=', $request->input('student_company_id'))->delete();

                $questions_marks = $request->input('question_id');
                $marks = $request->input('marks');

                $isSaved = false;
                foreach ($questions_marks as $key => $value) {
                    DB::table('evaluations')->insert([
                        'mark' => $marks[$key],
                        'question_id' => $value,
                        'student_company_id' => $request->input('student_company_id'),
                    ]);
                    if ($key == count($questions_marks) - 1) {
                        $isSaved = true;
                    }
                }
                return response()->json(
                    [
                        'message' => $isSaved ? 'Evaluation Updated successfully' : 'Updated failed!'
                    ],
                    $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => 'error in data of max marks'], Response::HTTP_BAD_REQUEST);
            }
            // }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
