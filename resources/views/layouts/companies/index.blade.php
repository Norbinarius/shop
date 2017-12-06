@extends('layouts.app')

@section('title', 'Компании-производители')

@section('main')
    <a href="{{ route('layouts.index') }}">
        <button class="btn btn-primary big-btn">Главная</button>
    </a>
    @can('action', \App\Companies::class)
    <a href="{{ route('companies.create') }}">
        <button class="btn btn-primary big-btn">Добавить</button>
    </a>
    @endcan
<table>
<tbody id="tasks-list" name="tasks-list">
    <tr>
        <th>Наименование</th>
        @can('action', \App\Companies::class)
            <th>Действие</th>
        @endcan
    </tr>
@foreach ($companies as $company)
    <tr task{{$company->id}}>
        <td>{{ $company->name }}</td>
        @can('action', \App\Companies::class)
        <td>
            <a href="{{ route('companies.edit', [
                'id' => $company->id
            ]) }}">
                <button class="btn btn-primary">{{ trans('messages.edit') }}</button>
            </a>
            <a href="{{ route('companies.delete', [
                'id' => $company->id
            ]) }}">
                <button class="btn btn-primary">{{ trans('messages.delete') }}</button>
            </a>
        </td>
        @endcan
    </tr>
@endforeach
</tbody>
</table>
    <div class="text-center">
        {{$companies->links()}}
    </div>
@endsection
