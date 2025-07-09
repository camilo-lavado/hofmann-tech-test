<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sendUserRequest extends FormRequest
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
            'id' => ['required', 'integer'],
            'code' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El ID es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'code.required' => 'El código es obligatorio.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser un número.',
            'amount.min' => 'El monto debe ser mayor o igual a 0.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'El formato de la fecha no es válido.',
        ];
    }
}
