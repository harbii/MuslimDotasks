<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model {

    use HasFactory;

	protected $appends = [
		'colors' ,
		'sizes'  ,
		'types'  ,
		'prices' ,
	] ;

	public function variables( ) {
		return $this -> hasMany( variable::class );
	}

	public function getcolorsAttribute( ) {
		return $this -> variables( ) -> where( 'key' , 'color' ) -> get( ) -> pluck( 'value' );
	}

	public function getsizesAttribute( ) {
		return $this -> variables( ) -> where( 'key' , 'size' ) -> get( ) -> pluck( 'value' );
	}

	public function gettypesAttribute( ) {
		return $this -> variables( ) -> where( 'key' , 'type' ) -> get( ) -> pluck( 'value' );
	}

	public function getpricesAttribute( ) {
		return $this -> variables( ) -> where( 'key' , 'price' ) -> get( ) -> pluck( 'value' );
	}

	public function addVariables( string $key , array $values ) : static {
		foreach ( $values as $value ) $this -> variables( ) -> create( [ 'key' => $key , 'value' => $value ] ) ;
		return $this -> refresh( ) ;
	}

	public function addColors( array $values ) : static {
		return $this -> addVariables( 'color' , $values ) ;
	}

	public function addSizes( array $values ) : static {
		return $this -> addVariables( 'size' , $values ) ;
	}

	public function addTypes( array $values ) : static {
		return $this -> addVariables( 'type' , $values ) ;
	}

	public function addPrices( array $values ) : static {
		return $this -> addVariables( 'price' , $values ) ;
	}

}