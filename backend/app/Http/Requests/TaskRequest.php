<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|numeric|digits_between:1,20',
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:500',
            'completed_at' => 'nullable'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->completed_at) {
            $this->merge([
                'completed_at' => now(),
            ]);
        } else {
            $this->merge([
                'completed_at' => '',
            ]);
        }
    }
}
