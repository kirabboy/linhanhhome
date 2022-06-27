<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AccountRequest extends FormRequest
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
                'username' => ['required', 'max:255', 'unique:App\Models\Admin,username'],
                'password' => ['required', 'max:255'],
                'gender' => ['required', Rule::in(collect(config('custom.user.gender'))->keys()->all())],
                'role' => ['required']
            ];
        }elseif($this->method() == 'PUT'){
            return [
                'id' => ['required', 'exists:App\Models\Admin,id'],
                'username' => ['required', 'max:255', 'unique:App\Models\Admin,username,'.$this->id],
                'gender' => ['required', Rule::in(collect(config('custom.user.gender'))->keys()->all())],
                'role' => ['required']
            ];
        }
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if (!Str::of($this->username)->isAscii() || strpos($this->username, ' ')) {
                $validator->errors()->add('username', 'Không chứ các ký tự đặc biệt');
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
