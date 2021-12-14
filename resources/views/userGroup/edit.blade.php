@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            調整 - {{$userGroup->group_name}}
        </h3>
    </div>

    <div class="card-body">
        <form id="data-form" method="post" action="{{ route('userGroup.update') }}">
            @csrf

            <input type="hidden" name="userGroupId" value="{{$userGroup->id ?? -1}}">

            <table class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>權限名稱</th>
                        <th>新增權限</th>
                        <th>更新權限</th>
                        <th>查詢權限</th>
                        <th>刪除權限</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($programs as $program)
                    @if(empty($program->parent_id))
                    <td colspan="6" align="middle">
                        <h5> {{$program->name}}</h5>
                    </td>

                    @else
                    <input type="hidden" name="program[{{$program->id}}][user_group_program_id]" value="{{$program->userGroupProgram->id ?? -1}}" </td>
                    <tr>
                        <td>
                            {{$program->name}}
                        </td>
                        <td>
                            <input type="checkbox" name="program[{{$program->id}}][create]" value="1" @if(!empty($program->userGroupProgram->create))
                            checked
                            @endif
                            >
                        </td>
                        <td>
                            <input type="checkbox" name="program[{{$program->id}}][update]" value="1" @if(!empty($program->userGroupProgram->update))
                            checked
                            @endif
                            >
                        </td>
                        <td>
                            <input type="checkbox" name="program[{{$program->id}}][read]" value="1" @if(!empty($program->userGroupProgram->read))
                            checked
                            @endif
                            >
                        </td>
                        <td>
                            <input type="checkbox" name="program[{{$program->id}}][delete]" value="1" @if(!empty($program->userGroupProgram->delete))
                            checked
                            @endif
                            >
                        </td>
                    </tr>
                    @endif
                    @endforeach


                    <td colspan="6" align="right">
                        <input type="submit" class="btn btn-primary" value="完成" />
                        &nbsp&nbsp&nbsp
                        <input type="button" class="btn btn-primary" value="返回" onclick='javascript:location.href="{{ route("userGroup.index") }}"' />
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