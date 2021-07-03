<?php

namespace App\Http\Services;

use App\Models\product;
use App\Models\variable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService {

    public function CreateNewProduct( Request $request ) : product {
        $product = product::create( ) ;
        if( $request -> has ( 'colors' ) ) $product -> addColors ( $request -> get ( 'colors' ) ) ;
        if( $request -> has ( 'sizes'  ) ) $product -> addSizes  ( $request -> get ( 'sizes'  ) ) ;
        if( $request -> has ( 'types'  ) ) $product -> addTypes  ( $request -> get ( 'types'  ) ) ;
        if( $request -> has ( 'prices' ) ) $product -> addPrices ( $request -> get ( 'prices' ) ) ;
        return $product ;
    }

    public function find( Int $id ) :? product {
        return product::find( $id ) ;
    }

    public function SearchNewProduct( Request $request ) : LengthAwarePaginator {
        $variableName = with ( new variable ) -> getTable( ) ;
        $product = product::query( ) -> Join ( $variableName , $variableName . '.product_id' , '=' , with ( new product ) -> getTable( ) . '.id' );
        if( $request -> has ( 'colors' ) ) $product -> orWhere( fn( $query ) => $query -> where( 'key' , 'color' ) -> whereIn( 'value' , $request -> get ( 'colors' ) ) ) ;
        if( $request -> has ( 'sizes'  ) ) $product -> orWhere( fn( $query ) => $query -> where( 'key' , 'size'  ) -> whereIn( 'value' , $request -> get ( 'sizes'  ) ) ) ;
        if( $request -> has ( 'types'  ) ) $product -> orWhere( fn( $query ) => $query -> where( 'key' , 'type'  ) -> whereIn( 'value' , $request -> get ( 'types'  ) ) ) ;
        if( $request -> has ( 'prices' ) ) $product -> orWhere( fn( $query ) => $query -> where( 'key' , 'price' ) -> whereIn( 'value' , $request -> get ( 'prices' ) ) ) ;
        return $product -> paginate(
            $request -> has ( 'first' ) ? $request -> get ( 'first' ) : 15 ,
            [ '*' ] ,
            'page' ,
            $request -> has ( 'page' ) ? $request -> get ( 'page' ) : 1
        ) ;
    }

}
