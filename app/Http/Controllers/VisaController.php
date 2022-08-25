<?php
/**
 * Created by PhpStorm.
 * User: sajan
 * Date: 4/20/20
 * Time: 7:30 AM
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Api\ApiListController;

class VisaController extends ApiListController
{
    public function index(){

        $data = [];

        $visaDescriptionUrl =  $this->getVisaDescriptionApiUrl();
        $response = $this->getDataApiOne($visaDescriptionUrl);
        if($response->status == '200 OK'){
            $data['description'] = $response->body;
        } else {
            return redirect()->route('home.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }

        $visaDocumentListUrl =  $this->getVisaDocumentListApiUrl();
        $documentResponse = $this->getDataApiOne($visaDocumentListUrl);
        if($response->status == '200 OK'){
            $data['documentList'] = $documentResponse->body;
        } else {
            return redirect()->route('home.error')->with('flash_error','Unfortunately an error occured. Please try again.');
        }

        return view('pages.visa.index', $data);
    }
}