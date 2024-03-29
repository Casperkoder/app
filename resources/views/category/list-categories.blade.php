<x-admin-layout>
    <x-slot name="css_plugin">
        <link href="{{asset('/admintema/css/lib/nestable/nestable.css')}}" rel="stylesheet">
    </x-slot>
    <x-slot name="js_plugin">
        <script src="{{asset('/admintema/js/lib/nestable/jquery.nestable.js')}}"></script>
        <script src="{{asset('/admintema/js/lib/nestable/nestable.init.js')}}"></script>

    </x-slot>
    <x-slot name="title">
        Kategoriler
    </x-slot>
    <x-slot name="page_title">
        <h1>Kategoriler</h1>
    </x-slot>
    <x-slot name="bread_crumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </x-slot>


    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 col-md-4 col-lg-5">
                <div class="card">
                    <x-create-category-form/>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="card nestable-cart">
                    <x-cat-tree/>
                </div>
                <!-- /# card -->
            </div>
        </div>

    </div>


</x-admin-layout>


