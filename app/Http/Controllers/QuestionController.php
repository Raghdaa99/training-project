<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions =Question::all();
        return response()->view('cms.questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.questions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:supervisor,trainer',
            'title' => 'required|string',
            'max_mark' => 'required|numeric',
        ]);

        if (!$validator->fails()) {
            $question = new Question();
            $question->title = $request->input('title');
            $question->guard = $request->input('guard');
            $question->max_mark = $request->input('max_mark');
            $isSaved = $question->save();
            return response()->json(
                ['message' => $isSaved ? 'Created successfully' : 'Create failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return response()->view('cms.questions.edit',['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:supervisor,trainer',
            'title' => 'required|string',
            'max_mark' => 'required|numeric',
        ]);

        if (!$validator->fails()) {
            $question->title = $request->input('title');
            $question->guard = $request->input('guard');
            $question->max_mark = $request->input('max_mark');
            $isSaved = $question->save();
            return response()->json(
                ['message' => $isSaved ? 'Created successfully' : 'Create failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $isDeleted = $question->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted Successfully' : 'Delete failed'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
        );
    }
}
