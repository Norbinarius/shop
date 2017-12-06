@extends('layouts.app')

@section('title', 'Новости')

@section('main')
    <div class="row">
        @for($i = 0; $i < 29; $i++)
            <div class="col-md-12 img-thumbnail big-btn">
                <div class="col-md-6">
                    <img src="{{ $images[$i+3]->src }}"/>
                </div>
                <div class="col-md-6">
                    <h3>{{ $titles[$i]->title }}</h3>
                    {{$desc[$i]->plaintext}}
                </div>
            </div>
        @endfor
    </div>
@endsection