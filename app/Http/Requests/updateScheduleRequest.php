<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'saturday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->saturday2))],
            'saturday2' => ['nullable', 'date_format:H:i', 'after:saturday1', Rule::requiredIf(!is_null($this->saturday1))],
            'sunday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->sunday2))],
            'sunday2' => ['nullable', 'date_format:H:i', 'after:sunday1', Rule::requiredIf(!is_null($this->sunday1))],
            'monday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->monday2))],
            'monday2' => ['nullable', 'date_format:H:i', 'after:monday1', Rule::requiredIf(!is_null($this->monday1))],
            'tuesday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->tueday2))],
            'tuesday2' => ['nullable', 'date_format:H:i', 'after:tuesday1', Rule::requiredIf(!is_null($this->tuesday1))],
            'wednesday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->wednesday2))],
            'wednesday2' => ['nullable', 'date_format:H:i', 'after:wednesday1', Rule::requiredIf(!is_null($this->wednesday1))],
            'thursday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->thursday2))],
            'thursday2' => ['nullable', 'date_format:H:i', 'after:thursday1', Rule::requiredIf(!is_null($this->thursday1))],
            'friday1' => ['nullable', 'date_format:H:i', Rule::requiredIf(!is_null($this->friday2))],
            'friday2' => ['nullable', 'date_format:H:i', 'after:friday1', Rule::requiredIf(!is_null($this->friday1))],
        ];
    }
}
