<?php

namespace App\Authentication\User;

use Session;
use App\Users\Consumers\UserConsumer;
use Illuminate\Contracts\Auth\Authenticatable as Authenticatable;

class UserAuthentication implements Authenticatable
{
    private $token = null;
    public function getAuthIdentifierName()
    {
        // Return the name of unique identifier for the user (e.g. "id")
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // Return the unique identifier for the user (e.g. their ID, 123)
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        // Returns the (hashed) password for the user
    }

    /**
     * @return string
     */
    public function setToken( $token )
    {   
        Session::forget('token_session');
        $this->token = $token;
        Session::put( 'token_session' ,  $token ) ;
    }

    public function sessionFlush()
    {
       return Session::flush();
    }
    
    public function getToken()
    {
       return Session::get( 'token_session' );
    }

    public function getRememberToken()
    {
        // Return the token used for the "remember me" functionality
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Store a new token user for the "remember me" functionality
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        // Return the name of the column / attribute used to store the "remember me" token
    }

    public function getByEmailAndPassword( $email , $password )
    {
        try{
            $requestUser = new UserConsumer();
            
            $this->setToken( json_decode($requestUser->doLoginAndGetToken($email ,
                                                                          $password),1)['token']);
           
            return json_decode( $requestUser->getUserJsonByToken( $this->token ) );
        }catch( \Exception $e ){
             return false;
        }
    }
    public function getByToken( $token )
    {
        try{
            $requestUser = new UserConsumer();
            
           return json_decode( $requestUser->getUserJsonByToken( $token ) );
        }catch( \Exception $e ){
            return false;
        }
    }


}