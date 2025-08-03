<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
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
            'name'=>['required','string'],
            'insurance_code'=>['required','string'],
            'insurance_discount'=>['required'],
            'patient_discount'=>['required'],
            'notes'=>['required','string']
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Name is required',
            'insurance_code.required'=>'Code is required',
        ];
    }
}
