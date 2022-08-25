<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Console\Input\Input;

class LoginController extends ApiListController
{
    public function index() {
        if(session()->has('user')){
            return \redirect('/profile');
        }
        Session::put('url.intended',URL::previous());
        $data['view'] = Session::get('view');
        if(isset($data['view'])) {
            return view("pages.login.index", $data);
        } else {
           return view("pages.login.index"); 
        }
    }

    public function loginCheck(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $data['view'] = $request->input('view');

        $redirectUrl = Session::get('url.intended');

        $input['usernm']  = $request->email;
        $input['password']  = md5($request->password);

        $url        = $this->postLoginApiUrl();
        $response   = $this->postDataApiTwo($url, $input);

        if(isset($response->success) && $response->success == true){
            session(['user' => encrypt($response)]);
            if(isset($data['view'])) {
                return redirect()->route($data['view']);
            } else {
               return redirect($redirectUrl);
            }
            //return redirect()->route('profile.index')->withInput()->with('flash_success',$response->message);
//            return Redirect::to(Session::get('url.intended'));
        }else{
            return redirect()->route('login.index')->withInput()->with('flash_danger',$response->message);
        }
    }

    public function logout(){
        \session()->forget('user');
        return redirect(route('home.index'));
    }
}
