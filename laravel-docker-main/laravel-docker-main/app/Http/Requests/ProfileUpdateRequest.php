<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string','max:255'],
            'middle_name' => ['nullable', 'string','max:255'],
            'last_name' => ['required', 'string','max:255'],
            'gender' => ['required', 'string','max:255'],
            'age' => ['required', 'integer'],
            'birthdate' => ['required', 'date'],
            'address_line_1' => ['required', 'string','max:255'],
            'address_line_2' => ['required', 'string','max:255'],
            'city' => ['required', 'string','max:255'],
            'barangay' => ['required', 'string','max:255'],
            'zip_code' => ['required', 'string','max:10'],
            'civil_status' => ['required', 'string','max:255'],
            'religion' => ['nullable', 'string','max:255'],
            'spouse_name' => ['nullable', 'string','max:255'],
            'siblings_name' => ['nullable', 'string','max:255'],
            'children_name' => ['nullable', 'string','max:255'],
            'valid_id' => ['required', 'string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'email' => [
            //     'required',
            //     'string',
            //     'lowercase',
            //     'email',
            //     'max:255',
            //     Rule::unique(User::class)->ignore($this->user()->id),
            // ],
        ];
    }
}
