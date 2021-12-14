<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;

class TaskController extends Controller
{

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $types = [];
        foreach (['bugTask', 'featureTask', 'testTask'] as  $value) {
            if (Auth::user()->has($value, 'read')) {
                $types[] = $value;
            }
        }
        if (!$types) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $data = Task::whereIn('task_type', $types)->paginate(1);
        return view('task.index', [
            'data' => $data
        ]);
    }

    public function create(Request $request, $action)
    {
        if (Auth::user()->has($action, 'create')) {
            return view(
                'task.edit',
                [
                    'taskType' => $action,
                    'row' => null
                ]
            );
        }

        return redirect()->route('home')->with('error', '沒有權限');
    }

    public function edit(Request $request, $id)
    {
        $task = $this->taskService->firstBy('id', $id);

        if (!Auth::user()->has($task->task_type, 'update')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        return view(
            'task.edit',
            [
                'taskType' => $task->task_type,
                'row' => $task
            ]
        );
    }

    public function update(Request $request)
    {
        if (!$task = $this->taskService->firstBy('id', $request->get('id'))) {
            $task = $this->taskService->new();
        }

        if (!Auth::user()->has($task->task_type, 'update')) {
            return redirect()->route('home')->with('error', '沒有權限');
        }

        $task->task_type = $request->get('task_type');
        $task->title = $request->get('title');
        $task->content = $request->get('content');
        $task->severe_level = $request->get('severe_level');
        $task->priority_level = $request->get('priority_level');
        $task->created_admin_id = Auth::id();

        $redirect = redirect()->route('task.index');
        if ($task->status != $request->get('status')) {

            if ($request->get('status') == 0 && !Auth::user()->isGroup('qa')) {
                return $redirect->with('error', '失敗');
            }

            if ($request->get('status') == 1 && !Auth::user()->isGroup('rd')) {
                return $redirect->with('error', '失敗');
            }

            $task->status = $request->get('status');
        }


        if (!$task->save()) {
            return $redirect->with('error', '失敗');
        }

        return $redirect->with('success', '成功');
    }
    /**
     * @OA\delete(
     *     path="/api/task/{taskId}",
     *     tags={"Task"},
     *     summary="Delete Task",
     *     description="刪除task",
     *     operationId="deleteTask",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         description="需要任務id來刪除",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),

     *      @OA\Parameter(
     *          in="header",
     *          name="token",
     *          description="ajax 帶 api token",
     *          required=true,
     *          @OA\Schema(
     *          type="string",
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Invalid taskId supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *     )
     * )
     */
    public function delete(Request $request, $id)
    {
        if (!$task = $this->taskService->firstBy('id', $id)) {
            return response('error', 403);
        }

        // if (!Auth::user()->has($task->task_type, 'delete')) {
        //     return response('error', 401);
        // }

        if (!$task->delete()) {
            return response('error', 403);
        }
        return response('', 203);
    }
}
