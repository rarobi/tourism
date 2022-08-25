@extends('layouts.app')
@section('content')
    <div class="container margin_60">
        <div class="col-lg-12 col-sm-6">
            @if ($code == 200)
                <div class="alert alert-success text-center">
                    <h5 style="text-align:center;">Your registration is successful. You can now login with your credentials</h5>
                </div>
            @else
                <div class="alert alert-danger">
                    <h5 style="text-align:center;">Sorry !Invalid verification code</h5>
                </div>
                
            @endif
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
@endsection