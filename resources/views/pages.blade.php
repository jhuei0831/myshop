@extends('layouts.app')
@section('content')
@forelse($pages as $page)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{$page->title}}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@empty
@endforelse
@endsection