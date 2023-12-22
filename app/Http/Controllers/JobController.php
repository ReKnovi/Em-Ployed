<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationStatusUpdated;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class JobController extends Controller
{
    public function index(request $request)
    {
        $jobs = Job::all();
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
        $request->validate([
            'email' => 'required|email',
            'location' => 'required',
            'phone' => 'required',
            'education_level' => 'required|in:SLC,+2,Under Graduate,Graduate,Diploma',
            'cv' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv', 'public');
        } else {
            return redirect()->back()->with('error', 'Please attach a CV file.');
        }

        //create JobApplication instance
        $application = new JobApplication([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'email' => $request->input('email'),
            'location' => $request->input('location'),
            'phone' => $request->input('phone'),
            'education_level' => $request->input('education_level'),
            'cv' => $cvPath,

        ]);

        $application->save();
        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
    }

    public function viewApplicants(Job $job)
    {
        $applications = $job->applications;

        return view('jobs.applications.index', compact('applications', 'job'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $jobs = Job::whereHas('applications', function($query) use ($search) {
            $query->where('company_name', 'LIKE', '%' . $search . '%');
        })->get();
        
        return view('jobs.index', compact('jobs'));

    }
    // public function updateApplicationStatus(Job $job, JobApplication $application)
    // {
    //     // You can add additional validation if needed
    //     request()->validate([
    //         'status' => 'required|in:first_interview,hired,rejected',
    //     ]);

    //     // Get the previous status before the update
    //     $previousStatus = $application->status;

    //     // Update the application status
    //     $application->update(['status' => request('status')]);

    //     // Send email notification
    //     Mail::to($application->email)->send(new ApplicationStatusUpdated($application, $previousStatus));

    //     return Redirect::back()->with('success', 'Application status updated successfully!');
    // }
}
