<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest {

    public function rules( ) : array {
        return [
            'colors'   => 'array'            ,
            'sizes'    => 'array'            ,
            'types'    => 'array'            ,
            'prices'   => 'array'            ,
            'colors.*' => 'string|distinct'  ,
            'sizes.*'  => 'string|distinct'  ,
            'types.*'  => 'string|distinct'  ,
            'prices.*' => 'integer|distinct' ,
            'first'    => 'integer'          ,
            'page'     => 'integer'          ,
        ];
    }

}
