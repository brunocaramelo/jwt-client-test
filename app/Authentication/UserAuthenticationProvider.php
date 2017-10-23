<?php

namespace App\Authentication;

use Illuminate\Contracts\Auth\UserProvider as IlluminateUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\Authenticatable as Authenticatable;
use App\Authentication\UserAuthentication;
use Illuminate\Auth\GenericUser;
use Session;
class UserAuthenticationProvider implements IlluminateUserProvider
{
    /**
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = new UserAuthentication();
        $ret = $user->getByToken( $user->getToken() );
        if( $ret === false) $user->sessionFlush();
        $ret->token = $user->getToken();
        return $this->getGenericUser( $ret );
    }

    /**
     * @param  mixed   $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // Get and return a user by their unique identifier and "remember me" token
    }

    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Save the given "remember me" token for the given user
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // Get and return a user by looking up the given credentials
        $user = new UserAuthentication();
        $ret = $user->getByEmailAndPassword( $credentials['email'] , $credentials['password'] );
        
        return $this->getGenericUser( $ret );
     }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Check that given credentials belong to the given user
        $user = new UserAuthentication();
        $ret = $user->getByToken( $user->getToken() );
        if( $ret === false) return false;
        return !empty( $this->getGenericUser( $ret  ) );
    }

    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }

}