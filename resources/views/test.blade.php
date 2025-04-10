@extends('layouts.master')
@section('contents')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Tasks</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i><span
                                    class="ml-2">Dashboard<span></a></li>
                        <li class="breadcrumb-item active"><i class="feather icon-list"></i><span
                                class="ml-2">Saving<span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    </div>

@endsection

@push('custom-js')
    <script src="{{ asset('assets/js/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>

   
@endpush
