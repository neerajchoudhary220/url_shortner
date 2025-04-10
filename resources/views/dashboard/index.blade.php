@extends('layouts.master')
@section('contents')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i><span
                                    class="ml-2">Dashboard<span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        @include('includes.alert')
    </div>
    @if (auth()->user()->hasRole('SuperAdmin'))
        @include('dashboard.super_admin.company-table')
    @elseif(auth()->user()->hasRole('Admin'))
    <div class="row ">

        <div class="col-12 mb-3">
            @include('dashboard.admin.admin-generated-urls-list')
        </div>
        
        <div class="col-12 mb-3">
            @include('dashboard.admin.team-member')
        </div>
        
    </div>
    @endif
@endsection

