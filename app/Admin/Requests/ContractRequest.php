<?php

namespace App\Admin\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContractRequest extends FormRequest
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
        if($this->method() == 'POST'){

            return [
                'code' => ['required'],
                'name' => ['required'],
                'time_start' => ['required'],
                'time_end' => ['required'],
                'time_charge' => ['required'],
                'price_room' => ['required'],
                'price_electric' => ['required'],
                'price_water' => ['required'],
                'type_water' => ['required'],
                'price_service' => ['required'],
                'number_room' => ['required'],
                'number_electric' => ['required'],
                'number_water' => ['required'],
                'number_service' => ['required'],
                'customer_ids' => ['required'],
            ];
        }elseif($this->method() == 'PUT'){
            return [
            'name' => ['required'],
            'time_start' => ['required'],
            'time_end' => ['required'],
            'time_charge' => ['required'],
            'price_room' => ['required'],
            'price_electric' => ['required'],
            'price_water' => ['required'],
            'type_water' => ['required'],
            'price_service' => ['required'],
            'number_room' => ['required'],
            'number_electric' => ['required'],
            'number_water' => ['required'],
            'number_service' => ['required'],
            'customer_ids' => ['required'],
            ];
        }

    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if (!Str::of($this->username)->isAscii() || strpos($this->username, ' ')) {
                $validator->errors()->add('code', 'Không chứ các ký tự đặc biệt');
            }
        });
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if($this->ajax()){
            throw new HttpResponseException(
                response()->json([
                    'status' => 416,
                    'message' => $errors], 416
                )
            );
        }else{
            throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
        }
    }
}
