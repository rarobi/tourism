@extends('layouts.app')
@section('header-css')
    {!! Html::style('assets/css/jquery-ui.css') !!}
@endsection
@section('search')
    <section id="search_container">
        <div id="search">
            <ul class="nav nav-tabs">
                <li><a href="#packages" data-toggle="tab" class="active show">Packages</a></li>
                <li><a href="#fly" data-toggle="tab">Fly</a></li>
                <li><a href="#hotels" data-toggle="tab">Hotels</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active show" id="packages">
                    {!! Form::open(['url'=>'/packages/search-packages','method'=>'GET']) !!}
                    <h3>Search Packages</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::text('destination','',['class'=>'form-control','placeholder'=>'Enter Destination','id'=>'destination']) !!}
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <!--<hr> -->
                    <button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button>
                    {!! Form::close() !!}
                </div>
                <!-- End rab -->
                <div class="tab-pane" id="fly">
                    <h3>Search Fly in Paris</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="select-label">Pick up location</label>
                                <select class="form-control">
                                    <option value="orly_airport">Orly airport</option>
                                    <option value="gar_du_nord">Gar du Nord Station</option>
                                    <option value="hotel_rivoli">Hotel Rivoli</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="select-label">Drop off location</label>
                                <select class="form-control">
                                    <option value="orly_airport">Orly airport</option>
                                    <option value="gar_du_nord">Gar du Nord Station</option>
                                    <option value="hotel_rivoli">Hotel Rivoli</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="icon-calendar-7"></i> Date</label>
                                <input class="date-pick form-control" data-date-format="M d, D" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class=" icon-clock"></i> Time</label>
                                <input class="time-pick form-control" value="12:00 AM" type="text">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="form-group">
                                <label>Adults</label>
                                <div class="numbers-row">
                                    <input type="text" value="1" id="flyAdults" class="qty2 form-control" name="quantity">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-9">
                            <div class="form-group">
                                <div class="radio_fix">
                                    <label class="radio-inline" style="padding-left:0">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> One Way
                                    </label>
                                </div>
                                <div class="radio_fix">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Return
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <hr>
                    <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                </div>
                <div class="tab-pane" id="hotels">
                    {!! Form::open(['url'=>'/hotels/search','method'=>'PATCH']) !!}
                    <h3>Search Hotel</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Destination</label><br/>
                                        {!! Form::text('hotel_destination_name','',['class'=>'form-control','placeholder'=>'Destination','id'=>'hotel_destination_name','required']) !!}
                                        {!! Form::hidden('destination_id','',['id'=>'hotel_destination_id']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check in</label>
                                    <input id="hotel_check_in_date" name="check_in_date" placeholder="yyyy-mm-dd" required class="form-control" autocomplete="off" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check out</label>
                                    <input id="hotel_check_out_date" name="check_out_date"placeholder="yyyy-mm-dd"  required class="form-control" autocomplete="off" type="text">
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 parentDiv">
                            <div class="row border mt-2 cloneDiv">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <div class="numbers-row">
                                            {!! Form::text("rooms[0][adults]",1,['class'=>'qty2 form-control','id'=>'adults']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Children</label>
                                        <div class="numbers-row childrenQuantity">
                                            {!! Form::text("rooms[0][children]",1,['class'=>'qty2 form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <label class="addRoom btn btn-block btn-primary btn-sm mt-4">Add Room</label>
                                </div>
                                <div class="col-8 offset-4 childrenAgeParentDiv">
                                    <div class="form-group childrenAgeCloneDiv">
                                        {!! Form::select("rooms[0][children_ages][]",$childrenAges,'',['class'=>'form-control','placeholder'=>'Age of child','required']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container margin_60">

        <div class="main_title">
            <h2><span>Popular</span> Packages</h2>
        </div>

        <div class="row">
            @if(count($featuredPackages)>0)
                @foreach($featuredPackages as $key => $package)
                    <div class="col-md-4 wow zoomIn" data-wow-delay="0.{{ ++$key }}s">
                        <div class="tour_container">
                            <div class="ribbon_3 popular"><span>Popular</span>
                            </div>
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
        </div><!-- End row -->

        <p class="text-center nopadding">
            <a href="{{ route('packages.index') }}" class="btn_1 medium"><i class="icon-eye-7"></i>View all packages</a>
        </p>

        <div class="main_title margin_30">
            <h2><span>Popular</span> Destination</h2>
        </div>

        <div class="row">
            @if(count($countryList)>0)
                @foreach($countryList as $key => $singleCountry)
                    <div class="col-md-4 wow zoomIn" data-wow-delay="0.{{ ++$key }}s">
                        <div class="tour_container">
                            <div class="img_container">
                                <a href="{{ url("/packages/search-packages?destination=".$singleCountry->country) }}">
                                    <img src="{{ env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$singleCountry->feature_image_path" }}" width="800" height="533" class="img-fluid" alt="Image">
                                    <div style="font-size:25px;" class="short_info">
                                        {{ strtoupper($singleCountry->country) }}<span style="font-size:15px;" class="float-right">{{ $singleCountry->package_count }} packages</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End box tour -->
                    </div>
                @endforeach
            <!-- End col-md-6 -->
            @endif
        </div><!-- End row -->

    </div>
@endsection
@section('footer-script')
    <!-- SLIDER REVOLUTION SCRIPTS  -->
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/jquery.themepunch.tools.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/jquery.themepunch.revolution.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.actions.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.carousel.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.kenburn.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.migration.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.navigation.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.parallax.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.slideanims.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/rev-slider-files/js/extensions/revolution.extension.video.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/js/jquery-ui.js') !!}"></script>
    <script type="text/javascript">
        $(function() {
            //Destination search by keyword through ajax start
            $( "#hotel_destination_name" ).autocomplete({
                minLength: 3,
                source: function(request, response) {
                    $.ajax({
                        url: "{{route('hotel.destination-ajax-search')}}",
                        data: {
                            destination : request.term
                        },
                        dataType: "json",
                        success: function(e){
                            let destinations = e.data;
                            response(destinations);
                        }
                    })},

                focus: function( event, ui ) {
                    $( "#hotel_destination_name" ).val( ui.item.value );
                    return false;
                },
                select: function( event, ui ) {
                    console.dir(ui);
                    $( "#hotel_destination_name" ).val( ui.item.value );
                    $( "#hotel_destination_id" ).val( ui.item.key );

                    return false;
                }
            });
            //Destination search by keyword through ajax end

        });
    </script>
    <script type="text/javascript">
        var tpj=jQuery;
        var revapi13;
        tpj(document).ready(function() {
            if(tpj("#rev_slider_13_1").revolution == undefined){
                revslider_showDoubleJqueryError("#rev_slider_13_1");
            }else{
                revapi13 = tpj("#rev_slider_13_1").show().revolution({
                    sliderType:"carousel",
                    jsFileLocation: "rev-slider-files/js/",
                    sliderLayout:"fullwidth",
                    dottedOverlay:"none",
                    delay:9000,
                    navigation: {
                        keyboardNavigation:"off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation:"off",
                        mouseScrollReverse:"default",
                        onHoverStop:"off",
                        touch:{
                            touchenabled:"on",
                            touchOnDesktop:"off",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        }
                        ,
                        bullets: {
                            enable:true,
                            hide_onmobile:false,
                            style:"hermes",
                            hide_onleave:false,
                            direction:"horizontal",
                            h_align:"center",
                            v_align:"bottom",
                            h_offset:0,
                            v_offset:20,
                            space:5,
                            tmp:''
                        }
                    },
                    carousel: {
                        horizontal_align: "center",
                        vertical_align: "center",
                        fadeout: "on",
                        vary_fade: "on",
                        maxVisibleItems: 3,
                        infinity: "on",
                        space: 0,
                        stretch: "off",
                        showLayersAllTime: "off",
                        easing: "Power3.easeInOut",
                        speed: "800"
                    },
                    responsiveLevels:[1240,1024,778,778],
                    visibilityLevels:[1240,1024,778,778],
                    gridwidth:[800,640,480,480],
                    gridheight:[720,720,480,360],
                    lazyType:"none",
                    parallax: {
                        type:"scroll",
                        origo:"enterpoint",
                        speed:400,
                        levels:[5,10,15,20,25,30,35,40,45,50,47,48,49,50,51,55],
                    },
                    shadow:0,
                    spinner:"off",
                    stopLoop:"on",
                    stopAfterLoops:0,
                    stopAtSlide:1,
                    shuffle:"off",
                    autoHeight:"off",
                    disableProgressBar:"on",
                    hideThumbsOnMobile:"off",
                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    debugMode:false,
                    fallbacks: {
                        simplifyAll:"off",
                        nextSlideOnWindowFocus:"off",
                        disableFocusListener:false,
                    }
                });
            }
        });	/*ready*/

        $(document).ready(function () {

            // Add and Remove Room Start
            $('.addRoom').click(function () {
                let cloneDiv = $('.cloneDiv').eq(0).clone();
                let cloneDivIndex = $('.cloneDiv').length;
                cloneDiv.find('.addRoom').removeClass('addRoom btn-primary')
                    .addClass('removeRoom btn-danger')
                    .html('Remove Room');

                cloneDiv.find('input').each(function(i,input){
                    input.name = input.name.replace('rooms[0]', 'rooms[' + cloneDivIndex + ']');
                    if(i==1){
                        $(input).val(0);
                        cloneDiv.find('select').parent().remove();
                    }else{
                        $(input).val(1);
                    }

                });

                $('.parentDiv').append(cloneDiv);
            });

            $(document.body).on('click','.removeRoom',function(ev){
                $(this).parent().parent().remove();
            });
            // Add and Remove Room End

            //Increment decrement Value Change Start
            $(document.body).on('click','.inc',function(ev){
                let index = $(this).parent().find('input').attr('name').charAt(6);
                let currentValue = $(this).parent().find('.qty2').val();
                currentValue++;
                if(index == 0){
                    // let total = $(this).parent().parent().parent().parent().find('select').length;
                    currentValue = (currentValue-1);
                }
                $(this).parent().find('.qty2').val(currentValue);
            });

            $(document.body).on('click','.dec',function(ev){
                let index = $(this).parent().find('input').attr('name').charAt(6);
                let currentValue = $(this).parent().find('.qty2').val();
                currentValue--;
                if(index == 0){
                    // let total = $(this).parent().parent().parent().parent().find('select').length;
                    currentValue = (currentValue+1);
                }
                if(currentValue<0){
                    currentValue = 0;
                }
                $(this).parent().find('.qty2').val(currentValue);
            });
            //Increment decrement Value Change End

            //Children Quantity Increment/Decrement Child age select box start
            $(document.body).on('click','.childrenQuantity',function(ev){
                let qty = $(this).find('input').val();
                let childrenAgeCloneDiv = $(this).parent().parent().parent().find('.childrenAgeCloneDiv').eq(0).clone();
                let childrenAgeCloneDivIndex = $(this).parent().parent().parent().find('.childrenAgeCloneDiv').length;
                let childrenAgeParentDiv = $(this).parent().parent().parent().find('.childrenAgeParentDiv');

                if(childrenAgeCloneDivIndex<1){
                    let index = $(this).find('input').attr('name').charAt(6);
                    childrenAgeCloneDiv = '<div class="form-group childrenAgeCloneDiv">'+
                        '<select required class="form-control" name="rooms['+index+'][children_ages][]">'+
                        '<option selected="selected" value="">Age of child</option>'+
                        '<option value="1">1 Year Age</option>'+
                        '<option value="2">2 Year Age</option>'+
                        '<option value="3">3 Year Age</option>'+
                        '<option value="4">4 Year Age</option>'+
                        '<option value="5">5 Year Age</option>'+
                        '<option value="6">6 Year Age</option>'+
                        '<option value="7">7 Year Age</option>'+
                        '<option value="8">8 Year Age</option>'+
                        '<option value="9">9 Year Age</option>'+
                        '<option value="10">10 Year Age</option>'+
                        '<option value="11">11 Year Age</option>'+
                        '<option value="12">12 Year Age</option>'+
                        '<option value="13">13 Year Age</option>'+
                        '<option value="14">14 Year Age</option>'+
                        '</select>'+
                        '</div>';
                }

                if(qty>0){
                    if(qty>childrenAgeCloneDivIndex){
                        childrenAgeParentDiv.append(childrenAgeCloneDiv);
                    }else{
                        $(this).parent().parent().parent().find('.childrenAgeCloneDiv').eq(0).remove();
                    }
                }else{
                    $(this).parent().parent().parent().find('.childrenAgeCloneDiv').remove();
                }
            });
            //Children Quantity Increment/Decrement Child age select box start

            var date = new Date();
            var currentMonth = date.getMonth();
            var currentDate = date.getDate();
            var currentYear = date.getFullYear();

            $( "#hotel_check_in_date, #hotel_check_out_date" ).datepicker({
//                minDate: new Date(currentYear, currentMonth, currentDate),
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
            });

            //Change date range
            $('#hotel_check_in_date').change(function() {
                var startDate = $('#hotel_check_in_date').val();
                let date = new Date(startDate);
                date.setDate(date.getDate() + (+1));

                var dd = date.getDate();
                if(dd < 10){
                    dd = '0' + dd;
                }
                var mm = date.getMonth() + 1;
                if(mm < 10){
                    mm = '0' + mm;
                }
                let y = date.getFullYear();
                let someFormattedDate = y + '-' + mm + '-' + dd;

                $('#hotel_check_out_date').val(someFormattedDate);
            });
        });

        $(document).ready(function(e) {
            if(!!window.performance && window.performance.navigation.type == 2)
            {
                window.location.reload(true);
            }
        });

    </script>
@endsection


