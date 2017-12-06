@extends('layouts.app')

@section('title', 'Корзина')

@section('main')
    <?php if (count($items) > 0){?>
    <div class="row">
        <table>
            <tr>
                <th>Товар</th>
                <th>Цена, руб.</th>
                <th>Действия</th>
            </tr>
        @foreach ($items as $item)
                <tr>
                    <td><img src= "{{ asset('/storage/images/' . $item->image) }}" class="img-responsive img-thumbnail images">{{'       '.$item->name. ' ' .$item->model_name}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                    <a href="{{ route('layouts.deleteFromBucket', [
                        'id' => $item->id
                        ]) }}">
                        <button class="btn btn-primary">{{ trans('messages.delete') }}</button>
                    </a>
                    </td>
                </tr>
        @endforeach
            <tr>
                <th>Итог (Количество)</th>
                <th>Итог (Стоимость)</th>
                <th>Действия</th>
            </tr>
            <tr>
                @foreach( $total as $ttl)
                <td>{{'Всего товаров: '. $ttl->count }}</td>
                <td>{{ $ttl->total.' Руб.' }}</td>
                @endforeach
                <td>
                    <a href="{{ route('layouts.orderConfirm') }}">
                        <button class="btn btn-primary">Оформить заказ</button>
                    </a>
                </td>
            </tr>
        </table>
    </div>
    <div class="text-center">
    <?php } else {
        echo "Коризна пока что пуста :(";
    } ?>
    </div>
@endsection