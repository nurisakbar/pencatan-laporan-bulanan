@extends('layouts.app')
@section('title','Edit Toko')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Toko</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::model($toko,['url'=>'toko/'.$toko->id,'method'=>'PUT']) !!}
        @include('toko.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
