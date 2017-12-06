@extends('layouts.app')

@section('title',  trans('messages.creation'))

@section('main')

    {{
    Form::model($entity, [
        'method' => 'PUT',
        'route' => [
            'companies.update',
            $entity->id
        ]
    ])
}}
<div class="form-horizontal">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::label(null, trans('messages.components.name')) }}
        </div>
        <div class="col-md-6">
            {{ Form::text('name', $entity->name, ['class' => 'form-control']) }}
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