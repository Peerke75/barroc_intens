<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'malfunction_id' => 'required|exists:malfunctions,id',
            'storage_id' => 'required|exists:storages,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ];
    }
}
