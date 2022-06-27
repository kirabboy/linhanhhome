<?php

namespace App\Admin\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceRequest extends FormRequest
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
                'id_contract' => ['required'],
                'code' => ['required'],
                'name' => ['required'],
                'date_create' => ['required'],
                'date_expired' => ['required'],
                'amount_room' => ['required'],
                'amount_electric' => ['required'],
                'amount_water' => ['required'],
                'amount_service' => ['required'],
                'total' => ['required'],
                'amount_paid' => ['required'],
                'amount_rest' =>['required'],
                'code' => ['required'],
            ];
        }elseif($this->method() == 'PUT'){
            return [
                'id_contract' => ['required'],
                'code' => ['required'],
                'name' => ['required'],
                'date_create' => ['required'],
                'date_expired' => ['required'],
                'amount_room' => ['required'],
                'amount_electric' => ['required'],
                'amount_water' => ['required'],
                'amount_service' => ['required'],
                'total' => ['required'],
                'amount_paid' => ['required'],
                'amount_rest' =>['required'],
                'code' => ['required'],
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
