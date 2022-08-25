<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SignUpController extends ApiListController
{
    public function index(){
        return view("pages.signup.index");
    }

    public function register(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $input['firstName']  = $request->first_name;
        $input['lastName']   = $request->last_name;
        $input['phone_no']   = 88 . $request->mobile_number;
        $input['email']      = $request->email;
        $input['password']   = md5($request->password);
        $input['usernm']     = $request->email; 
        $input['user_type']  = 3; 
        $input['display_name'] = $request->first_name . " " . $request->last_name;

        $url          = $this->postSignUpApiUrl();
        $response     = $this->postDataApiTwo($url, $input);

        if(!isset($response->status)){
            return redirect()->route('sign-up.index')->withInput()->with('flash_danger','Something went wrong !');
        }

        if(isset($response->status_code) && $response->status_code == 400){
            return redirect()->route('sign-up.index')->withInput()->with('flash_danger','Duplicate email address !');
        }

        if($response->status == '200 OK'){
            Session::put('view', 'home.index');
            return redirect()->route('login.index')->withInput()->with('flash_success',$response->body);
        }
    }
    
    public function verify($code)
    {
        $url        = $this->getSignupVerificationStatus($code);
        $response   = $this->getDataApiTwo($url);
        $data['code'] = "";

        if($response->status == "200 OK"){
            $data['message'] = "Your registration is successful. You can now login with your credentials";
            $data['code'] = 200;
        } else {
            $data['message'] = "Sorry !Invalid verification code";
            $data['code'] = 400;
        }
        return view("pages.signup.success", $data);
    }
}
