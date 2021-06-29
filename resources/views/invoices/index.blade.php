@extends('layouts.app')

@section('content')

    <invoices-component
    	:user="{{ auth()->user() }}"
    />      


@endsection