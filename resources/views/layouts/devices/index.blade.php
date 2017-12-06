@extends('layouts.app')


@section('title', trans('messages.devices.list'))


@section('main')
@foreach ($devices as $device)
<div id="{{$device->id.'modalbox'}}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{{$device->company->name.' '.$device->model_name}}</h4>
      </div>
      <div class="modal-body">
                  <img src= "{{ asset('/storage/images/' . $device->image) }}" class="img-responsive img-thumbnail">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endforeach
    <a href="{{ route('layouts.index') }}">
        <button class="btn btn-primary big-btn">{{ trans('messages.gomain') }}</button>
    </a>
    @can('action', \App\Devices::class)
    <a href="{{ route('devices.create') }}">
        <button class="btn btn-primary big-btn">{{ trans('messages.create') }}</button>
    </a>
    @endcan
<table>
    <tr>
        <th>Устройство</th>
        <th>Цена, руб.</th>
        <th>Изображение</th>
        <th>Количество</th>
        @can('action', \App\Devices::class)
            <th></th>
        @endcan
    </tr>
@foreach ($devices as $device)
    <tr>
        <td>{{$device->company->name.' '.$device->model_name}}</td>
        <td>{{ $device->price }}</td>
        <td>
            <a href="{{'#'.$device->id.'modalbox'}}" data-toggle="modal" id="imgfull"><img src= "{{ asset('/storage/images/' . $device->image) }}" class="img-responsive img-thumbnail images"></a>
        </td>
        <td>{{ $device->ammount }}</td>
        @can('action', \App\Devices::class)
        <td>
            <a href="{{ route('devices.edit', [
                'id' => $device->id
            ]) }}">
                <button class="btn btn-primary">{{ trans('messages.edit') }}</button>
            </a>
            <a href="{{ route('devices.delete', [
                'id' => $device->id
            ]) }}">
                <button class="btn btn-primary">{{ trans('messages.delete') }}</button>
            </a>
        </td>
        @endcan
    </tr>
@endforeach
</table>
    <div class="text-center">
        {{$devices->links()}}
    </div>

@endsection
