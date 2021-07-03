@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('iblog::post.title.posts') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('iblog::post.title.posts') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.iblog.post.create') }}" class="btn btn-primary btn-flat"
                       style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('iblog::post.button.create post') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Lista de {{ trans('iblog::post.title.posts') }}</h3>
                    <div class="box-tools">
                        {!! Form::open(['route' => ['admin.iblog.post.index'], 'method' => 'get']) !!}
                        <div class="input-group input-group-sm" style="width: 250px; margin-bottom: 10px">
                            <input type="text" name="q" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">{{ trans('iblog::post.table.id') }}</th>
                                <th class="col-md-4">{{ trans('iblog::post.table.title') }}</th>
                                <th class="col-md-3">{{ trans('iblog::post.table.slug') }}</th>
                                <th class="col-md-1">{{ trans('iblog::post.table.principal category') }}</th>
                                <th class="col-md-1">{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($posts))
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.iblog.post.edit', [$post->id]) }}">
                                                {{ $post->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.iblog.post.edit', [$post->id]) }}">
                                            {{ $post->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{$post->url}}">
                                                {{ $post->slug }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.iblog.category.edit', [$post->category->id??'N/A'])}}">
                                                {{ $post->category->title??'N/A'}}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $post->created_at }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{$post->url}}"
                                                   class="btn btn-success btn-flat"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.iblog.post.edit', [$post->id]) }}"
                                                   class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger btn-flat" data-toggle="modal"
                                                        data-target="#modal-delete-confirmation"
                                                        data-action-target="{{ route('admin.iblog.post.destroy', [$post->id]) }}">
                                                    <i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('iblog::post.table.id') }}</th>
                                <th>{{ trans('iblog::post.table.title') }}</th>
                                <th>{{ trans('iblog::post.table.slug') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">

                            </div>
                        </div>
                        <div class="col-sm-7">
                            @if (isset($posts))
                                {{$posts->links()}}
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('iblog::post.title.create post') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'c', route: "<?= route('admin.iblog.post.create') ?>"}
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>

@endpush
