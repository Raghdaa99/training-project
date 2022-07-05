<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\StudentCompanyField;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return response()->view('cms')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainer = Auth::guard('trainer')->user();
//        $company_students = StudentCompanyField::whereHas('companies', function ($query) use ($trainer) {
//            $query->where('id', '=', $trainer->company_id);
//        })->get();
        $company_students = StudentCompanyField::where('trainer_id', '=', $trainer->id)->get();
        return response()->view('cms.appointments.create', ['students' => $company_students]);
    }

    public function create_student_appointment($student_company_id)
    {
//        $trainer = Auth::guard('trainer')->user();
//        $company_students = StudentCompanyField::whereHas('companies', function ($query) use ($trainer) {
//            $query->where('id', '=', $trainer->company_id);
//        })->get();
//        $company_students = StudentCompanyField::where('trainer_id', '=', $trainer->id)->get();

        return response()->view('cms.appointments.create', ['student_company_id' => $student_company_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $student_company = StudentCompanyField::findBySlugOrFail($request->input('student_company_id'));

        $validator = Validator($request->all(), [
//            'student_company_id' => 'required|numeric|exists:students_company_field,id|unique:appointments,student_company_id',
            'no_hours_of_training' => 'required|numeric',
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'Saturday' => 'required|boolean',
            'Sunday' => 'required|boolean',
            'Monday' => 'required|boolean',
            'Tuesday' => 'required|boolean',
            'Wednesday' => 'required|boolean',
            'Thursday' => 'required|boolean',
        ], [
            'student_company_id.exists' => 'This Student not found',
            'student_company_id.unique' => 'This Student has appointment',
        ]);

        if (!$validator->fails()) {
            $appointment = new Appointments();
            $appointment->student_company_id = $student_company->id;
            $appointment->no_hours_of_training = $request->input('no_hours_of_training');
            $appointment->start_time = Carbon::parse($request->input('start_time'))->format('H:i');
            $appointment->end_time = Carbon::parse($request->input('end_time'))->format('H:i');
            $appointment->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
            $appointment->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
            $appointment->Saturday = $request->input('Saturday');
            $appointment->Sunday = $request->input('Sunday');
            $appointment->Monday = $request->input('Monday');
            $appointment->Tuesday = $request->input('Tuesday');
            $appointment->Wednesday = $request->input('Wednesday');
            $appointment->Thursday = $request->input('Thursday');
            $isSaved = $appointment->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Appointment created successfully' : 'Create failed!'
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
     * @param \App\Models\Appointments $appointments
     * @return \Illuminate\Http\Response
     */
    public function show(Appointments $appointments)
    {

//        return response()->view('')
    }

    public function show_student_appointment($id)
    {
        $student_company = StudentCompanyField::findBySlugOrFail($id);
//dd($student_company->id);
        if (auth('student')->check()) {
            $guard = 'student';
        } elseif (auth('trainer')->check()) {
            $guard = 'trainer';
        } else {
            $guard = 'supervisor';
        }
//        $student_company_id = StudentCompanyField::where('')
        $appointment = Appointments::where('student_company_id', '=', $student_company->id)->first();
        return response()->view('cms.appointments.show', [
            'appointment' => $appointment,
            'student_company_id' => $student_company->slug(),
            'guard' => $guard ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Appointments $appointments
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointments $appointment)
    {
        $student_company = StudentCompanyField::findOrFail($appointment->student_company_id);

//        dd($appointment->id);
        return response()->view('cms.appointments.edit', ['appointment' => $appointment,'student_company_id' => $student_company->slug()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointments $appointments
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Appointments $appointment)
    {

        $validator = Validator($request->all(), [
//            'student_company_id' => 'required|numeric|unique:students_company_field,id',
            'no_hours_of_training' => 'required|numeric',
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'Saturday' => 'required|boolean',
            'Sunday' => 'required|boolean',
            'Monday' => 'required|boolean',
            'Tuesday' => 'required|boolean',
            'Wednesday' => 'required|boolean',
            'Thursday' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
//            $appointment->student_company_id = $request->input('student_company_id');
            $appointment->no_hours_of_training = $request->input('no_hours_of_training');
            $appointment->start_time = Carbon::parse($request->input('start_time'))->format('H:i');
            $appointment->end_time = Carbon::parse($request->input('end_time'))->format('H:i');
            $appointment->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
            $appointment->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
            $appointment->Saturday = $request->input('Saturday');
            $appointment->Sunday = $request->input('Sunday');
            $appointment->Monday = $request->input('Monday');
            $appointment->Tuesday = $request->input('Tuesday');
            $appointment->Wednesday = $request->input('Wednesday');
            $appointment->Thursday = $request->input('Thursday');
            $isSaved = $appointment->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Appointment created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
            );
            // }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appointments $appointments
     *
     */
    public function destroy(Appointments $appointment)
    {
        $isDeleted = $appointment->delete();
        if ($isDeleted) {
            session()->flash('message', 'appointment deleted successfully');
//            return redirect()->route('show.student.appointment',$appointment->student_company_id);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
//        return response()->json(
//            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
//            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
//        );
    }
}
