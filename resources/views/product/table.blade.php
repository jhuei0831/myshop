@extends('layouts.app')
@section('content')
<h1>商品一覽</h1>
<div class="card">
    <div class="card-header" align="right">
        <form action="/product/table/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search products">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    <button type="button" class="btn btn-default"><a href="{{ route('product.index') }}" style="color: black"><i class="fas fa-images"></i></a></button>
                    <button type="button" class="btn btn-default"><a href="{{ route('product.table') }}" style="color: black"><i class="fas fa-undo-alt"></i></a></button>
                </span>
            </div>
        </form>
    </div>
    <br>
    <div class="card-body" align="center">
        <table class="table">
            <tr align="center">
                <th>商品名稱</th>
                <th>價格</th>
                <th>操作</th>
            </tr>
            @forelse($products as $product)
            <tr align="center">
                <td>
                    <h5><a href="/product/{{ $product->id }}">{{ $product->title }}</a></h5>
                </td>
                <td>
                    ${{ $product->price }}
                </td>
                <td>
                    <button class="btn btn-primary btn-add-to-cart" data-id="{{ $product->id }}">加入購物車</button>
                </td>
            </tr>
            @empty
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">目前無任何商品</h1>
                </div>
            </div>
            @endforelse
        </table>
    </div>
    <div class="card-footer pagination justify-content-end">
        {!! $products->links("pagination::bootstrap-4") !!}
    </div>
</div>

<input type="hidden" name="amount" value="1">
@endsection

@section('scriptsAfterJs')
<script>
    $(document).ready(function () {
            @include('product.add2cart')
        });
</script>
@endsection

@section('my_menu')
<li class="nav-item">
    <a class="nav-link" href="/home">回控制台</a>
</li>
@stop