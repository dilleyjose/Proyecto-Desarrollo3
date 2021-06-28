@extends('layouts.app')

@section('content')

    <!-- <invoices-component/> -->      

    <invoice-select-client
    	:user="{{ auth()->user() }}"
    />
@endsection