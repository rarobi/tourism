@extends('layouts.app')
@section('search')
    <section id="hero_2">
        <div class="intro_title">
            <h1>COMPLETE YOUR BOOKING</h1>
            <!-- End bs-wizard -->
        </div>
        <!-- End intro-title -->
    </section>
@endsection
@section('content')
    <div class="container margin_60">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div id="root">
            <div class="app flex-row align-items-center">
                <main class="main">
                    <div class="profile">
                        <div class="container">
                            {!! Form::open(['url'=>'packages/book','method'=>'post']) !!}
                            <div class="row justify-content-between">
                                <div class="col-md-7 col-sm-12">
                                    <h3>Booking Details</h3>
                                    <p>Please fill up the below forms carefully to book your tour successfully</p>
                                    <hr>
                                    <div class="only_me">
                                        <input type="checkbox" id="book_for_me" name="book_for_me"> This booking is for me
                                    </div>
                                    <hr>
                                    <div class="form-group request-box">
                                        <label class="form-label">Traveler Name</label>
                                        <input type="text" placeholder="Traveler Name" name="userName" class="form-control travelerName" value="" required>
                                        <input type="hidden" name="packageId"  value="{{ $package->id }}" >
                                        <input type="hidden" name="price" class="selectPackagePrice" value="{!! \Illuminate\Support\Facades\Session::get('package.tour_price') !!}" >
                                        <input type="hidden" name="discount"  id="book_discount" value="">
                                        <input type="hidden" name="tour_type"  id="tour_type" value="">
                                    </div>
                                    <div class="form-group request-box">
                                        <label class="form-label">Tour Type</label>
                                        {!! Form::select('tourType',$packageTypes, ( \Illuminate\Support\Facades\Session::get('package.tour_price') ),['class'=>$errors->has('tourType')?'form-control is-invalid':'form-control','placeholder'=>'Select Tour Type', 'id'=>'tourType', 'required' => 'required']) !!}
                                    </div>
                                    <div class="form-group request-box">
                                        <label class="form-label">Travel Dates</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="react-datepicker-wrapper1">
                                                    <div class="react-datepicker__input-container1">
                                                        {{--<input name="travelDate" type="text" class="form-control input-date" placeholder="03/04/2020">--}}
                                                        <input name="travelDate" class="date-pick1 travel-date form-control start_date" value="{!! $startDate !!}" type="text" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="react-datepicker-wrapper">
                                                    <div class="react-datepicker__input-container">
                                                        {{--<input name="" type="text" class="form-control input-date" placeholder="03/08/2020">--}}
                                                        <input name="" class="date-pick1 travel-date form-control end_date" value="{!! $endDate !!}" type="text" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group request-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label">Room Type</label>
                                                <select name="type" data-id="0" id="roomType-0" class="roomType" required style="padding: 10px 12px; border-radius: 3px; resize: none; border: 1px solid rgb(219, 219, 219); color: rgb(38, 38, 38); display: block; width: 100%; line-height: 1.5; background: rgb(255, 255, 255) url(&quot;/static/media/dropdown_arrow.4dbee097.svg&quot;) no-repeat scroll 97% center / 12px; font-weight: 300; -moz-appearance: none;">
                                                    <option value="">Select Room Type</option>
                                                    <option value="SINGLE">SINGLE</option>
                                                    <option value="COUPLE">COUPLE</option>
                                                    <option value="TWINE">TWIN</option>
                                                    <option value="TRIPLE">TRIPLE</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Room Count</label>
                                                <input type="number" name="count" placeholder="Room Count" class="form-control totalRoom" required style="padding: 10px 12px; border-radius: 3px; resize: none; border: 1px solid rgb(219, 219, 219); color: rgb(38, 38, 38); display: block; width: 100%; line-height: 1.5; background-color: rgb(255, 255, 255); background-clip: padding-box; font-weight: 300;" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group request-box">
                                        <label class="form-label">Number of Travelers</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <p>Total Travelers</p>
                                                <input name="peopleCount" type="number" placeholder="Travelers" class="form-control traveler" required>
                                                <span class="countError text-danger" ></span>
                                            </div>
                                            <div class="col-4">
                                                <p>Children With Bed</p>
                                                <input name="children_count_bed" type="number" placeholder="Children with bed" class="form-control withChild" >
                                                <span class="childCountError text-danger" ></span>
                                            </div>
                                            <div class="col-4">
                                                <p>Children Without Bed</p>
                                                <input name="children_count_no_bed" type="number" placeholder="Children without bed" class="form-control withoutChild" >
                                                <span class="noChildCountError text-danger" ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group request-box">
                                        <label class="form-label">Email</label>
                                        <input type="email" placeholder="Enter Email" name="email" class="form-control email" required>
                                    </div>
                                    <div class="form-group request-box">
                                        <label class="form-label">Mobile No. (Enter your mobile no. with country code. Example: 8801943335555)</label>
                                        <div class="">
                                            <input minlength="13" maxlength="13" type="text" placeholder="8801XXXXXXXXX" name="mobileNumber" value="" class="form-control mobile" required>
                                        </div>
                                    </div>
                                    <label class="form-label">Payment mode</label>
                                    <div class="payment-mode">
                                        <label class="label">
                                            <input type="radio" name="paymentMode" value="CARD" required>
                                            <div class="label-box">
                                                <img src="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMqaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjUtYzAxNCA3OS4xNTE0ODEsIDIwMTMvMDMvMTMtMTI6MDk6MTUgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUY5NTY3NTM1ODk5MTFFOUFCNTVCRjFGRjAzOUI1NDMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUY5NTY3NTQ1ODk5MTFFOUFCNTVCRjFGRjAzOUI1NDMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBRjk1Njc1MTU4OTkxMUU5QUI1NUJGMUZGMDM5QjU0MyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBRjk1Njc1MjU4OTkxMUU5QUI1NUJGMUZGMDM5QjU0MyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/uAA5BZG9iZQBkwAAAAAH/2wCEAAEBAQEBAQEBAQEBAQEBAQEBAQEB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" alt="">
                                            </div>
                                        </label>
                                        <label class="label">
                                            <input type="radio" name="paymentMode" value="CASH">
                                            <div class="label-box">
                                                <img src="data:image/png;base64,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" alt="">
                                            </div>
                                        </label>
                                    </div>
                                    <label class="checkbox">
                                        <input type="checkbox" name="checkbox" id="condition">
                                        By confirming the booking, you are agreeing to our terms and policies, cancellation policy and the refund policy.
                                    </label>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="book-table">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <span id="package">{!! ucfirst(strtolower($packageName)) !!}</span> Package
                                                    <h3>{{ $package->name }}</h3>
                                                    <span>{{ $package->destination }}</span>
                                                </td>
                                                <td>
                                                    @if($featuredImage == null)
                                                        <img class="img-fluid" src="https://navigatortourism.com:3000/46071678d146b27401752012d5d75604.jpg" alt="">
                                                    @else
                                                        <img class="img-fluid" src="{!! env('API_DOMAIN_URL_ONE','https://navigatortourism.com:3000')."/$featuredImage"  !!}" alt="">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Start Date</strong> <br>
                                                    <span class="tripStartDate">{!! $startDate !!}</span>
                                                </td>
                                                <td>
                                                    <strong>End Date</strong><br>
                                                    <span class="tripEndDate">{!! $endDate !!}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Total Travelers</strong><br>
                                                    <span class="adult">0</span> Adult, <span class="childBed">0</span> Children with bed, <span class="childNoBed">0</span> Children without bed
                                                </td>
                                                <td> <span class="adult">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Costs</strong><br>
                                                    BDT <span id="cost">{!! \Illuminate\Support\Facades\Session::get('package.tour_price') !!}</span> X  <span class="adult">0</span>
                                                </td>
                                                <td>BDT <span class="totalPrice">0</span></td>
                                            </tr>
                                            <tr>
                                                <td class="promoCode">
                                                    <input placeholder="Enter Promo Code" class="form-control promo_code" type="text" name="promoCode">
                                                    <div>
                                                        <span class="errorTextColor text-danger"><b></b></span>
                                                        <span class="successTextColor text-success"><b></b></span>
                                                    </div>
                                                </td>
                                                <td class="errorText">
                                                    <button class="verify-btn-sm" type="button" id="promo_verify">Verify</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Total</strong>
                                                </td>
                                                <td><strong>BDT <span class="totalPrice">0</span></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="book-now-btn">Book Now</button>
                                        <div class="center-block">
                                        </div>
                                        <div class="errorMessage marginTop10 text-danger"></div>
                                    </div>
                                    <div class="bookingDetail">
                                        <p><span>*</span>At most one child with bed can stay in a room</p>
                                        <p><span>*</span>At most one child without bed can stay in a room</p>
                                        <p><span>*</span>Children aged from 0-1 years will bear no cost</p>
                                        <p><span>*</span>Children aged from 2-5 years will bear 50% cost of an adult and can stay in the same bed with parents</p>
                                        <p><span>*</span>Children aged from 6-10 years will bear 75% cost of an adult and can stay in the same room with parents in extra bed</p>
                                        <p><span>*</span>People aged from 11 years and above will be treated as adults</p>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <script type="text/javascript">
        let packagePrice = "{!! \Illuminate\Support\Facades\Session::get('package.tour_price') !!}";

        $('#tourType').change(function(){
            let packageId = "{{ $package->id }}";
            let tourType  = this.options[this.selectedIndex].text;
            let tourPrice = $('#tourType').val();

            $.ajax({
                type: "GET",
                url: "{{ url('/packages/set-session') }}",
                data: {
                    package_id: packageId,
                    tour_price: tourPrice,
                    tour_type: tourType
                },
                success: function (response) {
                    $('#cost').html(response.tour_price);
                    $('.selectPackagePrice').val(response.tour_price);

                    packagePrice = response.tour_price;
                    $( ".traveler" ).trigger('keyup');
                    $( ".withChild" ).trigger('keyup');
                    $( ".withoutChild" ).trigger('keyup');
                    $('#tour_type').val(tourType);
                }
            });
        });
        $('#tourType').trigger('change');

        $(document).ready(function(){
            let adultPrice = 0;
            let childPrice = 0;

//            $(".icheckbox_square-grey").children(1).addClass('book_for_me');
            $(".only_me").children(1).children(2).addClass('book_for_me');
//            $(".icheckbox_square-grey").children(1).attr('id', 'value');


            $('#promo_verify').on('click', function() {
                let promo_code = $('.promo_code').val();
                let total_price = $('.totalPrice').html();

                if(promo_code == ''){
                    $('.errorTextColor').html('Please provide promocode');
                } else {
                    // $promocode_check_api =
                    $.ajax({
                        type: 'POST',
                        url: '{{url('promocode-check')}}',
                        data: {code : promo_code,price: total_price},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data){
                            if(data.validityResult == 'VALID'){
                                let discountMsg = 'You have received '+data.discount+' % discount.';
                                $('.successTextColor').html(discountMsg);
                                $("#book_discount").val(data.discount);
                                $('.totalPrice').html(data.discountPrice);
                                $("#promo_verify").hide();

                            } else {
                                $('.errorTextColor').html(data.message);
                            }
                            return false;
                        }
                    });
                }
            });

            //code for only_me checkbox
            $(".book_for_me").click(function() {
//                alert('got');
                if($('#book_for_me').prop('checked') == true){
                    let user = "{!! $name !!}";
                    let email = "{!! $email !!}";
                    let mobile = "{!! $mobile !!}";

                    if($(".email").val()){
                        email = $(".email").val();
                    }

                    if($(".mobile").val()){
                        mobile = $(".mobile").val();
                    }

                    $(".travelerName").val(user);
                    $(".email").val(email);
                    $(".mobile").val(mobile);
                }
                else if($('#book_for_me').prop('checked') == false){
                    $(".travelerName").val('');
                    $(".email").val('');
                    $(".mobile").val('');
                }

            });

            //Code for member count
            $( ".traveler" ).on('keyup keydown change', function(e)  {
                let totalTraveller =  $( ".traveler" ).val();
                if(!totalTraveller){
                    totalTraveller = 0;
                }

                if(totalTraveller < 0){
                    $('.countError').html('Count must be positive number');
                }
                adultPrice = packagePrice * totalTraveller;
                $('.adult').html(totalTraveller);
                $('.totalPrice').html(adultPrice);
            });

            $('.withChild').on('keyup keydown change', function(e) {
                let totalTraveller =  $( ".withChild" ).val();

                if(totalTraveller == ''){
                    totalTraveller = 0;
                }

                if(totalTraveller < 0){
                    $('.childCountError').html('Count must be positive number');
                }

                childPrice = totalTraveller * (packagePrice*0.75);
                $('.childBed').html(totalTraveller);
                $('.totalPrice').html(adultPrice + childPrice);
            });

            $( ".withoutChild" ).on('keyup keydown change', function(e){
                let totalTraveller =  $( ".withoutChild" ).val();

                if(totalTraveller == ''){
                    totalTraveller = 0;
                }

                if(totalTraveller < 0){
                    $('.noChildCountError').html('Count must be positive number');
                }

                let withoutChildPrice = totalTraveller * (packagePrice*0.50);
                $('.childNoBed').html(totalTraveller);
                $('.totalPrice').html(adultPrice + childPrice + withoutChildPrice);
            });

            //check differents validity based on book now event
            $( ".book-now-btn" ).click(function(event) {

                let name = $('.travelerName').val();
                let email = $('.email').val();
                let mobile = $('.mobile').val();
                let payment = $("input[name='paymentMode']:checked").val();
                let startDate = $(".start_date").val();

                let roomType = $('#roomType-0').val();
                let roomCount = $('.totalRoom').val();
                let minPeople = "{!! $package->minimum_number_people !!}";
                let travellerCount = $('.traveler').val();
                let withChild = $('.withChild').val();
                let withoutChild = $('.withoutChild').val();

                if($("#condition").prop('checked') == false){
                    event.preventDefault();
                    $('.errorMessage').html('Please select the checkbox for confirming all agreements');
                } else if (name == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please provide traveller name');
                } else if (email == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please provide traveller email');
                } else if (mobile == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please provide traveller mobile number');
                } else if (roomType == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please select a room type');
                } else if (roomCount == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please provide room count');
                } else if (travellerCount == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please provide total traveller');
                } else if (payment == undefined){
                    event.preventDefault();
                    $('.errorMessage').html('Please select a payment option');
                } else if (startDate == ''){
                    event.preventDefault();
                    $('.errorMessage').html('Please select a travel start date');
                }
                else {

                    event.preventDefault();
                    //code for validating child capacity
                    $.ajax({
                        type: 'POST',
                        url: '{{url('children-check')}}',
                        data: {roomType : roomType,
                            roomCount:roomCount,
                            minPeople:minPeople,
                            travellerCount:travellerCount,
                            withChild:withChild,
                            withoutChild:withoutChild
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data){
                            if(data.statusCode == 200){
                                $('.errorMessage').html(data.message);
                            } else {
                                $('form').submit();
                            }
                        },
                        error: function (jqXHR) {
                            //
                        }
                    });
                }
            });

            //Change date range
            $('.start_date').change(function() {
                let duration = "{{ $package->duration_day }}";
                let startDate = $('.start_date').val();
                let date = new Date(startDate);
                date.setDate(date.getDate() + (+duration));

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

                $('.tripStartDate').html(startDate);
                $('.end_date').val(someFormattedDate);
                $('.tripEndDate').html(someFormattedDate);
            });

            $('.travel-date').datepicker({
                format: "yyyy-mm-dd",
                changeMonth: true,
                changeYear: true,
            });

        })

//        bajb_backdetect.OnBack = function()
//        {
//            var pathname = window.location.pathname; // Returns path only (/path/example.html)
////            var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
////            var origin   = window.location.origin;   // Returns base URL (https://example.com)
//           if(pathname == '/booking'){
//               window.history.back();
//               location.reload(true);
//           }
//        }



    </script>
@endsection



