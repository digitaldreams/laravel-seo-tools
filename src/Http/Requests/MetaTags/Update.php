<?php

namespace SEO\Http\Requests\MetaTags;

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
            'name ' => 'nullable|unique:seo_meta_tags,name|max:50',
            'property ' => 'nullable|unique:seo_meta_tags,property|max:100',
            'status ' => 'required|max:50',
            'group ' => 'nullable|max:50',
            'input_type ' => 'required|max:50',
            'input_help_text ' => 'nullable|max:255',
            'input_placeholder ' => 'nullable|max:255',
            'input_label ' => 'nullable|max:255',
            'input_info ' => 'nullable|max:255',
            'visibility ' => 'required|max:50',
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
