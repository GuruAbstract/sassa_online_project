<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTrack extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderid'=>'required',
      'orderstatus'=>'required',
      'comment'=>'required'
        ];
    }

    public function messages()
    {
        return
             ['orderid.required'=>'Order Number Required--->',
            'orderstatus'=>'Please indicate the status of this order',
            'comment.required'=>'Please enter the comment'];
    }
}
