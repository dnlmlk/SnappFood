<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'saturday1' => 'nullable|integer|min:0|max:24',
            'saturday2' => $this->saturday1 == null ? 'nullable' : 'required' . "|integer|min:" . $this->saturday1+1 . "|max:24",
            'sunday1' => 'nullable|integer|min:0|max:24',
            'sunday2' => $this->sunday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->sunday1+1 . '|max:24',
            'monday1' => 'nullable|integer|min:0|max:24',
            'monday2' => $this->monday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->monday1+1 . '|max:24',
            'tuesday1' => 'nullable|integer|min:0|max:24',
            'tuesday2' => $this->tuesday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->tuesday1+1 . '|max:24',
            'wednesday1' => 'nullable|integer|min:0|max:24',
            'wednesday2' => $this->wednesday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->wednesday1+1 . '|max:24',
            'thursday1' => 'nullable|integer|min:0|max:24',
            'thursday2' => $this->thursday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->thursday1+1 . '|max:24',
            'friday1' => 'nullable|integer|min:0|max:24',
            'friday2' => $this->friday1 == null ? 'nullable' : 'required' . '|integer|min:' . $this->friday1+1 . '|max:24',
        ];
    }
}
