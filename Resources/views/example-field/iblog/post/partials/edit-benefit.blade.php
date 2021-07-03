<div class='form-group{{ $errors->has("{$lang}.translatable_options.benefit") ? ' has-error' : '' }}'>
    <div class='form-group{{ $errors->has("{$lang}.translatable_options.benefit") ? ' has-error' : '' }}'>
        @php $old = $post->hasTranslation($lang) ? $post->translate($lang)->translatable_options->benefit??'' : '' @endphp
        @editor('benefit', trans('iblog::post.form.benefit'), old("{$lang}.translatable_options.benefit",$old), $lang.'[translatable_options]')
    </div>
</div>