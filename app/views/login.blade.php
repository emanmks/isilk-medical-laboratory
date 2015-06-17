@extends('layout/login')

@section('content')
<div class="form-box" id="login-box">
    <div class="header">Login</div>
    <form action="{{ URL::to('login') }}" method="POST">
        <div class="body bg-gray">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="User ID"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>         
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block">Login</button>

            <div class="margin text-center">
                <br/>
                @if(Session::get('flash_message'))
                    <div class="label label-danger">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif  
            </div>
        </div>
    </form>
</div>
@stop