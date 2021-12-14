@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            調整
        </h3>
    </div>

    <div class="card-body">
        <form id="data-form" method="post" action="{{ route('user.update') }}">
            @csrf

            <input type="hidden" name="id" value="{{$row->id ?? -1}}">

            <table class="table table-bordered table-striped" style="width:100%;">
                <tbody>

                    <tr>
                        <td>名字</td>
                        <td>
                            <input type="int" name="name" class="form-control" value="{{$row->name ?? ''}}" required>
                        </td>
                    </tr>

                    <tr>
                        <td>email</td>
                        <td>
                            <input type="int" name="email" class="form-control" value="{{$row->email ?? ''}}" required>
                        </td>
                    </tr>

                    <tr>
                        <td>密碼</td>
                        <td>
                            <input type="int" name="name" class="form-control" value="" required>
                        </td>
                    </tr>

                    <tr>
                        <td>admin類型</td>
                        <td>
                            <select name="user_group_id" class="form-control" value="{{$row->user_group_id ?? ''}}">
                                @foreach($userGroups as $userGroup)
                                <option value="{{$userGroup->id}}">{{$userGroup->group_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <td colspan="2" align="right">
                        <input type="submit" class="btn btn-primary" value="完成" />
                        &nbsp&nbsp&nbsp
                        <input type="button" class="btn btn-primary" value="返回" onclick='javascript:location.href="{{ route("task.index") }}"' />
                    </td>

                </tbody>
            </table>
        </form>
    </div>
</div>

<script type="module">
    import Vue from "https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js"

    console.log(' test');
</script>
@endsection