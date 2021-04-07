@extends('layout')

@section('main')

    <div id="products" class="flex flex-wrap text-">

        @foreach($products as $product)
        <div class="p-3 w-full md:w-1/2 lg:w-1/3">
            <div class="product rounded border-gray-300 border">
                <img class="h-64 w-full object-cover" src="{{url('/')}}/images/{{$product->image}}" alt="">
                <div class="flex justify-between p-2 text-lg">
                    <div>{{$product->name}}</div>
                    <div class="font-bold">{{ \App\Libs\Common::withVAT($product->price,$product->vat) }}€</div>
                </div>
                <a class="bg-blue-700 text-white px-4 py-1 inline-block w-full text-center rounded-sm text-lg" href="{{url('/')}}/product/{{$product->id}}">Voir</a>
            </div>
        </div>
        @endforeach

    </div>

@endsection
