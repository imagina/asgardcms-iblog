<div class='form-group{{ $errors->has("{$lang}.translatable_options.benefit") ? ' has-error' : '' }}'>
    <div class='form-group{{ $errors->has("{$lang}.translatable_options.benefit") ? ' has-error' : '' }}'>
        @editor('benefit', trans('iblog::post.form.benefit'), old("{$lang}.translatable_options.benefit"), $lang.'[translatable_options]')
    </div>
</div>