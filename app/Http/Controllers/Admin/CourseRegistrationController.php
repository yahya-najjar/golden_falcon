<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationAnswer;
use App\Models\CourseRegistration;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseRegistrationController extends Controller
{
    public function index()
    {
        if (!isset(request()->item_id)) {
            abort(404);
        }
        $course = Item::findOrFail(\request()->item_id);
        $registrations = $course->registrations;
        return view('admin.course_registrations.index', compact('registrations', 'course'));
    }

    public function show(CourseRegistration $courseRegistration)
    {
        return view('admin.course_registrations.show', compact('courseRegistration'));
    }

    public function accept(CourseRegistration $courseRegistration)
    {
        $courseRegistration->accepted = 1;
        Mail::to($courseRegistration->email)->send(new RegistrationAnswer(array(
            'status' => 1,
            'course' => $courseRegistration->course->title
        )));
        $courseRegistration->save();
        return back()->with('success', 'Registration Accepted!');
    }

    public function decline(CourseRegistration $courseRegistration)
    {
        $courseRegistration->accepted = 0;
        Mail::to($courseRegistration->email)->send(new RegistrationAnswer(array(
            'status' => 0,
            'course' => $courseRegistration->course->title
        )));
        $courseRegistration->save();
        return back()->with('success', 'Registration Declined!');
    }

    public function markAsPaid(CourseRegistration $courseRegistration)
    {
        $courseRegistration->paid = 1;
        $courseRegistration->save();
        return back()->with('success', 'Registration marked as paid!');
    }
}
