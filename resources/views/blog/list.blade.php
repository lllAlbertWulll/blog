@extends('layouts.app')
@section('css')
@endsection

@section('content')
    @include('UEditor::head');
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
                    <div class="panel-heading"><h4><strong>BLOG List</strong></h4></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Operate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        <a href="show/{{ $blog->id }}" class="fa fa-eye operate"></a>
                                        <a href="edit/{{ $blog->id }}" class="fa fa-edit operate"></a>
                                        <a href="delete/{{ $blog->id }}" class="fa fa-trash-o operate"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection