<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PackageController extends ApiListController
{
    public function index(){
        $url = $this->getAllPackagesApiUrl();
        $response = $this->getDataApiOne($url);

        $data['packages'] = [];
        if(isset($response->status) && $response->status == '200 OK'){
            $data['totalPackage'] = $response->totalCount;
            if(isset($response->body->packages)){
                $data['packages'] = $response->body->packages;
            }
        }
        return view("pages.package.index",$data);
    }

    public function searchPackage(Request $request){
        $destination = $request->input('destination');
        $url = $this->getSearchPackageApiUrl($destination);
        $response = $this->getDataApiOne($url);
        $data['packages'] = [];
        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body->packages)){
                $data['packages'] = $response->body->packages;
            }
        }
        return view("pages.package.search-results",$data);
    }

    public function show($packageId){
        $url = $this->getPackageDetailsApiUrl($packageId);
        $response = $this->getDataApiOne($url);
        $data['package'] = null;
        $data['packageTypes'] = null;
        $data['packageTypeDetails'] = null;
        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body[0])){
                $data['package'] = $response->body[0];

                $package = $data['package'];
                foreach($package->media as $media){
                    if($media->isFeatured){
                        $data['featuredImage'] = $media->path;
                    }
                }

                foreach($package->tourTypeDetails as $key => $tourType){
                    $data['packageTypes'][$tourType->price] = ucfirst(strtolower($tourType->tour_type));

                    $data['packageTypeDetails']["$tourType->tour_type"][] = [
                        'hotel_name' => $tourType->name,
                        'location' => $tourType->location,
                        'duration' => $tourType->duration,
                    ];
                }
            }
        }

        if(!$data['package']){
            return redirect()->back()->with('flash_danger','Something went wrong!');
        }

        return view("pages.package.single",$data);
    }

    public function setSession(Request $request){
        $data = [
            'package_id' => $request->get('package_id'),
            'tour_price' => $request->get('tour_price'),
            'tour_type' => $request->get('tour_type'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'featured_image' => $request->get('featured_image')
        ];
        Session::put('package',$data);
        return response()->json($data);
    }

    public function success(Request $request, $booking_ref)
    {
        $url        = $this->postPaymentIpnApiUlr($booking_ref);
        $response   = $this->getDataApiOne($url);

        if($response->status == "200 OK"){
            return redirect()->route('booking.success')->with('flash_success', 'Congratulations !You are successfully complete this payment');

        } else {
           return redirect()->route('hotel.error')->with('flash_error', 'Sorry !You are failed to complete this payment'); 
        }

    }

    public function fail(Request $request)
    {
        return redirect()->route('hotel.error')->with('flash_error', 'Sorry !You are failed to complete this payment');

    }

    public function cancel(Request $request)
    {
        return redirect()->route('hotel.error')->with('flash_error', 'You successfully cancel this payment');

    }
}
