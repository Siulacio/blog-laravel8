<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:140',
                Rule::unique('projects', 'name')->ignore(request('project')),
            ],
            'description' => 'nullable|string|min:10'
        ];
    }
}
