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
        return auth()->user()->can('update', $this->route('meta_tag'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|max:50|unique:seo_meta_tags,name,' . $this->route('meta_tag')->id,
            'property' => 'nullable|max:100|unique:seo_meta_tags,property,' . $this->route('meta_tag')->id,
            'status' => 'required|max:50',
            'group' => 'nullable|max:50',
            'input_type' => 'required|max:50',
            'input_help_text' => 'nullable|max:255',
            'input_placeholder' => 'nullable|max:255',
            'input_label' => 'nullable|max:255',
            'input_info' => 'nullable|max:255',
            'visibility' => 'required|max:50',
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
