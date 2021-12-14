<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserGroup;
use App\Models\UserGroupProgram;
use Illuminate\Http\Request;
use App\Services\UserGroupService;
use App\Services\ProgramService;
use App\Services\UserGroupProgramService;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    private $userGroupService;
    private $programService;
    private $userGroupProgramService;

    public function __construct(
        UserGroupService $userGroupService,
        ProgramService $programService,
        UserGroupProgramService $userGroupProgramService
    ) {
        $this->userGroupService = $userGroupService;
        $this->programService = $programService;
        $this->userGroupProgramService = $userGroupProgramService;
    }

    public function index(Request $request)
    {
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $data = UserGroup::paginate(15);

        $userGroup = $data->getCollection()
            ->map(function ($item) {
                return $item->toArray();
            })->toArray();


        return view('userGroup.index', [
            'data' => $data,
            'userGroup' => $userGroup,
            'isSuperAdmin' => Auth::user()->isSuperAdmin()
        ]);
    }

    public function edit(Request $request, $id)
    {

        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $userGroup = $this->userGroupService->firstBy('id', $id);
        $userGroupPrograms = $userGroup->userGroupProgram->keyBy('program_id');

        $programs = $this->programService->all()->keyBy('id');
        $programs = $programs->map(function ($program) use ($userGroupPrograms) {
            $program->userGroupProgram = $userGroupPrograms[$program->id] ?? null;
            return $program;
        });

        return view(
            'userGroup.edit',
            [
                'programs' => $programs,
                'userGroup' => $userGroup
            ]
        );
    }

    public function update(Request $request)
    {

        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        // if (!$userGroup = $this->userGroupProgramService->get(['user_group_id' => $request->get('userGroupId')])) {
        //     $userGroup = $this->programService->new();
        // }
        // dump($userGroup->toArray());
        // dd($request->all());

        $program = $request->get('program');

        $data = [];

        foreach ($program as $key => $value) {

            if (empty($value['user_group_program_id'])) {
                continue;
            }

            $userGroupProgramId = $value['user_group_program_id'];

            $data = [
                'id' => $value['user_group_program_id'],
                "user_group_id" => $request->get('userGroupId'),
                "program_id" => $key,
                "create" => $value["create"] ?? 0,
                "update" => $value["update"] ?? 0,
                "read" => $value["read"] ?? 0,
                "delete" => $value["delete"] ?? 0,
                'state' => 1
            ];

            if ($userGroupProgramId == -1) {
                UserGroupProgram::create($data);
            } else {
                UserGroupProgram::where('id', $userGroupProgramId)
                    ->update($data);
            }
        }




        // $user->name = $request->get('name');
        // $user->email = $request->get('email');
        // $user->user_group_id = $request->get('user_group_id');
        // $user->password =  Hash::make($request->get('password'));

        $redirect = redirect()->route('userGroup.index');
        // if (!$res) {
        //     return $redirect->with('error', '失敗');
        // }

        return $redirect->with('success', '成功');
    }
}
