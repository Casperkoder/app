<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function GetCategories()
    {
        return view('category.list-categories');
    }

    public function CreateCategory(Request $request)
    {
        if ($request->category_id) {
            $rules['category_id'] = "exists:\App\Models\Category,id";
        }
        $rules["category_name"] = "required";
        $message = ['required' => ":attribute zorunludur.", 'exists' => ':attribute bulunamadı.'];
        $attribute = ['category_name' => "Kategori adı", 'category_id' => 'Üst kategori'];
        $request->validate($rules, $message, $attribute);

        $category = new Category();
        $category->name = $request->category_name;
        if ($request->category_id) {
            $category->category_id = $request->category_id;
        }
        $category->save();
        return back()->with([
            'alert' => 'sweet',
            'title' => 'İşlem başarılı',
            'text' => 'Yeni kategori eklendi!',
            'type' => 'success'
        ]);
    }

    public function GetOneCategory(int $category_id)
    {
        $category = Category::find($category_id);
        return view("category.category", compact('category'));
    }

    public function DeleteCategory(int $category_id)
    {
        $category = Category::find($category_id);
        if (!isset($category))
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarısız İşlem',
                'text' => 'Kategory bulunamadı',
                'type' => 'warning'
            ]);
        $url = "";
        if ($category->category_id) {
            $url = route('get-one-category', $category->category_id);
        } else {
            $url = route('categories');
        }
        $category->delete();
        return redirect($url)->with([
            'alert' => 'sweet',
            'title' => 'İşlem Başarılı',
            'text' => 'Kategori Silindi',
            'type' => 'success'
        ]);
    }

    public function UpdateCategory(Request $request, int $category_id)
    {
        $category = Category::find($category_id);
        if (!isset($category))
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarısız İşlem',
                'text' => 'Kategory bulunamadı',
                'type' => 'warning'
            ]);
        $rules["category_name"] = "required";
        $message = ['required' => ":attribute zorunludur."];
        $attribute = ['category_name' => "Kategori adı"];
        $request->validate($rules, $message, $attribute);

        $category->name=$request->category_name;
        $category->save();
        return back()->with([
            'alert'=>'sweet',
            'title'=>'İşlem başarılı',
            'text'=>'Kategori ismi değişti',
            'type'=>'success'
        ]);

    }

}








