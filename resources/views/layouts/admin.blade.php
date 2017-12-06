@extends('layouts.app')

@section('title', 'Администрирование')

@section('main')

    <div class="form-horizontal">
        <div class="form-group">
            <div class="text-center">
                <a href="{{ route('companies.index') }}">
                    <button class="btn btn-primary btn-main">Компании-производители</button>
                </a>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <a href="{{ route('devices.index') }}">
                    <button class="btn btn-primary btn-main">Устройства</button>
                </a>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                    <button class="btn btn-primary btn-main">Заказы</button>
            </div>
        </div>
    </div>
@endsection