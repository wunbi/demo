@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            會員列表
        </h3>
    </div>

    <div class="col-xs-2">
        <br>
        <div class="btn-group">

            @if(Auth::user()->isSuperAdmin())
            <button type="button" class="btn btn-default" onclick="addUser()">創建帳號</button>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table id="PermissionList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>email</th>
                    <th>創建時間</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-default" onclick="editUser('{{$value->id}}')">調整</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $data->links() }}
</div>


<script>
    function addUser() {
        location.href = "{{ route('user.create') }}";
    }


    function editUser(id) {
        location.href = "{{ route('user.edit',['id'=>'id'] ) }}".replace('id', id);
    }
</script>
@endsection