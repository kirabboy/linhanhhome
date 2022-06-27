<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CustomerRequest extends FormRequest
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
                'fullname' => ['required', 'max:255'],
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
                'email' => ['max:255'],
                'birthday' => ['required'],
                'job' => ['required'],
                'gender' => ['required', Rule::in(collect(config('custom.customer.gender'))->keys()->all())],
                'identification_number' => ['required', 'max:255'],
                'identification_place' => ['required', 'max:255'],
                'identification_time' => ['required'],
                'identification_address' => ['required', 'max:255'],
            ];
        }elseif($this->method() == 'PUT'){
            return [
                'id' => ['required', 'exists:App\Models\Customer,id'],
                'code' => ['required'],
                'fullname' => ['required', 'max:255'],
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
                'email' => ['max:255'],
                'birthday' => ['required'],
                'job' => ['required'],
                'gender' => ['required', Rule::in(collect(config('custom.customer.gender'))->keys()->all())],
                'identification_number' => ['required', 'max:255'],
                'identification_place' => ['required', 'max:255'],
                'identification_time' => ['required'],
                'identification_address' => ['required', 'max:255'],
            ];
        }
    }
    public function attributes()
    {
        return [
            'phone' => 'Số điện thoại'
        ];
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
