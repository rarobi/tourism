@extends('layouts.app')
@section('search')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{!! asset('assets/rev-slider-files/assets/banner.jpg') !!}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Hello {{ $profile->display_name }}!</h1>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="margin_60 container">
        <div id="tabs" class="tabs">
            <nav>
                <ul>
                    <li>
                        <a href="#section-2" class="icon-profile"><span>Profile</span></a>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <section id="section-2">
                    <div class="col-md-6 offset-md-3">
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <p>--}}
{{--                                <img src="/assets/img/tourist_guide_pic.jpg" alt="Image" class="img-fluid styled profile_pic">--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- End row -->

                    {!! Form::open(['url'=>route('profile.store'),'method'=>'post']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Profile Details</h4>
                            <p class="text-muted">Please fill up the below forms carefully</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            {!! Form::label('first_name','First Name',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('first_name',(isset($profile->firstName)?$profile->firstName:''),['class'=>$errors->has('first_name')?'form-control is-invalid':'form-control','placeholder'=>'First name']) !!}
                        </div>
                        <div class="form-group col-2">
                            {!! Form::label('middle_name','Middle Name',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('middle_name',(isset($profile->middleName)?$profile->middleName:''),['class'=>$errors->has('middle_name')?'form-control is-invalid':'form-control','placeholder'=>'Middle name']) !!}
                        </div>
                        <div class="form-group col-2">
                            {!! Form::label('last_name','Last Name',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('last_name',(isset($profile->lastName)?$profile->lastName:''),['class'=>$errors->has('last_name')?'form-control is-invalid':'form-control','placeholder'=>'Last name']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            {!! Form::label('gender','Gender',['class'=>'font-weight-bold']) !!}
                            {!! Form::select('gender',['male'=>'Male','female'=>'Female'],(isset($profile->gender)?$profile->gender:''),['class'=>$errors->has('gender')?'form-control is-invalid':'form-control','placeholder'=>'Select Gender']) !!}
                        </div>
                        <div class="form-group col-2">
                            {!! Form::label('blood_group','Blood Group',['class'=>'font-weight-bold']) !!}
                            {!! Form::select('blood_group',['1'=>'A+ (ve)','2'=>'B+ (ve)','3'=>'O+ (ve)','4'=>'AB+ (ve)','5'=>'A- (ve)','6'=>'B- (ve)','7'=>'O- (ve)','8'=>'AB- (ve)'],(isset($profile->bloodGroup)?$profile->bloodGroup:''),['class'=>$errors->has('blood_group')?'form-control is-invalid':'form-control','placeholder'=>'Select Blood Group']) !!}
                        </div>
                        <div class="form-group col-2">
                            {!! Form::label('nationality','Nationality',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('nationality',(isset($profile->nationality)?$profile->nationality:''),['class'=>$errors->has('nationality')?'form-control is-invalid':'form-control','placeholder'=>'Nationality']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            {!! Form::label('email_address','Email',['class'=>'font-weight-bold']) !!}
                            {!! Form::email('email_address',(isset($profile->email)?$profile->email:''),['class'=>$errors->has('email_address')?'form-control is-invalid':'form-control','placeholder'=>'Email address']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            {!! Form::label('phone_no','Mobile',['class'=>'font-weight-bold']) !!}
                            <div class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" style="line-height: 0">+88</span>
                                </div>
                                {!! Form::text('phone_no',(isset($profile->phone_no)?substr($profile->phone_no,-11,11):''),['class'=>$errors->has('phone_no')?'form-control is-invalid':'form-control','placeholder'=>'Mobile number']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-6">
                            {!! Form::label('date_of_birth','Birthday',['class'=>'font-weight-bold']) !!}<br>
                            <label class="font-wight-normal">Select your birth date according to your passport. Other people won’t see your birthday.</label>
                            {!! Form::text('date_of_birth',(isset($profile->date_of_birth)?\Carbon\Carbon::parse($profile->date_of_birth)->format('Y-m-d'):''),['class'=>$errors->has('date_of_birth')?'form-control is-invalid':'form-control','id'=>'birthDate','placeholder'=>'yy-mm-dd']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            {!! Form::label('passport','Passport Number',['class'=>'font-weight-bold']) !!}<br>
                            {!! Form::text('passport',(isset($profile->passport)?$profile->passport:''),['class'=>$errors->has('passport')?'form-control is-invalid':'form-control','placeholder'=>'Passport number']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            {!! Form::label('nid','National Identification Number',['class'=>'font-weight-bold']) !!}<br>
                            {!! Form::text('nid',(isset($profile->nid)?$profile->nid:''),['class'=>$errors->has('nid')?'form-control is-invalid':'form-control','placeholder'=>'National identification number']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('profession','Profession',['class'=>'font-weight-bold']) !!}<br>
                            {!! Form::text('profession',(isset($profile->Profession)?$profile->Profession:''),['class'=>$errors->has('profession')?'form-control is-invalid':'form-control','placeholder'=>'Profession']) !!}
                        </div>
                    </div>

                    <div class="row mt-lg-5">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Present Address</h4>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-3">
                            {!! Form::label('present_holding_address','Holding Address',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_holding_address',(isset($presentAddress[0])?$presentAddress[0]:''),['class'=>$errors->has('present_holding_address')?'form-control is-invalid':'form-control','placeholder'=>'Holding address']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('present_apt','Apt#',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_apt',(isset($presentAddress[1])?$presentAddress[1]:''),['class'=>$errors->has('present_apt')?'form-control is-invalid':'form-control','placeholder'=>'Middle name']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            {!! Form::label('present_city','City',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_city',(isset($presentAddress[2])?$presentAddress[2]:''),['class'=>$errors->has('present_city')?'form-control is-invalid':'form-control','placeholder'=>'City name']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('present_thana','Thana',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_thana',(isset($presentAddress[3])?$presentAddress[3]:''),['class'=>$errors->has('present_thana')?'form-control is-invalid':'form-control','placeholder'=>'Thana name']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            {!! Form::label('present_post_code','Post Code',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_post_code',(isset($presentAddress[4])?$presentAddress[4]:''),['class'=>$errors->has('present_post_code')?'form-control is-invalid':'form-control','placeholder'=>'Post code']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('present_country','Country',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('present_country',(isset($presentAddress[5])?$presentAddress[5]:''),['class'=>$errors->has('present_country')?'form-control is-invalid':'form-control','placeholder'=>'Country name']) !!}
                        </div>
                    </div>

                    <div class="row mt-lg-5">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Permanent Address</h4>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-3">
                            {!! Form::label('permanent_village','Village',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_village',(isset($permanentAddress[0])?$permanentAddress[0]:''),['class'=>$errors->has('permanent_village')?'form-control is-invalid':'form-control','placeholder'=>'Village name']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('permanent_post_office','Post Office',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_post_office',(isset($permanentAddress[1])?$permanentAddress[1]:''),['class'=>$errors->has('permanent_post_office')?'form-control is-invalid':'form-control','placeholder'=>'Post office']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            {!! Form::label('permanent_police_station','Police Station',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_police_station',(isset($permanentAddress[2])?$permanentAddress[2]:''),['class'=>$errors->has('permanent_police_station')?'form-control is-invalid':'form-control','placeholder'=>'Police station']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('permanent_district','District',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_district',(isset($permanentAddress[3])?$permanentAddress[3]:''),['class'=>$errors->has('permanent_district')?'form-control is-invalid':'form-control','placeholder'=>'District name']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            {!! Form::label('permanent_division','Division',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_division',(isset($permanentAddress[4])?$permanentAddress[4]:''),['class'=>$errors->has('permanent_division')?'form-control is-invalid':'form-control','placeholder'=>'Division name']) !!}
                        </div>
                        <div class="form-group col-3">
                            {!! Form::label('permanent_country','Country',['class'=>'font-weight-bold']) !!}
                            {!! Form::text('permanent_country',(isset($permanentAddress[5])?$permanentAddress[5]:''),['class'=>$errors->has('permanent_country')?'form-control is-invalid':'form-control','placeholder'=>'Country name']) !!}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col">
                            {!! Form::submit('Update Profile',['class'=>'btn_1 green']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    </div>
                </section>
                <!-- End section 4 -->

            </div>
            <!-- End content -->
        </div>
        <!-- End tabs -->
    </div>
    <!-- end container -->
@endsection
@section('footer-script')
    <!-- Specific scripts -->
    {!! Html::script('assets/js/tabs.js') !!}
    <script>
        new CBPFWTabs(document.getElementById('tabs'));
    </script>
    <script>
        $('.wishlist_close_admin').on('click', function (c) {
            $(this).parent().parent().parent().fadeOut('slow', function (c) {});
        });
        $(document).ready(function () {
            $('#birthDate').datepicker({
                format: 'yyyy-mm-dd',
                autoClose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection


