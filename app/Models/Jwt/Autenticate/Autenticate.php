<?php

namespace App\Models\Jwt\Autenticate;
use Tymon\JWTAuth\Exceptions\JWTException;

class Autenticate
{
    private $email = null;
    private $password = null;
    private $token  = null;
    private $error = null;

    public function __construct( $email , $password )
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function check()
    {
        try {
            $user = \App\Entities\User::first();
            
            $token = \JWTAuth::fromUser($user);

            // $token = \JWTAuth::attempt( [ 'email' => $this->email , 
            //                                      'password' => $this->password ] );
            if ( $token === false ) {
                throw new JWTException('Dados do Usuário não encontrados');
            }
            $this->token = $token;
        } catch ( JWTException $e ) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getError()
    {
        return $this->error;
    }
}