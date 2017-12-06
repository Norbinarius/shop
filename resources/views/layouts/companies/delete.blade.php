@extends('layouts.app')

@section('title',  trans('messages.deletion'))

@section('main')
    <p>{{trans('messages.areyousure')}}</p>
    {{
        Form::model($entity, [
            'method' => 'DELETE',
            'route' => [
                'components.destroy',
                'id' => $entity->id
            ]
        ])
    }}

    {{ Form::submit(trans('messages.confirm'), ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@endsection