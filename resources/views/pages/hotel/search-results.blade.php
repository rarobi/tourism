@extends('layouts.app')

@section('content')
    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-12">
                <h3>Hotel search results @if(isset($destinationName))for <strong>{{ $destinationName }}</strong> @endif from {{ $CheckInDate }} to {{ $CheckOutDate }}</h3></br>
            </div>
            @foreach($hotels as $hotel)
                @if(!isset($hotel->HotelCode))
                    {{ $hotel }}
                @endif
                <div class="col-lg-12">
                <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 my-auto">
                            <div class="img_list">
                                <a href="{{ route('hotel.details',\App\Libraries\Encryption::encodeId($hotel->HotelCode)) }}"><img width="100%" src="{{ isset($hotel->Images[0])?$hotel->Images[0]:'#' }}" alt="Image">
                                    <div class="short_info"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="tour_list_desc">
                                <div class="rating">
                                    @for($i=1; $i<=$hotel->StarRating; $i++)
                                    <i class="icon-star voted"></i>
                                    @endfor
                                    @for($i=1; $i<=(5-(int)$hotel->StarRating); $i++)
                                    <i class="icon-star-empty"></i>
                                    @endfor
                                </div>
                                <p><i class="icon-map"></i> {{ $hotel->Location }}</p>
                                <h3><strong>{{ $hotel->HotelName }}</strong> Hotel</h3>
                                <p>{!! $hotel->Description !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 my-auto">
                            <div class="price_list">
                                <div>
                                    <h5 class="text text-danger">{{ $hotel->Currency }} {{ $hotel->MinPrice }}*</h5>
                                    <small>*Starting from</small>
                                    <p><a href="{{ route('hotel.details',\App\Libraries\Encryption::encodeId($hotel->HotelCode)) }}" class="btn_1">Details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End strip -->
            </div>
            @endforeach

        </div>
        <!-- End row -->
    </div>
@endsection



