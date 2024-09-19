<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Client;

class UpdateClientRequest extends FormRequest
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
            'contact_name' => ['required'],
            'contact_email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Client::class)->ignore($this->client)],
            'contact_phone_number' => ['required'],
            'company_name' => ['required'],
            'company_address' => ['required'],
            'company_city' => ['required', 'string'],
            'company_zip' => ['required', 'integer'],
            'company_vat' => ['required', 'numeric'],
        ];
    }
}
