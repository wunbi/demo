@extends('layouts.app')

@section('content')


<div class="card" id="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            會員列表
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>權限群組名稱</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="userGroup in userGroups" :key="userGroup.id">
                    <td>@{{userGroup.id}}</td>
                    <td>@{{userGroup.group_name}}</td>
                    <td>
                        <button type="button" class="btn btn-default" @click="editUserGroup(userGroup.id)"
                        v-if="userGroup.group_name != 'superAdmin'">調整</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{ $data->links() }}
</div>


<script type="module">
    import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js'

    var vm = new Vue({
        el: '#card',
        data: {
            userGroups: JSON.parse(`{!! json_encode($userGroup) !!}`),
        },
        methods: {
            addUserGroup: function() {
                location.href = "{{ route('userGroup.create') }}";
            },
            editUserGroup: function(id) {
                location.href = "{{ route('userGroup.edit',['id'=>'id'] ) }}".replace('id', id);
            },

        }
    })
</script>

@endsection