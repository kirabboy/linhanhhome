<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BuildingRequest extends FormRequest
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
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'type_water' => ['required'],
                'price_room' => ['required', 'integer'],
                'number_floor' => ['required', 'integer', 'min:1'],
                'address' => ['required', 'string', 'max:255'],
                'owner' => ['required', 'string', 'max:255'],
                'owner_phone' => ['required', 'string', 'max:255'],
                'owner_email' => ['required', 'email', 'string', 'max:255'],
            ];
        }
        elseif($this->method() == 'PUT'){
            return [
                'id' => ['required', 'exists:App\Models\Building,id'],
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'price_room' => ['required', 'integer'],
                'number_floor' => ['required', 'integer', 'min:1'],
                'address' => ['required', 'string', 'max:255'],
                'owner' => ['required', 'string', 'max:255'],
                'owner_phone' => ['required', 'string', 'max:255'],
                'owner_email' => ['required', 'email', 'string', 'max:255'],
            ];
        }
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
