<!-- resources/views/jobs/applications/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Applicants for Job: {{ $job->title }}</h1>

        @if ($applications)
            @foreach ($applications as $application)
                <div class="card mb-3">
                    <div class="card-header">
                        {{ $application->user->name }}
                    </div>
                    <div class="card-body">
                        <p>Email: {{ $application->email }}</p>
                        <p>Location: {{ $application->location }}</p>
                        <p>Phone: {{ $application->phone }}</p>
                        <p>Education Level: {{ $application->education_level }}</p>
                        @if ($application->cv)
                            <p><a href="{{ asset('storage/' . $application->cv) }}" target="_blank">View CV</a></p>
                        @endif
                        <form action="{{ route('jobs.updateApplicationStatus', ['job' => $job, 'application' => $application]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status">Application Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="first_interview" {{ $application->status === 'first_interview' ? 'selected' : '' }}>First Interview</option>
                                    <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>No applicants found for this job.</p>
        @endif
    </div>
@endsection
