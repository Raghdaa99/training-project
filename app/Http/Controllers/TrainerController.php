<?php

namespace App\Http\Controllers;

use App\Mail\TrainerEmail;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\StudentCompanyField;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
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
//        $company_students = StudentCompanyField::whereHas('companyField', function ($query) use ($trainer) {
//            $query->where('id', '=', $trainer->company_id);
//        })->get();
//        dd($company_students->all());

        $company_students = StudentCompanyField::where('trainer_id', '=', $trainer->id)->get();
        return response()->view('cms.trainer.index', ['students' => $company_students]);
    }

    public function show_trainers_company($id): \Illuminate\Http\Response
    {
        $student_company_field = StudentCompanyField::findOrFail($id);
        $trainers = Trainer::where('company_id', '=', $student_company_field->companyField->company->id)->get();
        return response()->view('cms.trainer.show_trainers_company', ['trainers' => $trainers, 'student_company_id' => $id]);
    }


    public function show_attendances_students($student_company_id): \Illuminate\Http\Response
    {
//        $student_company_field = StudentCompanyField::findOrFail($student_company_id);
        $attendances = Attendance::where('student_company_id', $student_company_id)->orderBy('date_attendance', 'asc')->get();
        return response()->view('cms.trainer.register-attendances-student', ['attendances' => $attendances,
            'student_company_id' => $student_company_id]);
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
//        $item = StudentCompanyField::findOrFail($company_student_id);
//        $company_id = $item->companyField->company_id;
        return response()->view('cms.trainer.create', ['company_student_id' => $company_student_id]);
    }


    public function create_trainer_to_company(Request $request)
    {
        $validator = Validator($request->all(), [
            'company_student_id' => 'required|numeric|exists:students_company_field,id',
            'trainer_id' => 'required|numeric|exists:trainers,id',
        ], [
            'trainer_id.required' => 'select the trainer',
        ]);
        if (!$validator->fails()) {
            $company_student_id = $request->input('company_student_id');
            $item = StudentCompanyField::findOrFail($company_student_id);
            $item->trainer_id = $request->trainer_id;
            $isSavedTrainer = $item->save();
            return response()->json(
                [
                    'message' => $isSavedTrainer ? 'Trainer created successfully' : 'Create failed!'
                ],
                $isSavedTrainer ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        $trainer = Trainer::where('email', '=', $request->input('email'))->first();
//        dd($trainer);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:trainers,email',
            'phone' => 'required|string|unique:trainers,phone',
//            'password' => 'required|string|min:3|max:20',
            'company_student_id' => 'required|numeric|exists:students_company_field,id',

        ]);
        $company_student_id = $request->input('company_student_id');
        $item = StudentCompanyField::findOrFail($company_student_id);
        $company_id = $item->companyField->company_id;
        if (!$validator->fails()) {
//            if ($trainer == null) {
            $trainer = new Trainer();
            $trainer->name = $request->input('name');
            $trainer->email = $request->input('email');
            $trainer->phone = $request->input('phone');
            $trainer->company_id = $company_id;
            $newPassword = Str::random(10);
            $trainer->password = Hash::make($newPassword);;
            $isSaved = $trainer->save();

            if ($isSaved) {
                $trainer->assignRole(Role::findByName('trainer', 'trainer'));
                Mail::to($request->email)->send(new TrainerEmail($newPassword));
                return response()->json(
                    [
                        'message' => 'Trainer created successfully'
                    ],
                    Response::HTTP_CREATED,
                );

            } else {
                return response()->json(
                    [
                        'message' => 'Create failed!'
                    ], Response::HTTP_BAD_REQUEST,
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
//            $item->trainer_id = $trainer->id;
//            $isSavedTrainer = $item->save();
//            if ($isSavedTrainer) {

//            }
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
