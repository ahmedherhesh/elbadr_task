@extends('master')
@section('title')
    <title>Home</title>
@endsection
@section('content')
    {{View::make('navbar')}}
    <div class="container top">
        <div class="row">
            @if (empty($items))
                <div class="col-md-12">
                    <h1 class="text-center text-secondary" style="margin-top:200px;font-size:70px">empty</h1>
                </div>
            @else
                @foreach ($items as $item)
                    <div class="col-md-3 col-sm-6 col-xs-12 bottom">
                        <div class="card box-shadow" >
                            <img class="card-img-top" src="{{asset('uploads/images/'.$item->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$item->item_name}}</h5>
                                <p class="card-text">{{$item->description}}</p>
                                <p class="card-text">Price : {{$item->price}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            

        </div>
    </div>
@endsection