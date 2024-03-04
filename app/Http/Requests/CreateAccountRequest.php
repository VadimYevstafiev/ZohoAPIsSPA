<?php

namespace App\Http\Requests;

use App\Rules\Account\Phone;
use App\Rules\Account\Website;
use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string',  'min:5', 'max:255'],
            'website' => ['required', 'string', new Website],
            'phone' => ['required', 'string', new Phone]
        ];
    }
}
