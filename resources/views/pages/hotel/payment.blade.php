@extends('layouts.app')
@section('search')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{!! asset('assets/rev-slider-files/assets/banner.jpg') !!}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>COMPLETE YOUR BOOKING</h1>
                <p>Enter necessary information to complete your hotel booking</p>
            </div>
        </div>
    </section>
    <!-- End section -->
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

        {!! Form::open(['url'=>'hotels/book','method'=>'post']) !!}
        <div class="row">
            <div class="col-lg-8 add_bottom_15">
                <div class="form_title">
                    <h3><strong>1</strong>Booking Details</h3>
                </div>

                <div class="step">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Customer Name*</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" required value="{!! $user->display_name !!}">
                                <input type="hidden" class="form-control"  name="user_id"  value="{!! $user->userId !!}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" required value="{!! $user->email !!}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Telephone*</label>
                                <input type="text" class="form-control" id="user_mobile" name="user_mobile"  required value="{!! $user->phone_no !!}">
                            </div>
                        </div>
                    </div>
                </div>
                <!--End step -->
                <div class="form_title">
                    <h3><strong>2</strong>Traveler Information</h3>
                </div>
                <div class="step">
                    @php ($i = 0)  
                        @foreach ($roomArray as $room)
                            <b>Room: {!! $i+1 !!}</b>
                           @for($j = 0; $j < $room['count']; $j++)
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Room Type</label>
                                        <p>{!! $room['name'] !!}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    {{--<select class="form-control" name="traveller[{{ $i }}]Salutation[]">--}}
                                        {{--<option value="Mr" selected>Mr.</option>--}}
                                        {{--<option value="Mrs">Mrs.</option>--}}
                                        {{--<option value="Ms">Ms.</option>--}}
                                    {{--</select>--}}
                                    {!! Form::select("traveller[$i][$j][Salutation]",['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control','placeholder'=>'select an option','required']) !!}

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    {{--<input type="text" name="traveller[{{ $i }}]first_name[]" class="form-control">--}}
                                    {!! Form::text("traveller[$i][$j][first_name]",null,['class'=>'form-control', 'placeholder'=>'Enter First Name', 'required' => 'required']) !!}

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    {{--<input type="text" name="traveller[{{ $i }}]last_name[]" class="form-control">--}}
                                    {!! Form::text("traveller[$i][$j][last_name]",null,['class'=>'form-control', 'placeholder'=>'Enter Last Name', 'required' => 'required']) !!}

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Age</label>
                                    {{--<input type="text" name="traveller[{{ $i }}]age[]" class="form-control">--}}
                                    {!! Form::text("traveller[$i][$j][age]",null,['class'=>'form-control', 'placeholder'=>'Enter Age', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                            @endfor
                        @php ($i++) 
                    @endforeach
                    <!--End row -->
                </div>
                <!--End step -->
                <div class="form_title">
                    <h3><strong>3</strong>Cancellation Policy </h3>
                </div>

                <div class="step">
                    <div class="row">
                      @if(isset($details->CxlPolicy))
                        @if($details->CxlPolicy->NonRefundable == true)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label> <strong>Cancellation of the booking is non-refundable.</strong></label>
                            </div>
                        </div>
                        @elseif($details->CxlPolicy->NonRefundable == false && $details->CxlPolicy->Conditions[0]->Amount > 0)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>This booking may be cancelled within <span>{!! $details->CxlPolicy->Conditions[0]->ToDate !!}</span> for a fee of BDT <span>{!! $details->CxlPolicy->Conditions[0]->Amount !!}</span></strong></label>
                            </div>
                        </div>
                        @elseif($details->CxlPolicy->Conditions[0]->Amount == 0 && empty($details->CxlPolicy->Conditions[0]->Text))
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>This booking may be cancelled for free within <span>{!! $details->CxlPolicy->Conditions[0]->ToDate !!}</span>.</strong></label>
                            </div>
                        </div>
                        @elseif($details->CxlPolicy->Conditions[0]->Amount == 0 && !empty($details->CxlPolicy->Conditions[0]->Text))
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>{!! $details->CxlPolicy->Conditions[0]->Text !!}</strong></label>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>Comment :</strong> {!! $details->CxlPolicy->Comment  !!}</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>Remarks : </strong>
                                    @if($details->CxlPolicy->Remarks != null)
                                        @foreach($details->CxlPolicy->Remarks as $remarks)
                                            </strong> {!! $remarks !!}</label><br>
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                        </div>
                      @endif
                      @if(isset($details->DayPrices))
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong>Essential Information :</strong> {!! $details->DayPrices->EssentialInfo  !!}</label>
                            </div>
                          </div>
                      @endif
                    </div>
                    <!--End row -->
                </div>
                <!--End step -->

                <div id="policy">
                    <h4>Payment Mode</h4>
                    <p>
                        <img src="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMqaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjUtYzAxNCA3OS4xNTE0ODEsIDIwMTMvMDMvMTMtMTI6MDk6MTUgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUY5NTY3NTM1ODk5MTFFOUFCNTVCRjFGRjAzOUI1NDMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUY5NTY3NTQ1ODk5MTFFOUFCNTVCRjFGRjAzOUI1NDMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBRjk1Njc1MTU4OTkxMUU5QUI1NUJGMUZGMDM5QjU0MyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBRjk1Njc1MjU4OTkxMUU5QUI1NUJGMUZGMDM5QjU0MyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/uAA5BZG9iZQBkwAAAAAH/2wCEAAEBAQEBAQEBAQEBAQEBAQEBAQEB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" alt="">
                    </p>
                    <hr>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="checkbox" id="policy_terms">
                            By confirming this booking, you agree to our <a href="#">terms and policies</a>, <a href="#">cancellation policy</a>  and the <a href="#">refund policy.</a>
                        </label>
                    </div>
                    {{--<button class="btn_1 green medium book_now" id="book_now">Book Now</button>--}}
                </div>
            </div>
            <aside class="col-lg-4">
                <div class="box_style_1">
                    <h3 class="inner">- Summary -</h3>
                    <table class="table table_summary">
                        <tbody>
                        <tr>
                            <td>
                                Hotel Name
                            </td>
                            <td class="text-right">
                             @if(isset($HotelDetails))
                               {!! $HotelDetails->HotelName !!}
                             @else
                                InterContinental
                             @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Location
                            </td>
                            <td class="text-right">
                             @if(isset($HotelDetails))
                                {!! $HotelDetails->Location !!}
                            @else
                                Dhaka
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Check in
                            </td>
                            <td class="text-right">
                                {!! \Illuminate\Support\Facades\Session::get('hotel_data')['CheckInDate'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Check out
                            </td>
                            <td class="text-right">
                                {!! \Illuminate\Support\Facades\Session::get('hotel_data')['CheckOutDate'] !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Currency
                            </td>
                            <td class="text-right">
{{--                                {!! $details->DayPrices->Currency !!}--}}
                                BDT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Enter Promo Code
                            </td>
                            <td class="text-right">
                                <div class="form-group">
                                    <input type="text" name="promo_code" class="form-control promo_code">
                                    <input type="hidden" name="total_amount"  value="{!! $hotelPrice !!}">
                                    <input type="hidden" name="discount_price" id="book_discount" value="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="errorTextColor text-danger"><b></b></span>
                                <span class="successTextColor text-success"><b></b></span>
                            </td>
                            <td class="text-right">
                                <label class="verify-btn-sm" id="promo_verify">Verify</label>
                            </td>
                        </tr>
                        <tr class="total">
                            <td>
                                Total Price
                            </td>
                            <td class="text-right">
{{--                                <span class="totalPrice">{!! $details->DayPrices->TotalPrice !!}</span>--}}
                                <span class="totalPrice">{!! $hotelPrice !!}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="book-now-btn" id="book_now">Book Now</button>
                </div>
            </aside>
        </div>
        {!! Form::close() !!}
        <!--End row -->
    </div>
@endsection
@section('footer-script')
    <script type="text/javascript">

        $(document).ready(function(){

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
                                let discountMsg = 'You have received  '+data.discount+' % discount.';
                                $('.successTextColor').html(discountMsg);
                                $("#book_discount").val(data.discountPrice);
                                $('.totalPrice').html(data.discountPrice);
                                $("#promo_verify").hide();
                                return false;

                            } else {
                                $('.errorTextColor').html(data.message);
                            }
                            return false;
                        }
                    });
                }
            });

            //check differents validity based on book now event
            $( "#book_now" ).click(function(event) {

                let name = $('#user_name').val();
                let email = $('#user_email').val();
                let mobile = $('#user_mobile').val();

                if($("#policy_terms").prop('checked') == false){
                    event.preventDefault();
                    $('.errorTextColor').html('Please select the checkbox for confirming all agreements');
                } else if (name == ''){
                    event.preventDefault();
                    $('.errorTextColor').html('Please provide user name');
                } else if (email == ''){
                    event.preventDefault();
                    $('.errorTextColor').html('Please provide user email');
                } else if (mobile == ''){
                    event.preventDefault();
                    $('.errorTextColor').html('Please provide user mobile number');
                }
            });
        })
    </script>
@endsection