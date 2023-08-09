<x-admin-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="card col-sm-12 col-lg-6">
                @php($action=route('update-user',$user->id))
                <x-user-form  :btn="_('Kaydet')" :method="_('put')" :action="$action"
                :userName="$user->name" :userEmail="$user->email" :userId="$user->id"/>
            </div>
        </div>
    </div>
</x-admin-layout>


