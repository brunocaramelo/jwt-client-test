<?php

namespace App\Builders;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;


class RequestBuilder
{

    private $client = null;
    private $method = null;
    private $auth = null;
    private $headers = [];
    private $body = [];
    private $status = null;
    private $response = null;

    public function __construct( $url , $method , $body = [] , $headers = [] , $auth = null )
    {
        $this->client = new Client();
        $this->url = $url;
        $this->method = $method;
        $this->auth = $auth;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function setUrl( $url )
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setMethod( $method )
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }
    
    public function setAuth( $auth )
    {
        $this->auth = $auth;
    }

    public function getAuth()
    {
        return $this->auth;
    }

    public function setBody( $body )
    {
        $this->body = $body;
    }

    public function setHeaders( $headers )
    {
        $this->headers = $headers;
    }

    
    public function getStatus()
    {
        return $this->status;
    }
    public function getBodyReturn()
    {
        return $this->body;
    }
    
    private function createRequest()
    {
        if( strtoupper( $this->method ) == 'POST')
        {
            return $this->post();
        }
        if( strtoupper( $this->method ) == 'GET')
        {
            return $this->get();
        }

     }

    private function post()
    {
        return $this->client->post(  $this->url , [
                                                    'form_params' => [
                                                                     $this->body
                                                                     ]
                                                    ,
                                                        'headers' => $this->headers,
                                                        'exceptions' => false
                                                    ]);
    }
    private function get()
    {   
        return $this->client->get(  $this->url , [  $this->body
                                                    ,
                                                        'headers' => $this->headers,
                                                        'exceptions' => false
                                                    ]);
    }

    public function send()
    {
        $this->response =  $this->createRequest();
        $this->status =  $this->response->getStatusCode();
        return (string) $this->response->getBody();
       
    }

}
