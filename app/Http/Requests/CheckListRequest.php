<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckListRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.id' => [
                Rule::requiredIf($this->route('checklist')),
                Rule::exists('checklists', 'id'),
            ],
            'data.item' => [
                'string',
                'max:250',
                'required'
            ],
            'data.task_id' => [
                'integer',
                Rule::requiredIf(! $this->route('checklist')),
                Rule::exists('tasks', 'id'),
                ]
        ];
    }
}
