<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_company_id)
    {
        $attendances = Attendance::where('student_company_id', $student_company_id)->get();
        return response()->view('cms.trainer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'date_attendance' => 'required|date_format:d-m-Y',
//            'day_attendance' => 'required|string',
//            'start_time' => 'required|date_format:H:i:s',

        ]);
        if (!$validator->fails()) {
            $attendance = new Attendance();
            $attendance->student_company_id = $request->student_company_id;
            $attendance->date_attendance = Carbon::parse($request->input('date_attendance'))->format('Y-m-d');
            $attendance->day_attendance = Carbon::parse($request->input('date_attendance'))->format('l');
//            $attendance->day_attendance = $request->day_attendance;

            $attendance->time_attendance = Carbon::now()->format('H:i');
            $isSaved = $attendance->save();

            return response()->json(
                [
                    'message' => $isSaved ? 'Attendance created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Attendance $attendance)
    {
        $isDeleted = $attendance->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
