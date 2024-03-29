<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;//kimlik doğrulamada true yapman gerekir yoksa çalışmaz, false iken yetkisiz giriş olarak algılıyor
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
//    public function rules(): array
//    {
//       if ($this->method()=="post"){
//           if ($this->category_id){
//               return [
//                   'category_name' => 'required|string|max:50|min:3',
//                   'category_id' => 'exists:\App\Models\Category,id'
//               ];
//           }else{
//               return [
//                   'category_name' => 'required|string|max:50|min:3',
//
//               ];
//           }
//
//       }
//       elseif ($this->method()=='PUT'){
//           return [
//               'category_name' => 'required|string|max:50|min:3',
//           ];
//       }
//       return [];
//    }
//
//    public function messages()
//    {
//        return ['required' => ":attribute zorunludur.", 'max' => ':attribute karakter sınırını aştı.', 'min' => ':attribute karakter sınırın altında.'];
//
//    }
//
//    public function attributes()
//    {
//        return ['category_name' => "Kategori adı", 'category_id' => 'Üst kategori'];
//    }
    public function rules()
    {
        if ($this->method() == "POST") {
            if ($this->category_id) {
                return [
                    'category_name' => 'required|string|max:50|min:3',
                    'category_id' => 'exists:\App\Models\Category,id'
                ];
            } else {
                return [
                    'category_name' => 'required|string|max:50|min:3',
                ];
            }

        } else if ($this->method() == 'PUT') {
            return [
                'category_name' => 'required|string|max:50|min:3',
            ];
        }

        return [function (string $attribute, mixed $value, Closure $fail) {
            $fail("Kural dısı istek kabul edilemez."); //kapatma eylemi hata olarak döndürülüyor
        }];

    }

    public function messages()
    {
        return ['required' => ":attribute zorunludur.",
            'exists' => ':attribute bulunamadı.',
            'min' => ':attribute karakter sınırının altında.',
            'max' => ':attribute karakter sınırını aştı.'];
    }

    public function attributes()
    {
        return ['category_name' => "Kategori adı",
            'category_id' => 'Üst kategori'];
    }
}
