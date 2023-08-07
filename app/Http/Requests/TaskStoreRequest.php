<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.title' => ['required','string','max:255'],
            'data.description' => ['required','string','max:255'],
            'data.date_start' => ['required','date_format:Y-m-d','date'],
            'include.checklists.*' => ['string','max:255'],
            'include.files' => ['array'],
            'include.files.*' => ['file', 'mimes:jpeg,png,pdf','max:2048'],
        ];
    }
}
