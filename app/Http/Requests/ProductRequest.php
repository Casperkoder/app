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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //burada ifadelerimizin zorunlu belirtilmesi gereken durumlar
        return [
            'name'=>'required',
            'category_id'=>'required|exists:App\Models\Category,id',
            'detail'=>'required|min:5|max:20',
            'price'=>'required|numeric',
            'amount'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute zorunludur',
            'exists'=>':attribute bulunmamaktadır.'
        ];
    }
    public function attributes(){
        return[
            'category_id'=>'Kategori',
            'name'=>'Ürün adı',
            'detail'=>'Detaylar',
            'price'=>'Fiyatı',
            'amount'=>'Miktarı'
        ];
    }

}
