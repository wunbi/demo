@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-heading bg-primary text-white d-flex mb-4 p-2">
        <h3 class="flex-grow-1"><i class="fa fa-bank"></i>
            調整 - {{ $taskType }}
        </h3>
    </div>

    <div class="card-body">
        <form id="data-form" method="post" action="{{ route('task.update') }}">
            @csrf

            <input type="hidden" name="id" value="{{$row->id ?? -1}}">

            <input type="hidden" name="task_type" value="{{$taskType}}">
            <table class="table table-bordered table-striped" style="width:100%;">
                <tbody>

                    <tr>
                        <td>title</td>
                        <td>
                            <input type="int" name="title" class="form-control" value="{{$row->title ?? ''}}" required>
                        </td>
                    </tr>

                    <tr>
                        <td>嚴重度</td>
                        <td>
                            <select name="severe_level" class="form-control" value="{{$row->severe_level ?? ''}}">
                                <option value="1" @if(($row->severe_level ?? '') == 1)
                                    selected
                                    @endif
                                    >1</option>
                                <option value="2" @if(($row->severe_level ?? '') == 2)
                                    selected
                                    @endif>2</option>
                                <option value="3" @if(($row->severe_level ?? '') == 3)
                                    selected
                                    @endif>3</option>
                                <option value="4" @if(($row->severe_level ?? '') == 4)
                                    selected
                                    @endif>4</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>優先權</td>
                        <td>
                            <select name="priority_level" class="form-control" value="{{$row->priority_level ?? ''}}">
                                <option value="1" @if(($row->priority_level ?? '') == 1)
                                    selected
                                    @endif>1</option>
                                <option value="2" @if(($row->priority_level ?? '') == 2)
                                    selected
                                    @endif>2</option>
                                <option value="3" @if(($row->priority_level ?? '') == 3)
                                    selected
                                    @endif>3</option>
                                <option value="4" @if(($row->priority_level ?? '') == 4)
                                    selected
                                    @endif>4</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>狀態</td>
                        <td>
                            <select name="status" class="form-control" value="{{$row->status ?? 0}}">


                                <option value="0" @if(($row->status ?? '0') == 0)
                                    selected
                                    @endif
                                    @if(!Auth::user()->isGroup('qa'))
                                    disabled
                                    @endif
                                    >尚未完成</option>

                                <option value="1" @if(($row->status ?? '1') == 1)
                                    selected
                                    @endif
                                    @if(!Auth::user()->isGroup('rd'))
                                    disabled
                                    @endif>完成</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>內容</td>
                        <td>
                            <textarea name="content" class="form-control" cols="30" rows="10" required>{{$row->content ?? ''}}</textarea>
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