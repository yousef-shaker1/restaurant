@extends('layout.master')

@section('title')
المنيو
@endsection

@section('content')
@if (session()->has('login'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('login') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<livewire:productsPaginate  /> 
@endsection

@section('js')

@endsection