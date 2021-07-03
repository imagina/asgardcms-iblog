<div class='form-group{{ $errors->has("options.video") ? ' has-error' : '' }}'>
    {!! Form::label("options[video]", 'Video Principal') !!}
    @php $old = $post->options->video??'' @endphp
    {!! Form::text("options[video]", old("options.video",$old), ['class' => 'form-control', 'placeholder' => 'video']) !!}
    {!! $errors->first("options.video", '<span class="help-block">:message</span>') !!}
</div>