<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProductRequest extends FormRequest {

    public function rules( ) : array {
        return [
            'colors'   => 'required|array'   ,
            'sizes'    => 'array'            ,
            'types'    => 'array'            ,
            'prices'   => 'array'            ,
            'colors.*' => 'string|distinct'  ,
            'sizes.*'  => 'string|distinct'  ,
            'types.*'  => 'string|distinct'  ,
            'prices.*' => 'integer|distinct' ,
        ];
    }

}
