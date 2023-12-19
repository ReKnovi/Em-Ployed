@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $job->title }}</h1>

        <div class="card">
            <div class="card-header">
                Job Details
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $job->description }}</p>
                <p><strong>Qualifications:</strong> {{ $job->qualifications }}</p>
                <p><strong>Salary:</strong> {{ $job->salary }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Company Name:</strong> {{ $job->company_name }}</p>
                <a href="{{ route('jobs.apply', $job) }}" class="btn btn-primary">Apply for this Job</a>
            </div>
        </div>
    </div>
@endsection
