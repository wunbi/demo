@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            任務列表
        </h3>
    </div>

    <div class="col-xs-2">
        <br>
        <div class="btn-group">

            @if(Auth::user()->has('bugTask','create'))
            <button type="button" class="btn btn-default" onclick="addTask('bugTask')">創建bug單</button>
            @endif


            @if(Auth::user()->has('featureTask','create'))
            <button type="button" class="btn btn-default" onclick="addTask('featureTask')">創建需求單</button>
            @endif


            @if(Auth::user()->has('testTask','create'))
            <button type="button" class="btn btn-default" onclick="addTask('testTask')">創建測試單</button>
            @endif
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
                @foreach($data as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->task_type}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->content}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="editTask('{{$row->id}}')">調整</button>

                        @if(Auth::user()->has($row->task_type, 'delete'))
                        <button type="button" class="btn btn-danger" onclick="deleteTask('{{$row->id}}')">刪除</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data->links() }}
</div>

<script type="module">
    import Vue from "https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js"

    console.log('test');
</script>


<script>
    function addTask(action) {
        location.href = "{{ route('task.create',['action'=>'action'] ) }}".replace('action', action);
    }

    function editTask(id) {
        location.href = "{{ route('task.edit',['id'=>'id'] ) }}".replace('id', id);
    }

    function deleteTask(id) {
        $.ajax({
            url: "{{ route('task.delete',['id'=>'id'] ) }}".replace('id', id),
            type: 'delete',
            headers: {
                'token': '{{Auth()->user()->api_token}}',
            },
            success: function(response) {
                location.reload();
                //...
            }
        });
    }
</script>
@endsection