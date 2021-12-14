@extends('layouts.app')

@section('content')


<div class="card" id="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            任務列表
        </h3>
    </div>

    <div class="col-xs-2">
        <br>
        <div class="btn-group">
            <button type="button" class="btn btn-default" @click="addTask('bugTask')" v-if="canCreateBugTask">創建bug單</button>
            <button type="button" class="btn btn-default" @click="addTask('featureTask')" v-if="canCreateFeatureTask">創建需求單</button>
            <button type="button" class="btn btn-default" @click="addTask('testTask')" v-if="canCreateTestTask">創建測試單</button>
        </div>
    </div>
    <div class="card-body">
        <table id="PermissionList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>類型</th>
                    <th>標題</th>
                    <th>內容</th>
                    <th>創建時間</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>@{{task.id}}</td>
                    <td>@{{task.task_type}}</td>
                    <td>@{{task.title}}</td>
                    <td>@{{task.content}}</td>
                    <td>@{{task.created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" @click="editTask(task.id)" v-if="task.canUpdate">調整</button>

                        <button type="button" class="btn btn-danger" @click="deleteTask(task.id)"  v-if="task.canDelete">刪除</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{ $data->links() }}
</div>

<script type="module">
    import Vue from "https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js"

    var vm = new Vue({

        el: '#card',
        data: {
            tasks: JSON.parse(`{!! json_encode($tasks) !!}`),
            canCreateBugTask: `{{ $canCreateBugTask }}`,
            canCreateFeatureTask: `{{ $canCreateFeatureTask }}`,
            canCreateTestTask: `{{ $canCreateTestTask }}`,
        },
        methods: {
            addTask: function(action) {
                location.href = "{{ route('task.create',['action'=>'action'] ) }}".replace('action', action);
            },
            editTask: function(taskId) {
                location.href = "{{ route('task.edit',['id'=>'id'] ) }}".replace('id', taskId);
            },
            deleteTask: function(taskId) {
                $.ajax({
                    url: "{{ route('task.delete',['id'=>'id'] ) }}".replace('id', taskId),
                    type: 'delete',
                    headers: {
                        'token': '{{Auth()->user()->api_token}}',
                    },
                    success: function(response) {
                        location.reload();
                        //...
                    }
                });
            },

        }
    })
</script>
@endsection