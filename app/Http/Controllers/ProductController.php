<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\ProductProperties;
use App\Models\Product;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class ProductController extends Controller
{


    public function GetAllProducts(Request $request)
   {

      //  return view('product.list-products');
        $products = Product::where(function (Builder $builder) use ($request) {
            if ($request->alfabet) {
                $builder->where('name', 'like', "$request->alfabet%");
            }
        })->orderBy('id', 'desc')->paginate(5);

        //sayfa başı 10satır bilgi alabilecek şekilde çalıştırmak için
        $products->appends(['alfabet' => $request->alfabet]);

        return view('product.list-product', compact('products'));

    }

    public function CreateProduct(ProductRequest $request)
    {
//        $product = new Product();
//        $product->name = $request->name;
//        $product->detail = $request->detail;
//        $product->price = $request->price;
//        $product->amount = $request->amount;
//        $product->category_id = $request->category_id;
//        $product->save();

        $id = Product::insertGetId([
            'name' => $request->name,
            'detail' => $request->detail,
            'price' => $request->price,
            'amount' => $request->amount,
            'category_id' => $request->category_id
        ]);

        return redirect(route('get-one-product', $id))->with([
            'alert' => 'sweet',
            'title' => 'Başarılı',
            'text' => 'Yeni Ürün Eklendi',
            'type' => 'success'
        ]);


    }
    public function GetOneProduct(int $product_id)
    {
        $product = Product::find($product_id);
        if (!isset($product_id)) {
            return view('errors.404');
        }
        return view('product.product', compact('product'));

    }
//    public function GetProductProperty(int $product_id)
//    {
//        $products = Product::find($product_id);
//
//        return view('product.product-property', compact('products'));
//    }
    public function DeleteProduct(int $product_id)
    {
        $product = Product::find($product_id);
        if (!isset($product))
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarısız İşlem',
                'text' => 'Ürün bulunamadı',
                'type' => 'warning'
            ]);
        $url = "";
        if ($product->product_id) {
            $url = route('get-one-product', $product->product_id);
        } else {
            $url = route('get-all-products');
        }
        $product->delete();
        return redirect($url)->with([
            'alert' => 'sweet',
            'title' => 'İşlem Başarılı',
            'text' => 'Ürün Silindi',
            'type' => 'success'
        ]);
    }
    public function UpdateProduct(Request $request, int $product_id)
    {

        $product = Product::find($product_id);
        if (!isset($product))
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarısız İşlem',
                'text' => 'Ürün bulunamadı',
                'type' => 'warning'
            ]);
        $rules["name"] = "required";
        $message = ['required' => ":attribute zorunludur."];
        $attribute = ['name' => "Ürün adı"];
        $request->validate($rules, $message, $attribute);
        $product->name=$request->name;
        $product->detail=$request->detail;
        $product->save();
        return back()->with([
            'alert'=>'sweet',
            'title'=>'İşlem başarılı',
            'text'=>'Ürün ismi değişti',
            'type'=>'success'
        ]);

    }
//    ürün detay tablosundaki kaydet kısmı
    public function CreateProductProperties(Request $request)
    {
        $request->validate([
            //exists id var mı diye kontrol ediliyor doğrulama sağlıyor
            'product_id' => 'exists:App\Models\Product,id',
        ]);

        if (count($request->property_id) > 0) {

            //veri tekrarını önlemek için kaydete basıldığında özellikler siliniyor
            ProductProperties::where('product_id', $request->product_id)->delete();

            foreach ($request->property_id as $key => $val) {

                $property = Property::find($key);// property araştırılıyor
                if (!isset($property)) continue;
                if ($val) {
                    ProductProperties::create([
                        'product_id' => $request->product_id,
                        'property_id' => $key,
                        'property_value' => $val
                    ]);
                }

            }
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarılı',
                'text' => 'Yeni Özellikleri Girildi',
                'type' => 'success'
            ]);
        }
    }
}
