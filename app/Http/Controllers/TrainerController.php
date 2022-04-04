<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentCompanyField;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainer = Auth::guard('trainer')->user();
        $company_students = StudentCompanyField::whereHas('companies', function ($query) use ($trainer) {
            $query->where('id', '=', $trainer->company_id);
        })->get();
//        dd($company_students->all());
        return response()->view('cms.trainer.index', ['students' => $company_students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_trainer($company_student_id)
    {
        $item = StudentCompanyField::findOrFail($company_student_id);
        $company_id = $item->company_id;
        return response()->view('cms.trainer.create', ['company_id' => $company_id]);
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
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:trainers,email',
            'phone' => 'required|string|unique:trainers,phone',
            'password' => 'required|string|min:3|max:20',
            'company_id' => 'required|numeric|exists:companies,id',

        ]);

        if (!$validator->fails()) {
            $trainer = new Trainer();
            $trainer->name = $request->input('name');
            $trainer->email = $request->input('email');
            $trainer->phone = $request->input('phone');
            $trainer->company_id = $request->input('company_id');
            $trainer->password = Hash::make($request->input('password'));
            $isSaved = $trainer->save();
            if ($isSaved) {
//                $supervisor->assignRole(Role::findById(2, 'supervisor'));
                return response()->json(
                    [
                        'message' => $isSaved ? 'Trainer created successfully' : 'Create failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}
