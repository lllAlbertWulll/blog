@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-infomationcart">
                <div class="panel-avatar">
                    <img class="avatar" src="{{ asset('image/avatar.jpg') }}">
                </div>
                <div class="infomation">
                    <h2>GegeWv</h2>
                    <p>Life without regret, we can only do our best to not to regret.</p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
