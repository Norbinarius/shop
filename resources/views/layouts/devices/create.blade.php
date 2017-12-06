@extends('layouts.app')

@section('title',  trans('messages.creation'))

@section('main')

    {{
    Form::model($entity, [
        'files' => true,
        'method' => 'POST',
        'route' => [
            'devices.store'
        ]
        ])
}}

<div class="form-horizontal">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label('Модель устройтва') }}
        </div>
        <div class="col-md-6">
            {{ Form::text('model_name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label('Описание') }}
        </div>
        <div class="col-md-6">
            {{ Form::textarea('disc', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label('Цена') }}
        </div>
        <div class="col-md-6">
            {{ Form::number('price', null, ['class' => 'form-control']) }}
        </div>
    </div>
  <div class="form-group">
            <div class="col-md-2 col-md-offset-2">
            {{ Form::label ('file', __ ('messages.image.file' ))}}
            </div>
            <div class="col-md-6">
            {{
            Form:: file('file', [
                'aria-describedby' => 'file-help',
                'class' => 'btn-block',
                ])
            }}
            <small id= "file-help" class="form-text text-muted">
                {{ __('messages.image.file.mimes' ) }}
            </small>
            </div>
        </div>
        <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label('Количество') }}
        </div>
        <div class="col-md-6">
            {{ Form::number('ammount', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label(null, 'Компания-производитель') }}
        </div>
        <div class="col-md-6">
        {{ Form::select('company_id', $companies , null, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {{ Form::submit(trans('messages.confirm'), ['class' => 'btn btn-primary'])}}
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection