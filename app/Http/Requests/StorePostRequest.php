<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;

        //return $this->user()->can('create', Post::class);
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title for your post.',
            'price.numeric' => 'Please enter a valid price for your post.',
            'images.*.max' => 'The image must be less than 2MB in size.',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'subcategory_id' => 'required|numeric|exists:subcategories,id',
            'subsubcategory_id' => 'required|numeric|exists:subsubcategories,id',
            'images.*' => 'image|max:2048',
        ];
    }
}
