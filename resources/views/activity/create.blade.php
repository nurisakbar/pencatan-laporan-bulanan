@extends('layouts.app')
@section('title','Add New Activity')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add New Activity</div>

                <div class="card-body">
                    @include('validation_error')
                    {!! Form::open(['url'=>'activity','files'=>true]) !!}
                    @include('activity.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






