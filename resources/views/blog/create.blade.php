@extends('layouts.app')

@section('css')
    {!! editor_css() !!}
@endsection

@section('content')
    {{--@include('UEditor::head');--}}
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><strong>BLOG</strong></h4></div>
                <div class="panel-body">
                    <form action="/blogs" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="title" id="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <select name="categories[]" class="js-example-basic-multiple js-data-example-ajax form-control" multiple="multiple"></select>
                        </div>
                        <div class="form-group">
                            <label for="body">Content</label>
                            <!-- 加载编辑器的容器 -->
                            <div class="col-md-12">
                                <div id="editormd_id">
                                    <textarea name="body" style="display:none;">{!! old('body') !!}</textarea>
                                </div>
                            </div>
                            {{--<script id="container" name="body" type="text/plain" >{!! old('body') !!}</script>--}}
                        </div>
                        <br>
                        <button class="btn btn-success pull-right" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        {{--var ue = UE.getEditor('container');--}}
        {{--ue.ready(function() {--}}
            {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
        {{--});--}}
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
    {!! editor_js() !!}
@endsection