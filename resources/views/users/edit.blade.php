@extends('layouts.app')

@section('title', '编辑资料')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1 panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i>编辑资料
                </h4>

            </div>

            @include('common.error')

            <div class="panel-body">
                <form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
                    </div>
                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop