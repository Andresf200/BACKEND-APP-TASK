<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TaskFileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.task_id' => [
                'required',
                'integer',
                Rule::exists('tasks', 'id'),
            ],
            'data.files' => ['array'],
            'data.files.*' => ['file', 'mimes:jpeg,png,pdf','max:2048'],
        ];
    }
}
