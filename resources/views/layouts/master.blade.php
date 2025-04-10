@extends('layouts.base')
@section('master')
@include('includes.sidebar')
@include('includes.header')

<div class="pcoded-main-container">
<div class="pcoded-content">
    @yield('contents')
</div>
</div>
@endsection