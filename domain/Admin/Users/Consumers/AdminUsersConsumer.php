<?php

namespace Domain\Admin\Users\Consumers;

use App\Services\Http\RequestBuilder;
use Illuminate\Support\Facades\Auth;

class AdminUsersConsumer
{
    private $baseUrl = null;

    public function __construct()
    {
        $this->baseUrl = env('APP_API_URL','s');
    }

    public function filterList( $filters = [])
    {
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/admin' ,
                                            "GET" , 
                                            ["filters" => $filters ],  
                                            [ 'Authorization' => 'Bearer '.Auth::user()->token ]
                                        );
        return  json_decode( $requestApi->send() );
    }

    public function getById( $id )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/admin/edit/'.$id ,
            "GET" , 
            [],
            [ 'Authorization' => 'Bearer '.Auth::user()->token ]  
        );
        return  json_decode( $requestApi->send() );
    }

    public function update( $params )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/admin/edit' ,
            "POST" , 
            [ $params ],
            [ 'Authorization' => 'Bearer '.Auth::user()->token ]  
        );
        return  json_decode( $requestApi->send() );
    }

    public function insert( $params )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/admin/new' ,
            "POST" , 
            [ $params ],
            [ 'Authorization' => 'Bearer '.Auth::user()->token ]  
        );
        return  json_decode( $requestApi->send() );
    }

    public function exclude( $params )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/admin/remove' ,
            "POST" , 
            [ $params ],
            [ 'Authorization' => 'Bearer '.Auth::user()->token ]  
        );
        return  json_decode( $requestApi->send() );
    }

    public function getStatus()
    {
        return $this->status;
    }


}
