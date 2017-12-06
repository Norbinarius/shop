@extends('layouts.appMain')

@section('title', 'Просмотр товаров')

@section('filters')
    {{ Form::open(array('route' => 'layouts.filters', 'method' => 'GET')) }}
    <div class="row">
        <div class="col-sm-4">
            Компания-производитель
            {{ Form::select('companies', ['empty' => 'Все компании'] + $companies , null, ['class' => 'form-control'])}}
        </div>
        <div class="col-sm-4">
            Ценовой Диапозон (Руб.)
            <div class="numbers">
                {{ Form::number('from', 0, ['class' => 'form-control']) }}
            </div>
            <div class="numbers">
                {{ Form::number('to', $maxprice, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-sm-4 col-sm-offset-8">
            <a href="{{ route('layouts.filters')}}">
                <button class="btn btn-primary btn-check" type="submit">Применить фильтры</button>
            </a>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('main')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="row">
        @foreach ($devices as $device)
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <h4>{{$device->company->name.' '.$device->model_name}}</h4>
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('layouts.showItem', [
                        'id' => $device->id
                        ]) }}">
                        <img src= "{{ asset('/storage/images/' . $device->image) }}" class="images-preview">
                        </a>
                        <div class="col-sm-6">
                            <h4><?php
                                if ($device->ammount > 0){
                                    echo 'Есть в наличии';
                                } else {
                                    echo 'Нет в наличии';
                                }?>
                            </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{$device->price.' Руб.'}}</h4>
                        </div>
                        <a href="{{ route('layouts.showItem', [
                        'id' => $device->id
                        ]) }}">
                        <button class="btn btn-primary btn-check">Купить</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{$devices->links()}}
    </div>
@endsection