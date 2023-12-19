<!-- resources/views/jobs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Job Listing</h1>

        @foreach ($jobs as $job)
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
