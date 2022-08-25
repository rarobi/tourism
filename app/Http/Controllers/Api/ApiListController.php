<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;

class ApiListController extends ApiUrlController
{

    public function getDataApiOne($url)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_ONE', url('/')).'/'.$url;
        try {

            $res = $client->request('GET', $url,[
                'headers' => [
                        'app_key' => '123456',
                        'Accept' => 'application/json',
                    ],
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'verify' => false
            ]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiOneForIpn($url)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_ONE', url('/')).'/'.$url;

        try {
            $res = $client->request('POST', $url);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiOne($url, $params)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_ONE', url('/')).'/'.$url;

        try {
            $res = $client->request('POST', $url, ['form_params' => $params]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiOneForBooking($url, $params)
    {
        $client = new Client(['verify' => false]);
        $url = env('API_DOMAIN_URL_ONE', url('/')).'/'.$url;

        try {
            $res = $client->request('POST', $url, ['form_params' => $params]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function getDataApiTwo($url)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_TWO', url('/')).'/'.$url;
        try {
            $res = $client->request('GET', $url,[
                'headers' => [
                    'app_key' => '123456',
                    'Accept' => 'application/json',
                    ],
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'verify' => false
            ]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiTwo($url, $params)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_TWO', url('/')).'/'.$url;

        try {
            $res = $client->request('POST', $url, [
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'headers' => [
                    'app_key' => '123456',
                    'Accept' => 'application/json',
                ],
                'form_params' => $params]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function putDataApiTwo($url, $params)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_TWO', url('/')).'/'.$url;

        try {
            $res = $client->request('PUT', $url, [
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'headers' => [
                    'app_key' => '123456',
                    'Accept' => 'application/json',
                ],
                'form_params' => $params]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function getDataApiThree($url)
    {
        $client = new Client();
        $url = env('API_DOMAIN_URL_THREE', url('/')).'/'.$url;
        try {
            $res = $client->request('GET', $url,[
                'headers' => [
                    'app_key' => '123456',
                    'Accept' => 'application/json',
                ],
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'verify' => false
            ]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiThree($url, $params)
    {
        $client = new Client(['verify' => false]);
        $url = env('API_DOMAIN_URL_THREE', url('/')).'/'.$url;
        try {
            $res = $client->request('POST', $url, [
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json'     => $params
            ]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }

    public function postDataApiFour($url, $params)
    {
        $client = new Client(['verify' => false]);
        $url = env('API_DOMAIN_URL_FOUR', url('/')).'/'.$url;

        try {
            $res = $client->request('POST', $url, [
                'timeout' => env('API_CALL_TIMEOUT', 120),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json'     => $params
            ]);
            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            $data['status_code'] = $e->getCode();
            $data['status']     = 'error';
            $data['messages'] = $e->getMessage();
            $result = response()->json($data);
            return json_decode($result->getContent());
        }
    }
}
