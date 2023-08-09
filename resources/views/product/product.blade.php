{{--ürüne tıklandığında açılan ürün detay tablosu-ürün detaylar ve ürün detayları kısmı--}}
<x-admin-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="card col-sm-12 col-md-6">
                <div class="card-header">
                    <h4><i class="fa fa-area-chart"></i>Ürün Detaylar</h4>
                </div>
                <div class="card-body">
                    <x-product-form
                        :action="route('update-product',$product->id)"
                        :btn="_('güncelle')"
                        :categoryId="$product->category_id"
                        :productId="$product->id"
                        :productName="$product->name"
                        :productDetail="$product->detail"
                        :productPrice="$product->price"
                        :productAmount="$product->amount"
                        :method="__('put')"
                    />

                </div>


            </div>

            <div class="card col-sm-12 col-md-6">
                <div class="card-header">
                    <h4><i class="fa fa-area-chart"></i>Ürün Detayları</h4>
                </div>
                <div class="card-body">
                    @php($properties=$product->category->properties)
                    <form action="{{route('create-product-properties')}}" method="post">
                        @csrf
                        @error('product_id')
                        {{$message}}
                        @enderror
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        @foreach($properties as $property)
                            @if($property->type=='text')
                                <div class="form-group">
                                    <label>{{$property->name}}:</label>
                                    <input type="{{$property->type}}" class="form-control"
                                           name="property_id[{{$property->id}}]">
                                </div>
                            @elseif($property->type=='checkbox')
                                <div class="form-group form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="on"
                                               name="property_id[{{$property->id}}]"> {{$property->name}}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        <button class="btn btn-outline-primary">Kaydet</button>

                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Özellik</th>
                            <th>Değer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->properties as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                <td>
                                    @if($val->type=='checkbox')
                                        <i class="fa fa-check"></i>
                                    @else
                                        {{$val->pivot->property_value}}
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>


