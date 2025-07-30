<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait ValidateDoctor{
    /**
     * Summary of validateDoctor
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    // Work For Store , Update Doctors ; 
    public function validateDoctor(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:3',
            'phone' => 'required|string|max:15',
            'section_id' => 'required|exists:sections,id',
            'appointments' => 'required|array|min:1',
            'appointments.*' => 'string',
            // 'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    }
}