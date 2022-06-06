@extends('layouts.app')
@section('title','Tambah Toko Baru')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Toko</h6>
    </div>
    <div class="card-body">
        @include('validation_error')
        {!! Form::open(['url'=>'toko','files'=>true]) !!}
        @include('toko.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection


