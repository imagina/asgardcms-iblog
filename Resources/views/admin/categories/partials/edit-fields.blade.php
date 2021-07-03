<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('iblog::category.form.title')) !!}
        <?php $old = $category->hasTranslation($lang) ? $category->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iblog::category.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("{$lang}.slug") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[slug]", trans('iblog::category.form.slug')) !!}
        <?php $old = $category->hasTranslation($lang) ? $category->translate($lang)->slug : '' ?>
        {!! Form::text("{$lang}[slug]", old("{$lang}.slug",$old), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('iblog::category.form.slug')]) !!}
        {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
    </div>
    <?php $old = $category->hasTranslation($lang) ? $category->translate($lang)->description : '' ?>
    <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
        @editor('description', trans('iblog::category.form.description'), old("$lang.description", $old), $lang)
    </div>


    @if (config('asgard.iblog.config.fields.category.partials.translatable.edit') && config('asgard.iblog.config.fields.category.partials.translatable.edit') !== [])
    @foreach (config('asgard.iblog.config.fields.category.partials.translatable.edit') as $partial)
    @include($partial)
    @endforeach
   @endif
</div>

