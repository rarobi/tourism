<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Illuminate\Http\Request;

class HomeController extends ApiListController
{
    protected $hotelController;
    public function __construct(HotelController $hotelController)
    {
        $this->hotelController = $hotelController;
    }

    public function index()
    {
        $url = $this->getFeaturedPackageApiUrl();
//        $destinationApiUrl = $this->getDestinationByKeywordApiUrl("Dha");
        $response = $this->getDataApiOne($url);
//        $destinationResponse = $this->getDataApiThree($destinationApiUrl);

        $data['featuredPackages'] = [];
        $data['destinations'] = [];
        $hotelSession = $this->hotelController->getSession();
        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body->featuredPackages)){
                $data['featuredPackages'] = $response->body->featuredPackages;
            }
        }

//        if(isset($destinationResponse[0])){
//            foreach($destinationResponse as $key => $destination){
//                $data['destinations'][$destination->DestinationId] = $destination->Name;
//                if($key>100){
//                    break;
//                }
//            }
//        }

        $countryWisePackageUrl =  $this->getPackageCountryWiseApiUrl();
        $packageResponse = $this->getDataApiOne($countryWisePackageUrl);
//        dd($packageResponse);
        if($response->status == '200 OK'){
            $data['countryList'] = $packageResponse->body->packages;
        } else {
            return redirect()->route('home.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }


        $data['childrenAges'] = $this->childrenAges();
        return view("pages.home.index",$data);
    }

    public function childrenAges(){
        return [
          1=>'1 Year Age',
          2=>'2 Year Age',
          3=>'3 Year Age',
          4=>'4 Year Age',
          5=>'5 Year Age',
          6=>'6 Year Age',
          7=>'7 Year Age',
          8=>'8 Year Age',
          9=>'9 Year Age',
          10=>'10 Year Age',
          11=>'11 Year Age',
          12=>'12 Year Age',
          13=>'13 Year Age',
          14=>'14 Year Age'
        ];
    }

    public function faq(){
        return view("pages.home.faq");
    }

    public function about(){
        return view("pages.home.about");
    }

    public function showError(){
        return view('pages.home.error');
    }
}
