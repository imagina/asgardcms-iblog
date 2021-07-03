<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('iblog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("{$lang}.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iblog::post.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("$lang.summary") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[summary]", trans('iblog::post.form.summary')) !!}
        {!! Form::textarea("{$lang}[summary]", old("$lang.summary"), ['class' => 'form-control','rows'=>2, 'placeholder' => trans('iblog::post.form.summary')]) !!}
        {!! $errors->first("$lang.summary", '<span class="help-block">:message</span>') !!}
    </div>
    
    <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
        @editor('description', trans('iblog::post.form.description'), old("{$lang}.description"), $lang)
    </div>


    <div class="col-xs-12" style="padding-top: 35px;">
        <div class="panel box box-primary">
            <div class="box-header">
                <div class="box-tools pull-right">
                    <a href="#aditional{{$lang}}" class="btn btn-box-tool " data-target="#aditional{{$lang}}"
                       data-toggle="collapse"><i class="fa fa-minus"></i>
                    </a>
                </div>
                <label>{{ trans('iblog::post.form.metadata')}}</label>
            </div>
            <div class="panel-collapse collapse" id="aditional{{$lang}}">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("{$lang}.meta_title") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[meta_title]", trans('iblog::post.form.meta_title')) !!}
                        {!! Form::text("{$lang}[meta_title]", old("{$lang}.meta_title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iblog::post.form.meta_title')]) !!}
                        {!! $errors->first("{$lang}.meta_title", '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class='form-group{{ $errors->has("{$lang}.meta_keywords") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[meta_keywords]", trans('iblog::post.form.meta_keywords')) !!}
                        {!! Form::text("{$lang}[meta_keywords]", old("{$lang}.meta_keywords"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iblog::post.form.meta_keywords')]) !!}
                        {!! $errors->first("{$lang}.meta_keywords", '<span class="help-block">:message</span>') !!}
                    </div>

                    @editor('meta_description', trans('iblog::post.form.meta_description'),
                    old("{$lang}.meta_description"), $lang)
                </div>
            </div>
        </div>
    </div>
    
    

    @if (config('asgard.iblog.config.fields.post.partials.translatable.create') && config('asgard.iblog.config.fields.post.partials.translatable.create') !== [])
        @foreach (config('asgard.iblog.config.fields.post.partials.translatable.create') as $partial)
            @include($partial)
        @endforeach
    @endif
</div>
