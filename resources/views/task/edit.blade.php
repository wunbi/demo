@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            調整 - {{ $taskType }}
        </h3>
    </div>

    <div class="card-body" id="card">
        <form id="data-form" method="post" action="{{ route('task.update') }}">
            @csrf

            <input type="hidden" name="id" v-model="task.id">

            <input type="hidden" name="task_type" value="{{$taskType}}">
            <table class="table table-bordered table-striped" style="width:100%;">
                <tbody>

                    <tr>
                        <td>title</td>
                        <td>
                            <input type="int" name="title" class="form-control" v-model="task.title" required>
                        </td>
                    </tr>

                    <tr>
                        <td>嚴重度</td>
                        <td>
                            <select name="severe_level" class="form-control" v-model="task.severe_level" required>
                                <option v-for="severeLevel in severeLevels" :value="severeLevel">@{{severeLevel}}</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>優先權</td>
                        <td>
                            <select name="priority_level" class="form-control" v-model="task.priority_level" required>
                                <option v-for="priorityLevel in priorityLevels" :value="priorityLevel">@{{priorityLevel}}</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>狀態</td>
                        <td>
                            <select name="status" class="form-control" v-model="task.status" required>
                                <option v-for="state in status" :value="state.value" :disabled="!state.canSelect" >@{{state.name}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>內容</td>
                        <td>
                            <textarea name="content" class="form-control" cols="30" rows="10" required>@{{task.content }}</textarea>
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

    var vm = new Vue({

        el: '#card',
        data: {
            task: JSON.parse(`{!! json_encode($task) !!}`),
            severeLevels : [1, 2, 3, 4, 5],
            priorityLevels : [1, 2, 3, 4, 5],
            status : [{
                    value: 0,
                    name: "尚未完成",
                    canSelect : `{{ Auth::user()->isGroup('qa') }}`
                },
                {
                    value: 1,
                    name: "已完成",
                    canSelect : `{{ Auth::user()->isGroup('rd') }}`
                }
            ]

        }
    })
</script>
@endsection