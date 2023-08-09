
<?php
//
//function tree($cat_id){
//    $categories=\App\Models\Category::where('category_id',$cat_id)->get();
//    if (count($categories)==0){//degger çıkmazsa çık
//
//        return;
//    }else{
//        echo "<div class='card nestable-cart'>";
//        echo " <div class='nestable'>";
//        echo " <div class='dd' id='nestable'>";
//        echo "<ol class='dd-list'>";
//        foreach ($categories as $category){
//            echo "<li class='dd-item'data-id='1'><a href='#' onclick='selectCategory($category->id)'>".$category->name."</li></a>";
//
//            tree($category->id);
//        }
//        echo "</ol>";
//        echo "</div>";
//        echo "</div>";
//        echo "</div>";
//    }
//}
//
//tree($cat??null);
//
//?>
<div class="nestable">
    <div class="dd" id="nestable">

        <?php

        function tree($cat_id)
        {
            $categories = \App\Models\Category::where('category_id', $cat_id)->get();
            if (count($categories) == 0) {
                return;
            }
            echo "<ol class='dd-list'>";
            foreach ($categories as $category) {
                echo "<li class='dd-item' data-id='".$category->id."'>";
                echo "<div class='dd-handle' style='cursor: move;'>
                        <a href='".route("get-one-category",$category->id)."' >" . $category->name . "</a></div>";

                tree($category->id);
                echo "</li>";
            }
            echo "</ol>";
        }

        tree($cat??null);
        ?>
<script>
    function gonder(url){
        window.location.href=url;
    }
</script>

    </div>
</div>




{{--<ul>--}}

{{--    @foreach($categories as $cat)--}}
{{--<li>{{$cat->name}}</li>--}}


{{--    @endforeach--}}
{{--</ul>--}}
