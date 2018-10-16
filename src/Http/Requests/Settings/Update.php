<?php

namespace SEO\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', $this->route('setting'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key ' => 'required|unique:seo_settings,key|max:255',
            'value ' => 'nullable|max:255',
            'status ' => 'required|max:255',
            'group ' => 'nullable|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }

}
