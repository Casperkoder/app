<form id="userForm" action="{{$action??route('create-user')}}" method="post">
{{--bu sayfa kullancı yani user sayfasında kullanıcı eklerken veren hata mesajı kısmı--}}
    @if(isset($method))
        <input name="_method" value="{{$method}}" type="hidden"/>
    @endif

    @csrf
    <div class="form-group">
        <label>Kullanıcı Adı
            @error('user_name')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="user_name" value="{{$userName??''}}">
    </div>
    <div class="form-group">
        <label>E-posta
            @error('user_email')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
        </label>
        <input class="form-control" name="user_email" value="{{$userEmail??''}}">
        <button class="btn btn-primary m-2 ml-3 h-25">{{$btn??'Ekle'}}</button>


        @if(isset($userId))
            <button class="btn btn-outline-danger" type="button" onclick="Delete()">Sil</button>
        @endif
    </div>
</form>
{{--userId gelip gelmediğini kontrol eder--}}
@if(isset($userId))
<form id="deleteCategoryForm" method="post" action="{{route('delete-user',$userId)}}">
    @csrf
    @method('delete')
</form>
@endif
@if(isset($users))
    <!-- Arama sonuçlarını burada gösterme -->
    @foreach($users as $user)
        <p>{{ $user->name }} - {{ $user->email }}</p>
    @endforeach
@endif

<script>
{{--sil metodu ve hata mesaj kısmı--}}
    function Delete() {
        swal({
                title: "Bu kullanıcıyı silmek istiyor musunuz?",
                text: "Bu işleme devam ettiğinizde bu kullanıcı  silinecektir!",
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
