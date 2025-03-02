@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Add more profile fields as needed -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
