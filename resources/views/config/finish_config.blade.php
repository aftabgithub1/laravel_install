@extends('layouts.config')

@section('page_title')
Step 2/2
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <h1 class="mb-5">Step 2/2</h1>
        <h2>Configuration Complete!</h2>
        <h4>Database Name: {{ env('DB_DATABASE') }}</h4>
        <form action="{{ url('config-finish') }}">
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-primary ml-auto">Go to website</button>
            </div>
        </form>
    </div>
</div>
@endsection