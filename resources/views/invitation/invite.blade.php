@extends('layouts.master')
@section('contents')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Companies</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i><span
                                    class="ml-2">Dashboard<span></a></li>
                        <li class="breadcrumb-item active"><i class="feather icon-list"></i><span
                                class="ml-2">Invitation<span></li>
                    </ul>
                </div>
            </div>
        </div>
        
                @include('includes.alert')

    </div>
    <div class="card">
        <div class="card-header">
           {{ ($company)?"Invitation in ".$company->name:"Invitation" }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('invite.store') }}" method="post" id="invitation-modal-form">
                        @csrf
                
                        <div class="row">
                            <div @class(['col-4'=>auth()->user()->hasRole('Admin'),'col-6','mb-3'])>
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div @class(['col-4'=>auth()->user()->hasRole('Admin'),'col-6','mb-3'])>
                                <div class="form-group">
                                    <label class="form-label" for="invite-email">Email</label>
                                    <input type="email" name="email" id="invite-email"
                                        class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            @if(auth()->user()->hasRole('Admin'))
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="invite-role">Select Role:</label>
                                    <select class="form-input" name="role">
                                        <option>A</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                
                            @if(auth()->user()->hasRole('SuperAdmin'))
                            <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">
                            @endif
                
                            <div class="col-12 text-right">
                                <button class="btn btn-info" id="task_complete_submit_btn" type="submit"><i
                                        class="feather icon-mail mr-2"></i>Send Invitation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
   

    </div>
    
@endsection

@push('custom-js')

@endpush
