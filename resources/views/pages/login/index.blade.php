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
                        {!! Form::open(['url'=>'login','method'=>'post']) !!}
                            <div class="form-group">
                                <label>Email Address</label>
                                {!! Form::text('email','',['class'=>$errors->has('username')?'form-control is-invalid':'form-control','placeholder'=>'Email Address']) !!}
                            </div>
                            @isset($view)
                            <input type="hidden" name="view"  value="{{ $view }}" >
                            @endisset
                            <div class="form-group">
                                <label>Password</label>
                                {!! Form::password('password',['class'=>$errors->has('password')?'form-control is-invalid':'form-control','placeholder'=>'Password']) !!}
                            </div>

                            {!! Form::submit('Sign in',['class'=>'btn_full']) !!}
                            <a href="{{ route('sign-up.index') }} " class="btn_full_outline">Register</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



