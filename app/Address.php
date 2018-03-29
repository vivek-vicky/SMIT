<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Validation\Validator;
use Validator;
class Address extends Model
{
    protected $table = "Address";
    public $timestamps = false;

    public $rules = [
        'name' => 'required|min:2|max:50',
        'email' => 'required | email',
        'mobile' => 'required|digits:10'
    ];

    /*public function messages()
    {
        return [
            'name.required'    => 'name is empty.',
            'email.required'    => 'The Email is required',
            'email.email'       => 'Email Format is wrong',
            'mobile.required'   => 'Mobile number is required',
            'mobile.numeric'    => 'Mobile field should be Numeric',
            'mobile.min'        => 'Mobile number should be 10 characters',
            'name.min'          => 'Name should be at least 2 characters '
        ];
    }*/

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);
        // return the result
        if($v->fails())
        {
            return [
                'status'    => 'fail',
                'messages'  =>  $v->errors()
                //'messages'  =>  $v->messages()
                ];
        }
        else
        {
            return [
                'status'    => 'success',
                'messages'  =>  ''
            ];
        }
        //return $v->passes();
    }


}
