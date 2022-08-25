@extends('layouts.app')
@section('content')
    <div class="container margin_60">
        <div class="col-lg-12 col-sm-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('flash_success'))
                <div class="alert alert-success text-center">
                    <h5>{{ session('flash_success') }}</h5>
                </div>
            @else
                <h3 class="text-center"> Sorry!</h3>
            @endif
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
@endsection



