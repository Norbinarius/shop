@extends('layouts.app')

@section('title', $device->company->name.' '.$device->model_name)

@section('main')
    <div class="row">
        <div class="col-sm-6">
            <img src= "{{ asset('/storage/images/' . $device->image) }}" class="img-thumbnail">
        </div>
        <div class="col-sm-6">
            <h1>{{$device->price.' Руб.'}}</h1>
            <a href="{{ route('layouts.AddToBucket', $device->id)}}">
            <button class="btn btn-primary btn-buy"<?php
                if ($device->ammount <= 0){
                    echo 'disabled';
                }?>>Добавить в корзину</button>
            </a>
                <h4><?php
                    if ($device->ammount > 0){
                        echo 'Есть в наличии';
                    } else {
                        echo 'Нет в наличии';
                    }?>
                </h4>
            <a href="{{ route('layouts.feed', [
                        'id' => $device->id
                        ]) }}">
                <img src="https://www.w3schools.com/xml/pic_rss.gif" width="36" height="14">
            </a>
        </div>
        <div class="col-sm-12">
            <hr>
            <h2>Описание товара</h2>
            <hr>
            <span style="white-space: pre-line"> {{$device->disc}}</span>
        </div>
    </div>
@endsection