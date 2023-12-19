@extends('layouts.app',[
  'namePage' => 'Dashboard',
  'class' => 'login-page sidebar-mini ',
  'activePage' => 'home',
  'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
<div class="panel-header panel-header-lg">
  <canvas id="bigDashboardChart"></canvas>
</div>
<div class="content">
  <div class="card-header">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Create a Job</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('jobs.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="qualifications">Qualifications:</label>
                <input type="text" name="qualifications" id="qualifications" class="form-control" value="{{ old('qualifications') }}" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') }}" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Job</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
