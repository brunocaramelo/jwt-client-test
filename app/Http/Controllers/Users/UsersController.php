<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Consumer\AdminUsersConsumer;

class UsersController extends Controller
{
    
    public function __construct()
    {
    }

    public function index( Request $request ) 
    {
        $user = new AdminUsersConsumer();
        $list = $user->filterList( $request );
        return view( 'users.index' , [ 'users' => $list ] );
    }

    public function edit( Request $request ) 
    {   
        $user = new AdminUsersConsumer();
        $edit = $user->getById( $request->id );
        return view( 'users.edit' , [ 'user' => $edit, ] );
    }

    public function update( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            $user = new AdminUsersConsumer();
            $edit = $user->update( $request->all() );
            if( $edit->status != 200 ) 
                throw new \Exception( $edit->message );
            $return['message'] = 'Usuario editado com suceso';
            return response()->json( $return );
        }catch( \Exception $error ){
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

    public function add( Request $request ) 
    {   
        return view( 'users.new' );
    }

    public function insert( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            $user = new AdminUsersConsumer();
            $edit = $user->insert( $request->all() );
            if( $edit->status != 200 ) 
                throw new \Exception( $edit->message );
            $return['message'] = 'Usuario criado com suceso';
            return response()->json( $return );
        }catch( \Exception $error ){
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

    public function exclude( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            $user = new AdminUsersConsumer();
            $edit = $user->exclude( $request->all() );
            if( $edit->status != 200 ) 
                throw new \Exception( $edit->message );
            $return['message'] = 'Usuario removido com suceso';
            return response()->json( $return );
        }catch( \Exception $error ){
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

}