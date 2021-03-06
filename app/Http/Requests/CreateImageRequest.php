<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateImageRequest extends FormRequest
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
            'image_name' => [
                'max:191',
                'min:1',
                'unique:images',
                'regex:/^[A-Z][A-Za-z0-9_-]+/',
                'required'
            ],
            'file' => [
                'file',
                'max:2000',
                'mimetypes:image/gif,image/jpeg,image/png,image/svg+xml',
                'required'
            ]
        ];
    }
}
