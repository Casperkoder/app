<x-admin-layout>
    <x-slot name="page_title">
        <div class="row">
            <h2 class="ml-4">Kullanıcılar</h2>
            <form class=" my-2 ml-4 my-lg-0">
                {{-- search kullanıcılar(users)sayfasındaki arama motoru--}}
                <div class="form-group">
                    <input class="form-control mr-sm-2" type="search"
                           onkeyup="searchUser(this);"
                           placeholder="Search" aria-label="Search">
                    <ul id="hole">


                    </ul>

                </div>


            </form>
            <script>
                function searchUser(element) {
                    let aranan = $(element).val();
                    if (aranan.length > 2) {
                        $.ajax({
                            url: '{{route('search-user')}}',
                            data: {
                                ara: aranan
                            },
                            success: function (data, textStatus, xhr) {
                                if (xhr.status == 200) {
                                    $("#hole").html(data);
                                } else {
                                    $("#hole").empty();
                                }
                            }
                        });
                    }
                    else{
                        $("#hole").empty();
                    }

                }

                function listUser(aranan){
                    window.location.href='{{route('get-all-users')}}?alfabet='+aranan;
                }
            </script>
        </div>

    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="card col-sm-12 col-lg-4">
                <div class="card-body">
                    <x-user-form/>
                </div>
            </div>

            <div class="card col-sm-12 col-lg-8">
                <div class="card-body table-responsive ">
                    <table class="table">
                        <thead>
                        <tr>
                            {{--<th>İşlemler</th>--}}
                            <th>Adı Soyadı</th>
                            <th>E-posta</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                {{--<td>--}}
                                {{--                                    <button class="btn btn-outline-warning">Güncelle</button>--}}
                                {{--                                    <button class="btn btn-outline-danger">Sil</button>--}}

                                {{--                                </td>--}}
                                {{--                              --}}
                                <td><a href="{{route('get-one-user',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">
                                {{$users->links()}}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
