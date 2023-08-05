<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.title' => ['string','max:255'],
            'data.description' => ['string','max:255'],
            'data.date_start' => ['date_format:Y-m-d H:i:s','date'],
        ];
    }
}
