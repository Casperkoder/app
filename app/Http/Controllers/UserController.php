<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function GetAllUsers(Request $request)
    {

        $users = User::where(function (Builder $builder) use ($request) {
            if ($request->alfabet) {
                $builder->where('name', 'like', "$request->alfabet%");
            }
        })->orderBy('id', 'desc')->paginate(5);

        //sayfa başı 10satır bilgi alabilecek şekilde çalıştırmak için
        $users->appends(['alfabet' => $request->alfabet]);
        return view('users.list-user', compact('users'));
    }

    public function DeleteUser(int $id)
    {
        $user = User::find($id);
        if (!isset($user))
            return back()->with([
                'alert' => 'sweet',
                'title' => 'Başarısız İşlem',
                'text' => 'Kategory bulunamadı',
                'type' => 'warning'
            ]);
        $user->delete();
        return redirect(route('get-all-users'))->with([
            'alert' => 'sweet',
            'title' => 'İşlem Başarılı',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success'
        ]);


    }

    public function UpdateUser(UserRequest $request, int $user_id)
    {
        $user = User::find($user_id);
        if (!isset($user))
            return view('errors.404');
        $user->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
        ]);

        //kaydetme başarılı olduğ. mesaj belirtilen rotada görterilir.
        return redirect(route('get-all-users'))->with([
            'alert' => 'sweet',
            'title' => 'Başarılı',
            'text' => 'Kullancı bilgileri güncellendi.',
            'type' => 'success'
        ]);

    }

    public function CreateUser(UserRequest $request)
    {
        User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => "1234",
        ]);
        return back()->with([
            'alert' => 'sweet',
            'title' => 'Başarılı',
            'text' => 'Yeni Kullanıcı Eklendi',
            'type' => 'success'
        ]);

    }

    public function GetOneUser(int $user_id)
    {

        $user = User::find($user_id);
        //  $data['user']=$user;
        if (!isset($user))
            return view('errors.404');
        return view("users.user", compact('user'));
    }

    public function SearchUser(Request $request)
    {
        if ($request->ara) {
//            $users = User::where('name', 'like', "%$request->ara%")->get();
            $users = DB::table('users')
                ->select('name')
                ->where('name', 'like', "%$request->ara%")
                ->groupBy('name')
                ->get();
            if (count($users) > 0) {
                return response()->view('users.search-user', compact('users'), 200);
            } else {
                return response(status: 204);
            }
        }
        return response(status: 204);
    }


}
//
//function (Builder $builder)use($request){//use yönergesini callback içine işlemenin yöntrmi
//    if($request->alfabet){
//        $builder->where("name","like","$request->alfabet%");
//    }
//}
