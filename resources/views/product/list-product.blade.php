
{{--Ürünler kısmının tıklanılabilir ürün bilgi tablo kısmının kodlarının bulunduğu yer--}}
<x-admin-layout>
    <x-slot name="page_title">
        <div class="row mx-auto">
            <h2 class="ml-4">Ürünler</h2>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="card col-sm-12 col-lg-4">
                <x-product-form/>
            </div>

            <div class="card col-sm-12 col-lg-8 mx-auto">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>

                            <th>Ürün adı</th>
                            <th>Kategori adı</th>
                            <th>Detaylar</th>
                            <th>Fiyatı</th>
                            <th>Miktarı</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>

                                <td>
                                    <a href="{{route('get-one-product',$product->id)}}">{{$product->name}}</a>
                                </td>
                                <td>
                                    <a href="#" onclick="goToCategoryPage({{$product->category->id}})">
                                        {{$product->category->name}}
                                    </a>
                                </td>

                                <td>{{$product->detail}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->amount}}</td>
                            </tr>
                        @endforeach
                        <script>
                            function goToCategoryPage(productId) {
                                window.location.href = "/categories/" + productId;
                            }
                        </script>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>




