@extends('layouts.app')
@section('content')
<h1>商品一覽</h1>
<div class="card">
    <div class="card-header" align="right">
        <form action="/product/image/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search products">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    <button type="button" class="btn btn-default"><a href="{{ route('product.table') }}"><i class="fas fa-list text-dark"></i></a></button>
                    <button type="button" class="btn btn-default"><a href="{{ route('product.index') }}"><i class="fas fa-undo-alt text-dark"></i></a></button>
                </span>
            </div>
        </form>
    </div>
    <br>
    <div class="card-body" align="center">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="{{ route('product.index') }}/{{ $product->id }}">
                                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->title }}" width="400">
                            </a>
                        </div>
                        <div class="card-footer text-center" style="background:white">
                            <h5 class="card-title"><a href="product/{{ $product->id }}" style="font-size:10px;">{{ $product->title }}</a></h5>
                                ${{ $product->price }}
                            <br><hr>
                            <button class="btn btn-primary btn-add-to-cart" data-id="{{ $product->id }}">加入購物車</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title">目前無任何商品</h1>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="card-footer pagination justify-content-end">
    {!! $products->links("pagination::bootstrap-4") !!}
</div>
<input type="hidden" name="amount" value="1">
@endsection

@section('scriptsAfterJs')
    @include('product.add2cart')
@endsection

@section('my_menu')
<li class="nav-item">
    <a class="nav-link" href="/home">回控制台</a>
</li>
@stop
