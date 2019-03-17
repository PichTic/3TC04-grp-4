@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @include('dashboard.partials.quesAndAnswForm')
                    @include('dashboard.partials.incomingQuestions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageJS')

@endsection
