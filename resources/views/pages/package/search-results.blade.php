@extends('layouts.app')

@section('search')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{!! asset('assets/rev-slider-files/assets/banner.jpg') !!}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{{ count($packages) }} Deals are available</h1>
                <p>Packages designed with wide variety of hotels and transports</p>
            </div>
        </div>
    </section>
    <!-- End section -->
@endsection
@section('content')
    <div class="container margin_60">
        <div class="col-lg-12 col-sm-6">
            <!-- Search form -->
            {!! Form::open(['url'=>'/packages/search-packages','method'=>'GET']) !!}
            <div class="row">
                <div class="col-md-3 col-sm-4 p-lg-0">
                    <input class="form-control my-0 py-1 red-border" name="destination" type="text" placeholder="Enter Destination" aria-label="Search">
                </div>
                <div class="col-md-1 col-sm-4">
                    <button type="submit" class="btn btn-sm btn-success"><i class="icon-search"></i>Search</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row margin_30">
            <div class="col-lg-12">
                <div class="row">
                    @if(count($packages)>0)
                        @foreach($packages as $key => $package)
                        <div class="col-md-4 wow zoomIn" data-wow-delay="0.{{ ++$key }}s">
                        <div class="tour_container">
                            {{--<div class="ribbon_3 popular"><span>Popular</span>--}}
                            {{--</div>--}}
                            <div class="img_container">
                                <a href="{{ route('packages.show',$package->id) }}">
                                    <img src="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$package->path" }}" width="800" height="533" class="img-fluid" alt="Image">
                                    <div class="short_info">
                                        {{ $package->destination }}<span class="price"><sup>{{ $package->currency }}</sup> {{ $package->price }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3>
                                    @if($package->duration_day > 0)
                                    <strong>{{ $package->duration_day }}</strong> days,
                                    @endif
                                    @if($package->duration_night > 0)
                                    <strong>{{ $package->duration_night }}</strong> nights
                                    @endif
                                    <a class="btn-link float-right" href="{{ route('packages.show',$package->id) }}">Details</a>
                                </h3>
                            </div>
                        </div>
                        <!-- End box tour -->
                    </div>
                        @endforeach
                    <!-- End col-md-6 -->
                    @endif
                </div>
            </div>
            <!-- End col lg 9 -->
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
@endsection



