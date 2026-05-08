<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'sku' => 'required|string|unique:products,sku,' . $productId,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:50',
            'minimum_stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ];
    }
}
