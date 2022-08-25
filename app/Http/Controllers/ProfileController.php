<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Illuminate\Http\Request;

class ProfileController extends ApiListController
{
    public function index(){
        if(!session('user')){
            return redirect(route('login.index'));
        }

        $user = decrypt(session('user'));

        $url        = $this->getUserProfileApiUrl($user->userId);
        $response   = $this->getDataApiTwo($url);
        $data['profile'] = [];
        if(isset($response->status) && $response->status == '200 OK'){
            if(isset($response->body->data[0])){
                $data['profile'] = $response->body->data[0];
                $data['presentAddress'] = array_values(array_filter(explode('|',$response->body->data[0]->presentAddress)));
                $data['permanentAddress'] = array_values(array_filter(explode('|',$response->body->data[0]->parmanentAddress)));
            }
        }
        return view("pages.profile.index",$data);

    }

    public function store(Request $request){

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $input['firstName']  = $request->first_name;
        $input['middleName']   = $request->middle_name;
        $input['lastName']   = $request->last_name;
        $input['gender']   = $request->gender;
        $input['bloodGroup']   = $request->blood_group;
        $input['nationality']   = $request->nationality;
        $input['phone_no']   = 88 . $request->phone_no;
        $input['date_of_birth']   = $request->date_of_birth;
        $input['passport']   = $request->passport;
        $input['nid']   = $request->nid;
        $input['Profession']   = $request->profession;
        $input['presentAddress']   = $request->present_holding_address
            .' | '.$request->present_apt
            .' | '.$request->present_city
            .' | '.$request->present_thana
            .' | '.$request->present_post_code
            .' | '.$request->present_country;

        $input['parmanentAddress']   = $request->permanent_village
            .' | '.$request->permanent_post_office
            .' | '.$request->permanent_police_station
            .' | '.$request->permanent_district
            .' | '.$request->permanent_division
            .' | '.$request->permanent_country;

        $user = decrypt(session('user'));
        $url          = $this->putProfileUpdateApiUrl($user->userId);
        $response     = $this->putDataApiTwo($url, $input);

        if(!isset($response->status)){
            return redirect()->route('profile.index')->withInput()->with('flash_danger','Something went wrong !');
        }

        if($response->status == '200 OK'){
            return redirect()->route('profile.index')->withInput()->with('flash_success','Profile updated successfully');
        }
    }

    public function history(){

        $user = decrypt(session('user'));
        $limit   = 50;
        $offset  = 0;
        $userId = $user->userId;

        $usageHistoryUrl = $this->optionsUsagesHistoryApiUrl($limit, $offset, $userId);
        $usageHistoryResponse = $this->getDataApiOne($usageHistoryUrl);

        $data['usageHistories'] = [];
        if(isset($usageHistoryResponse->status) && $usageHistoryResponse->status == '200 OK' ){
            $data['usageHistories'] = $usageHistoryResponse->body;
        }

        $hotelHistoriesUrl = $this->getHotelBookingHistoryApiUrl($userId);
        $hotelHistoryResponse = $this->getDataApiThree($hotelHistoriesUrl);

        $data['hotelHistories'] = [];
        if(isset($hotelHistoryResponse->body) && $hotelHistoryResponse->status == '200 OK'){
            $data['hotelHistories'] = $hotelHistoryResponse->body;
        }

        return view("pages.profile.history", $data);
    }
}
