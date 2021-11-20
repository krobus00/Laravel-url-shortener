<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestStoreUrlRequest extends FormRequest
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
            'target' => 'required|url',
            'custom_key' => 'nullable|unique:urls,custom_key'
        ];
    }
    public function validated()
    {
        return array_merge(parent::validated(), [
            'user_id' => null,
        ]);
    }
}
