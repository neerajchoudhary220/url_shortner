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
                        <li class="breadcrumb-item active"><i class="feather icon-list"></i><span class="ml-2">Generate
                                Short URL<span></li>
                    </ul>
                </div>
            </div>
        </div>

        @include('includes.alert')

    </div>
    <div class="card">
        <div class="card-header">
            Generate Short URL
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('shortUrl.generate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label required" for="original_url">Long URL</label>
                                    <input type="text" name="original_url" class="form-control"
                                        value="{{ old('original_url') }}">
                                    @error('original_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 text-right">
                                <button class="btn btn-info" type="submit">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    </div>
@endsection
