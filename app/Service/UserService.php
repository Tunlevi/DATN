<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/18/23 .
 * Time: 11:35 AM .
 */

namespace App\Service;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserService
{
    public static function update(Request $request, $id)
    {
        $user             = User::find($id);
        $user->name       = $request->name;
        $user->phone      = $request->phone;
        $user->address    = $request->address;
        $user->avatar     = $request->avatar;
        $user->updated_at = Carbon::now();
        $user->save();

        return $user;
    }
}
