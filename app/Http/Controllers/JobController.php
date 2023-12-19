<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationSubmitted;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        // Fetch jobs from the database (you can customize this based on your needs)
        $jobs = Job::all();

        // Pass the jobs to the view
        return view('jobs.index', compact('jobs'));
    }
    public function create()
    {
        return view('jobs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'qualifications' => 'required',
            'salary' => 'required|numeric|min:0',
            'location' => 'required|max:255',
            'company_name' => 'required|max:255',
        ]);

        auth()->user()->userjobs()->create([
            'title' => $request->input('title'),
            // 'user_id' => auth()->user()->id,
            'description' => $request->input('description'),
            'qualifications' => $request->input('qualifications'),
            'salary' => $request->input('salary'),
            'location' => $request->input('location'),
            'company_name' => $request->input('company_name'),
        ]);

        // Associate the job with the currently authenticated user (employer)

        return redirect()->route('jobs.index');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }
    public function apply(Job $job)
    {
        return view('jobs.apply', compact('job'));
    }

    public function submitApplication(Job $job, Request $request)
    {

        // Validate the application form data
        $request->validate([
            'email' => 'required|email',
            'locations' => 'required',
            'phone' => 'required',
            'education_level' => 'required|in:SLC,+2,Under Graduate,Graduate,Diploma',
        ]);

        $applicationData = [
            'job_title' => $job->title,
            'email' => $request->input('email'),
            'locations' => $request->input('locations'),
            'phone' => $request->input('phone'),
            'education_level' => $request->input('education_level'),
            // Add other form fields to the $applicationData array
        ];


        
        //Send email notification
        Mail::to($request->input('email'))->send(new JobApplicationSubmitted($applicationData));

        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
    }
}
