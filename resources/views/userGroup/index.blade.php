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
            <button type="button" class="btn btn-default" onclick="addUserGroup()">創建群組</button>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table id="PermissionList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>權限群組名稱</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->group_name}}</td>
                    <td>
                        @if($value->group_name != 'superAdmin' )
                        <button type="button" class="btn btn-default" onclick="editUserGroup('{{$value->id}}')">調整</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $data->links() }}
</div>


<script>
    function addUserGroup() {
        location.href = "{{ route('userGroup.create') }}";
    }


    function editUserGroup(id) {
        location.href = "{{ route('userGroup.edit',['id'=>'id'] ) }}".replace('id', id);
    }
</script>
@endsection