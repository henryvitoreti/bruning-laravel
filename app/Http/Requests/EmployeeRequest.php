<?php

namespace App\Http\Requests;

use App\Helpers\StringHelper;
use App\Models\Employee;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        if ($this->get('document') && $this->get('birth_date')) {
            $this->merge([
                'document' => StringHelper::onlyNumbers($this->get('document')),
                'birth_date' => StringHelper::formatDate($this->get('birth_date')),
            ]);
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return Employee::rules($this);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return Employee::messages($this);
    }
}
