<?php

namespace App\Users;

use App\Services\Http\RequestBuilder;

class UserConsumer
{
    private $token = null;
    private $baseUrl = null;

    public function __construct()
    {
        $this->baseUrl = env('APP_API_URL','s');
    }

    public function doLoginAndGetUserByEmailPassword( $email , $password )
    {
        $token = json_decode( $this->doLoginAndGetToken($email , $password ) , 1 );
        return $this->getUserJsonByToken( $token['token'] );
    }

    public function doLoginAndGetToken( $email , $password )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api-auth/get-token' ,
            "POST" , 
            [ 'email' => $email , 'password' => $password ],
            []  
        );
        return  $requestApi->send();
    }

    public function getUserJsonByToken( $token )
    { 
        $requestApi = new RequestBuilder( $this->baseUrl.'/api/v1/user/current' ,
            "POST" , 
            [],
            [ 'Authorization' => 'Bearer '.$token ]  
        );
        return  $requestApi->send();
    }


}