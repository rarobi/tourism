@extends('layouts.app')

@section('content')
    <section id="hero" class="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                    <div id="login">
                        <div class="text-center"><img src="/assets/img/logo.png" width="160" alt="Image" data-retina="true" ></div>
                        <hr>
                        @include('includes.partials.messages')
                        {!! Form::open(['url'=>'sign-up','method'=>'post']) !!}
                            <div class="form-group">
                                <label>First Name</label>
                                {!! Form::text('first_name','',['class'=>$errors->has('email')?'form-control is-invalid':'form-control','placeholder'=>'First Name']) !!}
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                {!! Form::text('last_name','',['class'=>$errors->has('email')?'form-control is-invalid':'form-control','placeholder'=>'Last Name']) !!}
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                {!! Form::email('email','',['class'=>$errors->has('email')?'form-control is-invalid':'form-control','placeholder'=>'Email Address']) !!}
                            </div>
                            {!! Form::label('mobile_number','Mobile') !!}
                            <div class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" style="line-height: 0">+88</span>
                                </div>
                                {!! Form::text('mobile_number','',['class'=>$errors->has('mobile_number')?'form-control is-invalid':'form-control','placeholder'=>'Mobile number']) !!}
                            </div>
                            <div class="form-group mt-3">
                                <label>Password</label>
                                {!! Form::password('password',['class'=>$errors->has('password')?'form-control is-invalid':'form-control','placeholder'=>'Password','id'=>'password1']) !!}
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                {!! Form::password('confirm_password',['class'=>$errors->has('confirm_password')?'form-control is-invalid':'form-control','placeholder'=>'Confirm password','id'=>'password2']) !!}
                            </div>
                            <div id="pass-info" class="clearfix"></div>
                            <button class="btn_full">Create an account</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



