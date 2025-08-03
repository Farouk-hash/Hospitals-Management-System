<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceValidatedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['string', 'required'],
            'price' => ['required', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
        ];
    }

    public function message(){
        return [
            'name'=>'Not a valid name'
        ];
    }
}
