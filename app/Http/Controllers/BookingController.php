<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends ApiListController
{
    public function index(){
        if(!session('user')){
            $view = request()->route()->getAction()['as'];
            return view("pages.login.index", ["view"=>$view]);
        }

        $user =  decrypt(session()->get('user'));

        $data['name']     = $user->display_name;
        $data['email']    = $user->email;
        $data['mobile']   = $user->phone_no;

        $packageId  = Session::get('package.package_id');
        $data['packageName']  = Session::get('package.tour_type');
        $data['startDate']    = Session::get('package.start_date');
        $data['endDate']      = Session::get('package.end_date');
        $data['featuredImage']= Session::get('package.featured_image');

        $url = $this->getPackageDetailsApiUrl($packageId);
        $response = $this->getDataApiOne($url);
        $data['packageTypes'] = null;
        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body[0])){
                $package = $response->body[0];
                $data['package'] = $package;
                foreach($package->tourTypeDetails as $tourType){
                    $data['packageTypes'][$tourType->price] = ucfirst(strtolower($tourType->tour_type));
                }
            }
        }
        return view("pages.booking.details" , $data);
    }

    public function bookPackage(Request $request) {
        $this->validate($request,[
            'travelDate' => 'required',
            'checkbox' => 'required'
        ]);

        $childrenWithBed   =  $request->input('children_count_bed');
        $childrenWithNoBed =  $request->input('children_count_no_bed');

        $user =  decrypt($request->session()->get('user'));
        $data['userId']                 = $user->userId;
        $data['userName']               = $request->input('userName');
        $data['tourType']               = $request->input('tour_type');
        $data['travelDate']             = Carbon::parse($request->input('travelDate'))->format("Y-m-d\TH:i:s.000\Z");
        $data['type']                   = $request->input('type');
        $data['count']                  = $request->input('count');
        $data['peopleCount']            = $request->input('peopleCount');
        $data['children_count_bed']     = isset($childrenWithBed) ? $childrenWithBed : 0;
        $data['children_count_no_bed']  = isset($childrenWithNoBed) ? $childrenWithNoBed : 0;
        $data['email']                  = $request->input('email');
        $data['mobileNumber']           = $request->input('mobileNumber');
        $data['paymentMode']            = $request->input('paymentMode');
        $data['packageId']              = $request->input('packageId');
        $price                          = $request->input('price');
        $data['discount']               = $request->input('discount');
        if($data['discount'] == null ){
            $data['promoCode']              = "";
        } else {
            $data['promoCode']              = $request->input('promoCode');
        }

        if($data['count'] < 0 || $data['peopleCount'] < 0 || $data['children_count_bed'] < 0 || $data['children_count_no_bed'] < 0){
            return redirect()->back()->with('error', 'Count number must be positive value');
        }

        $childCountBedInt = (int) $data['children_count_bed'] ;
        $childCountNoBedInt = (int) $data['children_count_no_bed'] ;
        $roomCount = (int) $data['count'] ;
        $travelerCount = (int) $data['peopleCount'] ;
        //Travellers count validation
        if($data['type'] == 'SINGLE'){

            if($travelerCount > $roomCount){
                return redirect()->back()->with('error', 'Please enter select room type and enter number of rooms according to number of travelers');
            }

            if($childCountBedInt > 0 ){
                if($childCountBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child with bed according to number of travelers');
                }
            }

            if($childCountNoBedInt > 0 ){
                if($childCountNoBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child without bed according to number of travelers');
                }
            }

        } elseif (($data['type'] == 'COUPLE') || ($data['type'] == 'TWINE') ){

            if($travelerCount > $roomCount * 2){
                return redirect()->back()->with('error', 'Please enter select room type and enter number of rooms according to number of travelers');
            }

            if($childCountBedInt > 0 ){
                if($childCountBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child with bed according to number of travelers');
                }
            }

            if($childCountNoBedInt > 0 ){
                if($childCountNoBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child without bed according to number of travelers');
                }
            }

        } elseif ($data['type'] == 'TRIPLE'){

            if($travelerCount > $roomCount * 3){
                return redirect()->back()->with('error', 'Please enter select room type and enter number of rooms according to number of travelers');
            }

            if($childCountBedInt > 0 ){
                if($childCountBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child with bed according to number of travelers');
                }
            }

            if($childCountNoBedInt > 0 ){
                if($childCountNoBedInt > $roomCount) {
                    return redirect()->back()->with('error', 'Please enter select room type and enter number of child without bed according to number of travelers');
                }
            }
        }

        $data['price'] = $this->deductPriceAfterDiscount($price, $data['peopleCount'], $data['children_count_bed'], $data['children_count_no_bed'], $data['discount']);

        $formattedJson = $this->formattedBookingData($data);

        $url        = $this->postBookingApiUrl();
        $response   = $this->postDataApiOneForBooking($url, $formattedJson);
        if($response->status == "200 OK") {
            if($response->body->status == "SUCCESS"){
                if($data['paymentMode'] == "CASH"){
                    return redirect()->route('booking.success')->with('flash_success','Your booking request has been accepted. You will receive a message soon.');
                } else{
                    $redirectURL= $response->body->GatewayPageURL;
                    return redirect($redirectURL);
                }
            } else {
//				var_dump($response->body);
                return redirect()->back()->with('error',$response->body->msg);
            }

        }
    }

    public function formattedBookingData($bookingData){

        $formatBookData =  [
            "userName"  => $bookingData['userName'],
            "packageId" => $bookingData['packageId'],
            "tourType"  => strtoupper($bookingData['tourType']),
            "roomType"  => [[
                "type"  => $bookingData['type'],
                "count" => $bookingData['count'],
            ]],
            "peopleCount"           => $bookingData['peopleCount'],
            "children_count_bed"    => $bookingData['children_count_bed'],
            "children_count_no_bed" => $bookingData['children_count_no_bed'],
            "mobileNumber"          => $bookingData['mobileNumber'],
            "email"                 => $bookingData['email'],
            "paymentMode"           => $bookingData['paymentMode'],
            "userId"                => '"'.$bookingData['userId'].'"',
            "travelDate"            => $bookingData['travelDate'],
            "promoCode"             => isset($bookingData['promoCode']) ? $bookingData['promoCode'] : "",
            "price"                 => $bookingData['price'],

            //Dummy data for testing
//            "userName"  => "Rakibul Hasan",
//            "packageId" => 17,
//            "tourType"  => "STANDARD",
//            "roomType"  => [[
//                "type"  => "COUPLE",
//                "count" => "1",
//            ]],
//            "peopleCount"           => "2",
//            "children_count_bed"    => 0,
//            "children_count_no_bed" => 0,
//            "mobileNumber"          => "8801713178158",
//            "email"                 => "rakib109@gmail.com",
//            "paymentMode"           => "CARD",
//            "userId"                => "241",
//            "travelDate"            => "2020-02-26T16:50:46.000Z",
//            "promoCode"             => "TmZIpKf",
//            "price"                 => 15660,
        ];

        return $formatBookData;
    }

    public function checkPromo(Request $request) {

        $user                 = decrypt($request->session()->get('user'));
        $params['userId']     = $user->userId;
        $params['promoCode']  = $request->input('code');
        $totalPrice           = $request->input('price');

        $url        = $this->postCheckPromoCodeApiUrl();
        $response   = $this->postDataApiOneForBooking($url, $params);

        $percentPrice = $totalPrice * ($response->discount/100);
        $response->discountPrice = round(($totalPrice - $percentPrice), 2);

        return (array) $response;
    }

    public function checkChildren(Request $request){

        $room_type     = $request->input('roomType');
        $room_count    = $request->input('roomCount');
        $min_count     = $request->input('minPeople');
        $traveller_count = $request->input('travellerCount');
        $with_child    = $request->input('withChild');
        $without_child = $request->input('withoutChild');

        $childer_with_bed    = isset($with_child) ? $with_child : 0;
        $childer_without_bed = isset($without_child) ? $without_child : 0;

        $traveller = isset($traveller_count) ? $traveller_count : 0;
//        $totalMember = $traveller + $childer_with_bed + $childer_without_bed;

//        dd($room_type,$room_count,$min_count, $childer_with_bed,$childer_without_bed,$totalMember);
        $data['statusCode'] = 500;
        if($room_type == 'SINGLE'){
            if($traveller > $room_count){
                $data['statusCode'] = 200;
                $data['message'] = 'Please enter room type and number of rooms according to number of travelers';
            } elseif ($traveller < $min_count){
                $data['statusCode'] = 200;
                $data['message'] = 'Total member of people is less than minimum number of people for this package';
            } else{
                if($childer_with_bed > 0 ){
                    if($childer_with_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child with bed according to number of travelers';
                    }
                }

                if ($childer_without_bed > 0 ){
                    if($childer_without_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child without bed according to number of travelers';
                    }
                }
            }

        } elseif (($room_type == 'COUPLE') || ($room_type == 'TWINE') ){
            if($traveller > $room_count * 2){
                $data['statusCode'] = 200;
                $data['message'] = 'Please enter room type and number of rooms according to number of travelers';
            } elseif ($traveller < $min_count){
                $data['statusCode'] = 200;
                $data['message'] = 'Total member of people is less than minimum number of people for this package';
            } else {
                if($childer_with_bed > 0 ){
                    if($childer_with_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child with bed according to number of travelers';
                    }
                }

                if ($childer_without_bed > 0 ){
                    if($childer_without_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child without bed according to number of travelers';
                    }
                }
            }

        } elseif ($room_type == 'TRIPLE'){
            if($traveller > $room_count * 3){
                $data['statusCode'] = 200;
                $data['message'] = 'Please enter room type and number of rooms according to number of travelerss';
            } elseif ($traveller < $min_count){
                $data['statusCode'] = 200;
                $data['message'] = 'Total member of people is less than minimum number of people for this package';
            } else {
                if($childer_with_bed > 0 ){
                    if($childer_with_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child with bed according to number of travelers';
                    }
                }
                if ($childer_without_bed > 0 ){
                    if($childer_without_bed > $room_count) {
                        $data['statusCode'] = 200;
                        $data['message'] = 'Please enter select room type and enter number of child without bed according to number of travelers';
                    }
                }
            }
        }

        return $data;

    }

    public function deductPriceAfterDiscount($price, $traveller, $withChild, $withoutChild, $discount) {

        if($discount == null) {
            $priceForTraveller = $price * $traveller;
            $priceWithChild = ($price * 0.75) * (int) $withChild;
            $priceWithOutChild = ($price * 0.50) * (int) $withoutChild;
            $total = $priceForTraveller + $priceWithChild + $priceWithOutChild;
            return $total;
        } else {
            $priceForTraveller = $price * $traveller;
            $priceWithChild = ($price * 0.75) * (int) $withChild;
            $priceWithOutChild = ($price * 0.50) * (int) $withoutChild;
            $total = $priceForTraveller + $priceWithChild + $priceWithOutChild;

            $percentPrice = $total * ($discount/100);
            $lessPrice = $total - $percentPrice;

            return $lessPrice;
        }
    }

    public function bookingSuccessForCash(){
        return view("pages.booking.success");
    }
}
