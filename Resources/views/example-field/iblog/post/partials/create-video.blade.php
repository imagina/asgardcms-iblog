<div class='form-group{{ $errors->has("options.video") ? ' has-error' : '' }}'>
    {!! Form::label("options[video]", 'Video Principal') !!}
    {!! Form::text("options[video]", old("options.video"), ['class' => 'form-control', 'placeholder' => 'video']) !!}
    {!! $errors->first("options.video", '<span class="help-block">:message</span>') !!}
</div>