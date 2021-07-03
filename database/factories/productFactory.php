<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\variables;
use Illuminate\Database\Eloquent\Factories\Factory;

class productFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition( ) { return [ ] ; }

    public function configure( ) { return $this
        -> afterCreating( function ( product $product ) {
            $product -> addColors ( [ $this -> faker -> colorName , $this -> faker -> colorName ] );
            if( $this -> faker -> boolean( ) ) $product -> addSizes ( [ $this -> faker -> randomElement ( [ 'large' , 'medium' , 'small' ] ) ] );
            if( $this -> faker -> boolean( ) ) $product -> addTypes ( [ $this -> faker -> randomElement ( [ 'Coton' , 'Polyester' ]        ) ] );
            if( $this -> faker -> boolean( ) ) $product -> addPrices( [ $this -> faker -> randomNumber  (                                  ) ] );
        }
    ); }

}