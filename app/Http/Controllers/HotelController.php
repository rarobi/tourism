<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use App\Libraries\Encryption;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class HotelController extends ApiListController
{
    public function getSession(){
        $url = $this->getHotelSessionCreatApiUrl();
        $response = $this->getDataApiThree($url);
        $data['hotel_session'] = null;

        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body->Data->SessionID)){
                $data['hotel_session'] = $response->body->Data->SessionID;
            }
        }
        Session::put($data);
        return $data['hotel_session'];
    }

    public function search(Request $request){
        $request->validate([
            'destination_id'=>'required'
        ]);

        $data['SessionID'] = Session::get('hotel_session');
        $data['DestinationId'] = (int)$request->get('destination_id');
        $data['CheckInDate'] = $request->get('check_in_date');
        $data['CheckOutDate'] = $request->get('check_out_date');
        $data['CurrencyCode'] = 'BDT';
        $data['NationalityCode'] = 'RO';


        foreach($request->get('rooms') as $key => $room){
            $data['Rooms'][$key]['RoomID'] = ($key+1);
            $data['Rooms'][$key]['AdultsNo'] = (int)$room['adults'];
            $data['Rooms'][$key]['ChildrenNo'] = (int)$room['children'];
            if($room['children']>0){
                foreach ($room['children_ages'] as $childrenAge){
                    $data['Rooms'][$key]['ChildrenAges'][] = $childrenAge;
                }
            }else{
                $data['Rooms'][$key]['ChildrenAges'] = [];
            }
        }

        $url = $this->postHotelByMinimumPriceApiUrl();
        $response = $this->postDataApiThree($url,$data);
        $data['hotels'] = [];
        if(isset($response->Data) && $response->Success){
            $data['hotels'] = $response->Data;
            $data['destinationName'] = (isset($response->Data[0]->DestinationName))?$response->Data[0]->DestinationName:null;
            Session::put('hotel_data',$data);
        } else {
            return redirect()->route('hotel.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }

        return view("pages.hotel.search-results",$data);
    }

    public function details($code){
        $data['SessionID'] = Session::get('hotel_data.SessionID');
        $data['DestinationId'] = Session::get('hotel_data.DestinationId');
        $data['CheckInDate'] = Session::get('hotel_data.CheckInDate');
        $data['CheckOutDate'] = Session::get('hotel_data.CheckOutDate');
        $data['CurrencyCode'] = Session::get('hotel_data.CurrencyCode');
        $data['NationalityCode'] = Session::get('hotel_data.NationalityCode');
        $data['Rooms'] = Session::get('hotel_data.Rooms');
        $data['HotelCode'] = Encryption::decodeId($code);

        $url = $this->postHotelDetailsByHotelCodeApiUrl();
        $response = $this->postDataApiThree($url,$data);

        if(isset($response->Data) && $response->Success){
            $data['details'] = (isset($response->Data[0]))?$response->Data[0]:null;
            $data['hotelDetails'] = (isset($response->Data[0]))?$response->Data[0]:null;
            Session::put('hotel_data',$data);
        } else {
            return redirect()->route('hotel.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }

        return view("pages.hotel.details",$data);
    }

    public function payment(Request $request ,$TID){

        if(!session('user')){
            return redirect('/login');
        }

        $user =  decrypt($request->session()->get('user'));
        $data['user'] = $user;

        Session::forget('hotel_data.details');
        $data['SessionID']       = Session::get('hotel_data.SessionID');
        $data['DestinationId']   = Session::get('hotel_data.DestinationId');
        $data['CheckInDate']     = Session::get('hotel_data.CheckInDate');
        $data['CheckOutDate']    = Session::get('hotel_data.CheckOutDate');
        $data['CurrencyCode']    = Session::get('hotel_data.CurrencyCode');
        $data['NationalityCode'] = Session::get('hotel_data.NationalityCode');
        $data['Rooms']           = Session::get('hotel_data.Rooms');
        $data['HotelCode']       = Session::get('hotel_data.HotelCode');
        $data['HotelDetails']    = Session::get('hotel_data.hotelDetails');
        $data['TID']             = $TID;
        $data['hotelPrice']      = $request->price;
        $data['room_name']      = $request->room_name;
        $room_name = $data['room_name'];

        $url = $this->postHotelOptionDetailsApiUrl();
        $response = $this->postDataApiThree($url,$data);

        if($response->status == '200 OK'){
            $data['details'] = (isset($response->body))?$response->body:null;
            Session::put('hotel_data',$data);
        } else {
            return redirect()->route('hotel.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }

        //$data['totalRoom'] = $this->countTotalRoom($data['Rooms']);
        $data['roomArray'] = $this->countTotalRoom($data['Rooms'], $room_name);
        //var_dump($data['roomArray']);
        $data['roomArrayCount'] = count($data['roomArray']);

        return view('pages.hotel.payment', $data);
    }

    public function destinationAjaxSearch(Request $request){

        $destination = $request->get('destination');
        $destinationApiUrl = $this->getDestinationByKeywordApiUrl($destination);
        $destinationResponse = $this->getDataApiThree($destinationApiUrl);

        $data['destinations'] = [];
        if(isset($destinationResponse[0])){
            foreach($destinationResponse as $key => $destination){
                $data['destinations'][$destination->DestinationId] = [
                    'key' => $destination->DestinationId,
                    'value' => $destination->Name
                ];
                if($key>100){
                    break;
                }
            }
        }
        $responseCode = 0;
        if(count($data['destinations'])>0){
            $responseCode = 1;
        }
        $data = ['responseCode' => $responseCode, 'data' => $data['destinations']];
        return response()->json($data);
    }

    public function bookHotel(Request $request){
        $this->validate($request,[
            'checkbox' => 'required'
        ]);

        $discountPrice = $request->input('discount_price');
        $adult         = Session::get('hotel_data.Rooms')[0]['AdultsNo'];
        $child         = Session::get('hotel_data.Rooms')[0]['ChildrenNo'];

        $user =  decrypt($request->session()->get('user'));
        $data['SessionID']       = Session::get('hotel_data.SessionID');
        $data['HotelCode']       = Session::get('hotel_data.HotelCode');
        $data['TID']             = Session::get('hotel_data.TID');
        $data['PaymentOption']   = 1;
        $data['AgencyReference'] = 'test';
        $data['CarbonCopyMail']  = 'test@test.com';
        $data['RoomId']          = Session::get('hotel_data.Rooms');
        $data['AdultsNo']        = $adult;
        $data['ChildrenNo']      = $child;

        $data['traveller']         = $request->get('traveller');

        $data['total_amount']    = isset($discountPrice) ? $discountPrice : $request->input('total_amount');
        $data['currency']        = 'BDT';
        $data['cus_name']        = $request->input('user_name');
        $data['cus_email']       = $request->input('user_email');
        $data['cus_phone']       = $request->input('user_mobile');
        $data['user_id']         = $request->input('user_id');
        $data['dicsountedPrice'] = $discountPrice;

        $formattedJson = $this->formattedBookingData($data);

         $url        = $this->postBookHotelApiUrl();
         $response   = $this->postDataApiThree($url, $formattedJson);

         if($response->status == "200 OK" && $response->body->status ='SUCCESS') {
             $redirectURL= $response->body->GatewayPageURL;
             return redirect($redirectURL);

         } else {
 //            return redirect()->back()->with('error',$response->body);
             return redirect()->back()->with('error','Internal server error found');
         }
    }

    public function countTotalRoom($response, $room_name){
        $room_name = trim($room_name, '[]');
        trim($room_name,'"');
        $roomNameArray = explode ("," , $room_name); 
        $stack = array();
        if($response[0] != null){
            $i = 0;
            foreach ($response as $room) {
                $adultRoom = $room['AdultsNo'];
                $childRoom = $room['ChildrenNo'];
                $room['count'] = $adultRoom + $childRoom;
                $room['name'] = $roomNameArray[$i];  
                array_push($stack, $room);
                $i++;
            }
        }
        return $stack;
    }
    
    public function roomData(Request $request){
        session()->forget('room_name');
        session()->put('room_name', $request->room_name);
    }

    public function formattedBookingData($bookingData){

        $totalRoomTraveller = [];
        foreach($bookingData['traveller'] as $key => $singleRoomTravellers){
            $roomTraveller = [];
            foreach ($singleRoomTravellers as $tempKey => $singleRoomTraveller){
                $roomTraveller[$tempKey]['Salutation'] = $singleRoomTraveller['Salutation'];
                $roomTraveller[$tempKey]['Age']        = $singleRoomTraveller['age'];
                $roomTraveller[$tempKey]['FirstName']  = $singleRoomTraveller['first_name'];
                $roomTraveller[$tempKey]['LastName']   = $singleRoomTraveller['last_name'];
                if($singleRoomTraveller['age'] > 14){
                    $roomTraveller[$tempKey]['IsChild'] = false;
                } else {
                    $roomTraveller[$tempKey]['IsChild'] = true;
                }
            }
            $totalRoomTraveller[$key] = $roomTraveller;
        }

        $roomArray = [];
        if(count($bookingData['RoomId']) > 0){
            foreach ($bookingData['RoomId'] as $key => $singleRoom){
                $roomArray[$key]['RoomId']     = $singleRoom['RoomID'];
                $roomArray[$key]['AdultsNo']   = $singleRoom['AdultsNo'];
                $roomArray[$key]['ChildrenNo'] = $singleRoom['ChildrenNo'];
                $roomArray[$key]['Passengers'] = $totalRoomTraveller[$key];
            }
        }

        $formatBookData =  [
            "SessionID" => $bookingData['SessionID'],
            "HotelCode" => $bookingData['HotelCode'],
            "TID"       => $bookingData['TID'],
            "PaymentOption"   => $bookingData['PaymentOption'],
            "AgencyReference" => $bookingData['AgencyReference'],
            "CarbonCopyMail"  => $bookingData['CarbonCopyMail'],
            "Rooms"             => $roomArray,
            "total_amount"      => $bookingData['total_amount'],
            "currency"          => $bookingData['currency'],
            "cus_name"          => $bookingData['cus_name'],
            "cus_email"         => $bookingData['cus_email'],
            "cus_phone"         => $bookingData['cus_phone'],
            "user_id"           => $bookingData['user_id'],
        ];

        return $formatBookData;
    }

    public function successHotel(Request $request, $booking_ref)
    {
        $url        = $this->postPaymentIpnApiUlrForHotel($booking_ref);
        $response   = $this->getDataApiThree($url);

        if($response->status == "200 OK"){
            return redirect()->route('booking.success')->with('flash_success', 'Congratulations !You are successfully complete this payment');

        } else {
           return redirect()->route('hotel.error')->with('flash_error', 'Sorry !You are failed to complete this payment'); 
        }

    }

    public function failHotel(Request $request)
    {
        return redirect()->route('hotel.error')->with('flash_error', 'Sorry !You are failed to complete this payment');

    }

    public function cancelHotel(Request $request)
    {
        return redirect()->route('hotel.error')->with('flash_error', 'You successfully cancel this payment');


    }

    public function showError(){
        return view('pages.booking.error');
    }
}
