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
                    <div class="panel-heading"><h4><strong>BLOG</strong></h4></div>
                    <div class="panel-body">
                        <form action='{{ url("blogs/update/$blog->id") }}' method="post">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="title" id="title" value="{{ $blog->title }}">
                            </div>
                            <div class="form-group">
                                <select name="categories[]" class="js-example-basic-multiple js-data-example-ajax form-control" multiple="multiple">
                                    @foreach($blog->categories as $category)
                                        <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">Content</label>
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="body" type="text/plain" >{!! $blog->body !!}</script>
                            </div>
                            <br>
                            <button class="btn btn-success pull-right" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
        $(document).ready(function () {
            function formatCategory (category) {
                return "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" +
                category.name ? category.name : "GegeWv"   +
                    "</div></div></div>";
            }

            function formatCategorySelection (category) {
                return category.name || category.text;
            }

            $(".js-example-basic-multiple").select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: '/api/categories',
                    dataType: 'json',
                    delay: 150,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatCategory,
                templateSelection: formatCategorySelection,
                escapeMarkup: function (markup) { return markup; }
            });
        });
    </script>

@endsection

