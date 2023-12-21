@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Apply for Job: {{ $job->title }}</h1>

        <form action="{{ route('jobs.submitApplication', $job) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputLocation1">Location</label>
                <input type="text" name="location" class="form-control" id="exampleInputLocation1" placeholder="Enter Location">
            </div>

            <div class="form-group">
                <label for="examplePhoneCredentials1">Phone Credentials</label>
                <input type="text" name="phone" class="form-control" id="examplePhoneCredentials1" placeholder="Enter creds">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Level Of Education</label>
                <select class="form-control" id="exampleFormControlSelect1" name="education_level">
                    <option>SLC</option>
                    <option>+2</option>
                    <option>Under Graduate</option>
                    <option>Graduate</option>
                    <option>Diploma</option>
                </select>
            </div>
            <div class="form-group">
              <label for="cv">Attach CV</label>
              <input type="file" name="cv" class="form-control-file" id="cv">
          </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
@endsection
