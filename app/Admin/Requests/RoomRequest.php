<?php

namespace App\Admin\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoomRequest extends FormRequest

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
                'code' => ['required','max:255'],
                'name' => ['required'],
                'name_blog' => ['required', 'unique:App\Models\Room,name_blog'],
                'building_id' => ['required'],
                'floor_id' => ['required'],
                'type' => ['required'],
                'acreage' => ['required'],
                ''
            ];
        }elseif($this->method() == 'PUT'){
            return [
                'code' => ['required','max:255'],
                'name' => ['required'],
                'type' => ['required'],
                'acreage' => ['required'],
                ''
            ];
        }
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            if (!Str::of($this->code)->isAscii() || strpos($this->code, ' ')) {
                $validator->errors()->add('code', 'Mã phòng không chứ các ký tự đặc biệt');
            }
        });
    }

    public function messages()
    {
        return [
            'code.required' => 'Mã phòng không được bỏ trống',
            'name.required' => 'Tên phòng không được bỏ trống',
            'price.required' => 'Giá phòng không được bỏ trống',
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
