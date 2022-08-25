@extends('layouts.app')
@section('header-css')
    {{--    {!! Html::style('/assets/data-table/css/dataTables.bootstrap4.css') !!}--}}
    {!! Html::style('/assets/data-table/css/jquery.dataTables.min.css') !!}
@endsection
@section('search')
    <section class="parallax-window" data-parallax="scroll"
             data-image-src="{!! asset('assets/rev-slider-files/assets/banner.jpg') !!}" data-natural-width="1400"
             data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>BOOKING HISTORY</h1>
                <p>All information of your bookings can be found here.</p>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="margin_60 container-fluid">
        <div id="tabs" class="tabs">
            <nav>
                <ul>
                    <li><a href="#section-1" class="icon-booking"><span>Package</span></a>
                    </li>
                    <li><a href="#section-2" class="icon-wishlist"><span>Hotel</span></a>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <section class="col-md-12" id="section-1">
                    <table id="dtUsageHistory" class="table table-responsive-sm table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>Package ID</th>
                            <th>Tour Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Booking Ref</th>
                            <th>People Count</th>
                            <th>Children Count</th>
                            <th>Infant Count</th>
                            <th>Payment Mode</th>
                            <th>Booking Status</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Travel Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usageHistories as $usageHistory)
                            <tr>
                                <td>{!! $usageHistory->package_id !!}</td>
                                <td>{!! $usageHistory->tour_type !!}</td>
                                <td>{!! $usageHistory->mobile_no !!}</td>
                                <td>{!! $usageHistory->email !!}</td>
                                <td>{!! $usageHistory->booking_ref !!}</td>
                                <td>{!! $usageHistory->people_count !!}</td>
                                <td>{!! $usageHistory->children_count_bed !!}</td>
                                <td>{!! $usageHistory->children_count_no_bed !!}</td>
                                <td>{!! $usageHistory->paymentMode !!}</td>
                                <td>{!! $usageHistory->booking_status !!}</td>
                                <td>{!! $usageHistory->price !!}</td>
                                <td>{!! $usageHistory->discount !!}</td>
                                <td>{!! $usageHistory->travel_date !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </section>
                <!-- End section 1 -->

                <section class="col-md-12" id="section-2">
                    <table id="dtHotelHistory" class="table table-responsive-sm table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Hotel Name</th>
                            <th>Booking Reference</th>
                            <th>Price</th>
                            <th>Booking Status</th>
                            <th>Payment Method</th>
                            <th>Cancellation Deadline</th>
                            <th>Cancellation Condition</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotelHistories as $hotelHistory)
                            <tr>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>{{ $hotelHistory->AgencyReference }}</td>
                                <td>{{ $hotelHistory->Price }} {{ $hotelHistory->Currency }}</td>
                                <td>{{ $hotelHistory->BookingStatus }}</td>
                                <td>{{ $hotelHistory->PaymentOption }}</td>
                                <td>#</td>
                                <td>#</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <!-- End section 2 -->
            </div>
            <!-- End content -->
        </div>
        <!-- End tabs -->
    </div>
    <!-- end container -->




    <!-- end container -->
@endsection
@section('footer-script')
    <!-- Specific scripts -->
    {!! Html::script('/assets/data-table/js/jquery.dataTables.js') !!}
    <!-- Specific scripts -->
    {!! Html::script('assets/js/tabs.js') !!}
    <script>
        new CBPFWTabs(document.getElementById('tabs'));
    </script>
    <script>
        $('.wishlist_close_admin').on('click', function (c) {
            $(this).parent().parent().parent().fadeOut('slow', function (c) {
            });
        });

        $(document).ready(function () {
            $('#dtUsageHistory').DataTable({
                "pagingType": "simple" ,// "simple" option for 'Previous' and 'Next' buttons only
                language: {
                    searchPlaceholder: "Booking Reference"
                }
            });

            $('#dtHotelHistory').DataTable({
                "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
            });
            $('.dataTables_length').addClass('bs-select');

        });
    </script>
@endsection


