<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use App\Services\UserGroupService;
use App\Models\User;

class UserController extends Controller
{

    private $userService;
    private $userGroupService;

    public function __construct(UserService $userService, UserGroupService $userGroupService)
    {
        $this->userService = $userService;
        $this->userGroupService = $userGroupService;
    }

    public function index(Request $request)
    {
        if (!Auth::user()->has('user', 'read')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $data = User::paginate(15);
        return view('user.index', ['data' => $data]);
    }

    public function create(Request $request)
    {
        if (!Auth::user()->has('user', 'create')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        return view(
            'user.edit',
            [
                'row' => null,
                'userGroups' => $this->userGroupService->all()
            ]
        );
    }

    public function edit(Request $request, $id)
    {

        if (!Auth::user()->has('user', 'edit')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $user = $this->userService->firstBy('id', $id);


        return view(
            'user.edit',
            [
                'row' => $user,
                'userGroups' => $this->userGroupService->all()
            ]
        );
    }

    public function update(Request $request)
    {

        if (!Auth::user()->has('user', 'edit')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        if (!$user = $this->userService->firstBy('id', $request->get('id'))) {
            $user = $this->userService->new();
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_group_id = $request->get('user_group_id');
        $user->password =  Hash::make($request->get('password'));

        $redirect = redirect()->route('user.index');
        if (!$user->save()) {
            return $redirect->with('error', '失敗');
        }

        return $redirect->with('success', '成功');
    }
}
