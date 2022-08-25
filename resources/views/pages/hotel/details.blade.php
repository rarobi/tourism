@extends('layouts.app')

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

        <h3>{{ $details->HotelName }} Hotel from {{ $CheckInDate }} to {{ $CheckOutDate }}</h3>
        <div class="row">
            <div class="col-lg-12">

            </div>
            <div class="col-lg-12">
                <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 my-auto">
                            <div class="img_list">
                                <a href="{{ route('hotel.details',$details->HotelCode) }}"><img width="100%" src="{{ isset($details->Images[0])?$details->Images[0]:'#' }}" alt="Image">
                                    <div class="short_info"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="tour_list_desc">
                                <div class="rating">
                                    @for($i=1; $i<=$details->StarRating; $i++)
                                        <i class="icon-star voted"></i>
                                    @endfor
                                    @for($i=1; $i<=(5-(int)$details->StarRating); $i++)
                                        <i class="icon-star-empty"></i>
                                    @endfor
                                </div>
                                <p><i class="icon-map"></i> {{ $details->Location }}</p>
                                <h3><strong>{{ $details->HotelName }}</strong> Hotel</h3>
                                {{--                                <p>{!! Str::limit($details->Description,100,"...") !!}</p>--}}
                                <p>{!! $details->Description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End strip -->
            </div>

            <div class="col-lg-12">
                <table class="table table-striped cart-list add_bottom_30">
                    <thead>
                    <tr>
                        <th>
                            Room Name
                        </th>
                        <th>
                            Meal Name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php ($i = 1)  
                    @foreach($details->Options as $option)
                    <tr>
                        <td>
                            @php ($roomName = [])
                            @if(isset($option->Rooms[0]->Description)) 
                            @foreach ($option->Rooms as $room)
                              {{ $room->Description }}
                              @php ($roomName[] = $room->Description)
                              @if (!$loop->last),@endif
                            @endforeach
                            @else N/A @endif
                            <input type="hidden" name="roomName" id="roomName{{ $i}}" value="{{ json_encode($roomName,TRUE)}}">
                        </td>
                        <td>
                            {{ $option->MealName }}
                        </td>
                        <td>
                            <strong>{{ $option->TotalPrice }}</strong>
                        </td>
                        <td width="15%">
                        <a id="" class="btn btn-success" href="{{ route('hotel.payment',[$option->TID,'price' => $option->TotalPrice, 'room_name' => json_encode($roomName,TRUE)]) }}">Book now</a>
                        </td>
                    </tr>
                    @php ($i++) 
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End col-md-8 -->
        </div>
        <!--End row -->
    </div>
@endsection
@section('footer-script')

<script type="text/javascript">
    function myFunction (rowId) {
            //e.preventDefault()
            let id = "#roomName"+rowId;
            let room_name = $(id).val();
            $.ajax({
                type: 'POST',
                url: '{{url('hotels/roomData')}}',
                data: {room_name : room_name},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function() {
//                    console.log("Value added");
                    return true;
                }
            }) 
        return true;    
    }
</script>
@endsection