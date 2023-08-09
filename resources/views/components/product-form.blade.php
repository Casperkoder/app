<form id="productForm" action="{{$action??route('create-product')}}" method="post">
    @csrf
    @if(isset($method))
        <input name="_method" value="{{$method}}" type="hidden"/>
    @endif

    @csrf
    <div class="form-group">
        <label>Kategori
            @error('category_id')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <select class="form-control" name="category_id">
            @php($cats=\App\Models\Category::orderBy("name")->get())
            <option value="">Seçiniz</option>
            @foreach($cats as $cat)
                <option value="{{$cat->id}}"
                        @if(isset($categoryId))
                            @if($categoryId==$cat->id)
                                selected
                    @endif
                    @endif
                >{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Ürün adı
            @error('name')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="name" value="{{$productName??''}}">
    </div>
    <div class="form-group">
        <label>Ürün detayı
            @error('detail')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="detail" value="{{$productDetail??''}}">
    </div>
    <div class="form-group">
        <label>Ürün fiyatı
            @error('price')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="price" value="{{$productPrice??''}}">
    </div>
    <div class="form-group">
        <label>Ürün miktarı
            @error('amount')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="amount" value="{{$productAmount??''}}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary m-2 ml-3 h-25">{{$btn??'Ekle'}}</button>
        @if(isset($productId))
            <button class="btn btn-danger" type="button" onclick="ProductDelete()">sil</button>
        @endif
    </div>

</form>

@if(isset($productId))
    <form id="deleteCategoryForm" method="post" action="{{route('delete-product',$productId)}}">
        @csrf
        @method('delete')
    </form>

@endif

<script>
    function ProductDelete() {
        swal({
                title: "Bu Kullanıcıyı silmek istiyor musunuz?",
                text: "Bu işleme devam ettiğinizde bu kullanıcı silinecektir!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Evet, silinsin!",
                cancelButtonText: "Hayir, silinmesin!",
                closeOnConfirm: false
            },
            function () {
                $("#deleteCategoryForm").submit();
            });
    }

</script>

