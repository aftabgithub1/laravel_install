@extends('layouts.config')

@section('page_title')
Step 1/2
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <h1 class="mb-5">Step 2/4</h1>
        <h2>Pre-Installation</h2>
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
        <form action="{{ url('gsrefghdf') }}">
            {{ config('package') }}
            
        </form>
    </div>
</div>
@endsection        