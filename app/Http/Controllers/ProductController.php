<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\createProductRequest;
use App\Http\Requests\SearchProductRequest;
use App\Http\Services\ProductService;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller {

    private $ProductService;

    public function __construct( ProductService $ProductService ) {
        $this -> ProductService = $ProductService ;
    }

    public function create( createProductRequest $request ) {
        return response( ) -> json( $this -> ProductService -> CreateNewProduct( $request ) , Response::HTTP_CREATED ) ;
    }

    public function search( SearchProductRequest $request ) {
        return response( ) -> json( $this -> ProductService -> SearchNewProduct( $request ) , Response::HTTP_OK ) ;
    }

    public function find( Int $id ) {
        return response( ) -> json( $this -> ProductService -> find( $id ) , Response::HTTP_OK ) ;
    }

}
