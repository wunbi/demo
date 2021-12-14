@extends('layouts.app')

@section('content')


<div class="card" id="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            會員列表
        </h3>
    </div>

    <div class="col-xs-2">
        <br>
        <div class="btn-group">

            <button type="button" class="btn btn-default" @click="addUser()" v-if="canCreateUser">創建帳號</button>
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
                <tr v-for="user in users" :key="user.id">
                    <td>@{{user.id}}</td>
                    <td>@{{user.email}}</td>
                    <td>@{{user.created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-default" @click="editUser(user.id)">調整</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{ $data->links() }}
</div>

<script type="module">
    import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js'

    let users = JSON.parse(`{!! json_encode($users) !!}`);
    let canCreateUser = `{{ $canCreateUser }}`;
    var vm = new Vue({

        el: '#card',
        data: {
            users: users,
            canCreateUser : canCreateUser
        },
        methods: {
            addUser: function() {
                location.href = "{{ route('user.create') }}";
            },
            editUser: function(userId) {
                location.href = "{{ route('user.edit',['id'=>'id'] ) }}".replace('id', userId);
            },

        }
    })
</script>
@endsection