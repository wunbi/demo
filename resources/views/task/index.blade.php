@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            任務列表
        </h3>
    </div>

    <div class="card-body">
        <table id="PermissionList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>路由</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @isset($permissions)
                @foreach($permissions as $key => $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td><a href="{{url('permissions/'. $permission->id . '/edit')}}">{{$permission->name}}</a></td>
                    <td><span style="color:#fff;background-color:#0088a8">{{$permission->http_method}}</span>
                        <span style="color:#aa0000;">&nbsp;{{$permission->http_path}}</span>
                    </td>
                    <td>{{$permission->created_at}}</td>
                    <td>{{$permission->updated_at}}</td>
                    <td>
                        <form action={{ url ('/permissions/'. $permission->id) }} method="POST">
                            {{method_field('DELETE')}}
                            @csrf
                            <input type="submit" value="刪除" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script type="module">
    import Vue from "https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js"
    console.log('test');
</script>
@endsection