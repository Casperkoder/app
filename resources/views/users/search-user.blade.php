
        @foreach($users as $user)
            <li><a href="javascript:void(0);" onclick="listUser('{{$user->name}}');">{{$user->name}}</a></li>
        @endforeach

