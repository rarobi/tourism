<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

/**
 * Description of ApiController
 *
 * @author nasirkhan
 */
class ApiController extends Controller
{

    /**
     * Status Code
     *
     * @var INT
     */
    protected $statusCode = 200;
    protected $redisErrorCode = [111,10061];

    /**
     * Get the status code
     *
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * Get the redis error code
     *
     * @return array
     */
    public function getRedisErrorCode() {
        return $this->redisErrorCode;
    }

    /**
     * Set the Status Code
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondNotFound($message = 'Not Found!') {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respond($data, $headers = []) {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message) {
        return $this->respond([
            'error' => [
                'message' => "$message",
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Respond to the Successfl POST request
     *
     * @param type|string $message
     * @return type
     */
    public function respondCreated($message = 'Created Successfully!') {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            'message' => $message,
        ]);
    }

    public function paginatorData($paginator,$platform){
        return [
            'current_page'          => $paginator->currentPage(),
            'total_pages'           => $paginator->lastPage(),
            'previous_page_url'     => ($paginator->previousPageUrl()==null)?null:$paginator->previousPageUrl().$platform,
            'next_page_url'         => ($paginator->nextPageUrl()==null)?null:$paginator->nextPageUrl().$platform,
            'record_per_page'       => $paginator->perPage()

        ];
    }

    public function getCollection(Request $request, $moduleQuery, $queryString = '', $limit = 50)
    {
        $collection = [];

        if($request->has('limit')) {
            if($request->input('limit') <= 100) {
                $limit = (int) $request->input('limit');
            } else {
                $limit = 10;
            }
        }

        if ($request->has('platform') && $request->input('platform') == 'web') {
            $collection['data'] = $moduleQuery->paginate($limit);

            $platform = '&platform=web';

            $queryString = $queryString . $platform . '&limit=' . $limit;

            $collection['paginator'] = $this->paginatorData($collection['data'], $queryString);
        } else {
            $collection['data'] = $moduleQuery->get();
        }

        return (object) $collection;
    }



    // generate token for email verification

    public function generateEmailToken() {
        $val    =   null;
        $val    = bin2hex(random_bytes(10));
        if(is_null($val) || $val == '')
        {
            $this->generateEmailToken();
        }
        return $val;
    }
}
