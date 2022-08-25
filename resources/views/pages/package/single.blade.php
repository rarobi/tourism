@extends('layouts.app')

@section('content')
    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-8" id="single_tour_desc">
                <div id="Img_carousel" class="slider-pro">
                    @if(isset($package->media) && count($package->media)>0)
                        <div class="sp-slides">
                            @foreach($package->media as $media)
                                <div class="sp-slide">
                                    <img style="margin-top: 0 !important; width: 100% !important; height: 100% !important;" src="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}" data-src="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}" data-small="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}" data-medium="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}" data-large="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}" data-retina="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="sp-thumbnails">
                            @foreach($package->media as $media)
                                <img alt="Image" class="sp-thumbnail" src="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$media->path" }}">
                            @endforeach
                        </div>
                    @endif
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Summary</h3>
                    </div>
                    <div class="col-lg-9">
                        {!! $package->summary !!}
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Valid From</strong><br> {{ \Carbon\Carbon::parse($package->vaidFrom)->format(' d F, Y') }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Valid Till</strong><br> {{ \Carbon\Carbon::parse($package->validTo)->format('d F, Y') }}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Minimum People</strong><br> {{ $package->minimum_number_people }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Duration</strong><br>
                                @if($package->duration_day > 0) {{ $package->duration_day }} days @endif
                                @if($package->duration_night > 0) {{ $package->duration_night }} nights @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Description</h3>
                    </div>
                    <div class="col-lg-9">
                        <p>{{ $package->description }}</p>
                        <!-- End row  -->
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Hotels</h3>
                    </div>
                    <div class="col-lg-9">
                        @foreach($packageTypeDetails as $tourType => $packageType)

                            <h6>{{ ucfirst(strtolower($tourType)) }}</h6>
                            <div class="row mb-4">
                                <div class="col-md-6 offset-1 hotel-box">
                                    <div class="row">
                                        @foreach($packageType as $singlePackageType)
                                        <div class="col-sm-4">
                                            <br>
                                            <p>
                                                <strong>{{ $singlePackageType['hotel_name'] }}</strong><br>
                                                @if($tourType == 'LUXURY')
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                @elseif($tourType == 'STANDARD')
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star-empty"></i>
                                                    <i class="icon-star-empty"></i>
                                                @else
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star voted"></i>
                                                    <i class="icon-star-empty"></i>
                                                @endif
                                            </p>
                                            <p>
                                                <strong>Location</strong><br> {{ $singlePackageType['location'] }}
                                            </p>
                                            <p>
                                                <strong>Duration</strong><br> {{ $singlePackageType['duration'] }} Nights
                                            </p>
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                    @endforeach

                    <!-- End row  -->
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Trip Details</h3><br><span>Detail Itinerary</span>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            {!! $package->itinerary !!}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Inclusion </h3>
                    </div>
                    <div class="col-lg-9">
                        {!! $package->inclusions !!}
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Exclusion </h3>
                    </div>
                    <div class="col-lg-9">
                        {!! $package->exclusions !!}
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Terms & Conditions</h3>
                    </div>
                    <div class="col-lg-9">
                        {!! $package->terms_conditions !!}
                    </div>
                </div>
            </div>
            <!--End  single_tour_desc-->

            <aside class="col-lg-4" id="sidebar">
                <div class="theiaStickySidebar">
                    <div class="box_style_1 expose" id="booking_box">
                        <div class="row">
                            <div class="col-sm-7"><h6><strong>Price</strong></h6></div>
                            <div class="col-sm-5"><h6><strong>BDT <span id="price">{{ min(array_keys($packageTypes)) }}</span></strong></h6></div>
                        </div>
                        <hr>
                        <div class="row book-box">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Dates</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input class="date-pick form-control start_date" data-date-format="yyyy-mm-dd" type="text">

                                        </div>
                                        <div class="col-sm-6">
                                            <input class="date-pick form-control end_date" data-date-format="yyyy-mm-dd" type="text">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row book-box">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tour Type</label>
                                    {!! Form::select('tour_type',$packageTypes,'',['class'=>$errors->has('tour_type')?'form-control is-invalid':'form-control','placeholder'=>'Select Tour Type', 'id'=>'tourType', 'required' => true]) !!}
                                </div>
                            </div>
                        </div><br>
                        {{--                        <a class="btn_full" href="{{ route('booking.index', ['packageId' => $package->id , 'price' => '40050']) }}">Book now</a>--}}
                        <a class="btn_full" id="book_btn" href="{{ route('booking.index') }}">Book now</a>
                        <span class="errorMessage text-danger text-center text-bold"></span>
                    </div>
                    <!--/box_style_1 -->
                </div>
                <p>*The prices may be lowered for larger group. Please contact us for details</p>
                <!--/sticky -->

            </aside>
        </div>
        <!--End row -->
    </div>
    <!--End container -->

    {{--<div id="overlay"></div>--}}
    <!-- Mask on input focus -->
@endsection
@section('footer-script')
    {!! Html::script('assets/js/jquery.sliderPro.min.js') !!}
    <script type="text/javascript">
        $('#tourType').change(function(){
            let packageId =  "{{ $package->id }}";
            let tourType  = this.options[this.selectedIndex].text;
            let tourPrice =  $('#tourType').val();
            let startDate = $('.start_date').val();
            let endDate   = $('.end_date').val();
            let featuredImage = "{!! $featuredImage !!}";

            $.ajax({
                type: "GET",
                url: "{{ url('/packages/set-session') }}",
                data: {
                    package_id: packageId,
                    tour_price: tourPrice,
                    tour_type: tourType,
                    start_date: startDate,
                    end_date: endDate,
                    featured_image: featuredImage
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });

        $('#tourType').trigger('change');

        $(document).ready(function ($) {
            $('#Img_carousel').sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: false,
                smallSize: 500,
                startSlide: 0,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });

            var duration = "{{ $package->duration_day }}";
            var startDate = $('.start_date').val();
            var date = new Date(startDate);
            date.setDate(date.getDate() + (+duration));

            var dd = date.getDate();
            if(dd < 10){
                dd = '0' + dd;
            }
            var mm = date.getMonth() + 1;
            if(mm < 10){
                mm = '0' + mm;
            }
            var y = date.getFullYear();
            var someFormattedDate = y + '-' + mm + '-' + dd;

            $('.end_date').val(someFormattedDate);

        });

        $('#tourType').change(function(){
            var tourPrice =   $("#tourType").val();
            $('#price').html(tourPrice);

        });

        $('.start_date').change(function() {
            var duration = "{{ $package->duration_day }}";
            var startDate = $('.start_date').val();
            var date = new Date(startDate);
            date.setDate(date.getDate() + (+duration));

            var dd = date.getDate();
            if(dd < 10){
                dd = '0' + dd;
            }
            var mm = date.getMonth() + 1;
            if(mm < 10){
                mm = '0' + mm;
            }
            var y = date.getFullYear();
            var someFormattedDate = y + '-' + mm + '-' + dd;

            $('.end_date').val(someFormattedDate);
        });

        $( "#book_btn" ).click(function(event) {
            var tourType = $("#tourType").val();
            if(tourType == ''){
                event.preventDefault();
                $('.errorMessage').html('Please select a tour type option');
            }
        });

        $(document).ready(function(e) {
            if(!!window.performance && window.performance.navigation.type == 2)
                {
                    window.location.reload(true);
                }
        });
    </script>
@endsection



