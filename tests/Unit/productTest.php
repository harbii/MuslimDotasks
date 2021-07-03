<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\product;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;

class productTest extends TestCase {

    // use RefreshDatabase ;
    use WithFaker ;

    /**
     * get route register orlogin by phone for test
     * 
     * @return string
    */
    public function routeCreateProduct( ) : string {
        return route( 'api.product.create' ) ;
    }

    public function test_product_create( ) {

        // test if Request empty 
        $this
            -> postJson     ( $this -> routeCreateProduct( )      )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'colors' => [ 'The colors field is required.' ] ]
            ] )
        ;

        // test if colors is not strings
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [ 'colors' => [ 10 ] ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'colors.0' => [ 'The colors.0 must be a string.' ] ]
            ] )
        ;

        // test if sizes is not array 
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'sizes'  => 'large'                         ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'sizes' => [ 'The sizes must be an array.' ] ]
            ] )
        ;

        // test if sizes is not array of strings
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'sizes'  => [ 1                           ] ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'sizes.0' => [ 'The sizes.0 must be a string.' ] ]
            ] )
        ;

        // test if types is not array 
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'types'  => 'large'                         ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'types' => [ 'The types must be an array.' ] ]
            ] )
        ;

        // test if sizes is not array of strings
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'types'  => [ 1                           ] ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'types.0' => [ 'The types.0 must be a string.' ] ]
            ] )
        ;

        // test if prices is not array 
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'prices'  => 'large'                         ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'prices' => [ 'The prices must be an array.' ] ]
            ] )
        ;

        // test if prices is not array of intgers 
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'prices' => [ 'ascsac'                    ] ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'prices.0' => [ 'The prices.0 must be an integer.' ] ]
            ] )
        ;

        // test if prices is duplicate value 
        $this
            -> postJson     ( $this -> routeCreateProduct( ) , [
                'colors' => [ $this -> faker -> colorName ] ,
                'prices' => [ 10 , 10                     ] ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'prices.0' => [ 'The prices.0 field has a duplicate value.' ] ]
            ] )
        ;

        // test create success by only one color
        $this
            -> postJson            ( $this -> routeCreateProduct( ) , [ 'colors' => [ $this -> faker -> colorName ] ] )
            -> assertStatus        ( Response::HTTP_CREATED )
            -> assertJsonStructure ([ 'id' ])
        ;

        // test create success
        $this
            -> postJson            ( $this -> routeCreateProduct( ) , [
                'colors' => [
                    $this -> faker -> colorName ,
                    $this -> faker -> colorName
                ] ,
                'sizes'  => [ 'large' , 'medium'    , 'small'     ] ,
                'types'  => [ 'Coton' , 'Polyester'               ] ,
                'prices' => [ 100     , 110         , 120         ] ,
            ] )
            -> assertStatus        ( Response::HTTP_CREATED )
            -> assertJsonStructure ( [ 'id' ]               )
            -> assertJsonCount     ( 2 , 'colors'           )
            -> assertJsonCount     ( 3 , 'sizes'            )
            -> assertJsonCount     ( 2 , 'types'            )
            -> assertJsonCount     ( 3 , 'prices'           )
        ;

    }

}
