@extends('layouts.config')

@section('page_title')
Step 1/2
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <h1 class="my-4">Step 2/3</h1>
        <h2>Database Config</h2>
        @if(session('success'))
            <div class="alert alert-danger" role="alert">
                <strong>Success! </strong>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Warning! </strong>{{ session('error') }}
            </div>
        @endif
        <form action="{{ url('config-db-check') }}">
            @csrf 
            <div class="form-group">
                <label for="dbName">Database</label>
                <input type="text" class="form-control" name="db_name" id="dbName">
            </div>
            <div class="form-group">
                <label for="dbHost">Host</label>
                <input type="text" class="form-control" name="db_host" id="dbHost" value="127.0.0.1">
            </div>
            <div class="form-group">
                <label for="dbUser">Username</label>
                <input type="text" class="form-control" name="db_user" id="dbUser" value="root">
            </div>
            <div class="form-group">
                <label for="dbPass">Password</label>
                <input type="text" class="form-control" name="db_password" id="dbPass" value="">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{url('/step-1')}}" class="btn btn-primary">Back</a>
                <input type="submit" class="btn btn-primary" value="Next">
            </div>
        </form>
    </div>
</div>
@endsection        