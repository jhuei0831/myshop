{{-- <header class="page-header">
    <img src="{{ URL('/FotoJet.jpg')}}" class="center">
</header> --}}
{{-- @foreach($photos as $slider)
<img src="{{url('storage')}}/{{$slider->image}}" alt="{{$slider->title}}" width="250" height="150"> <br />
@endforeach --}}
<div id="carouselExampleControls" class="carousel slide container" data-ride="carousel" data-interval="3000">

    {{-- <ol class="carousel-indicators">
        @foreach( $photos as $key=>$photo )
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
    class="{{ $loop->first ? 'active' : '' }}"></li>
    @endforeach
    </ol> --}}

    <div class="carousel-inner" role="listbox">
        @foreach( $photos as $photo )
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" align="center">
            <img class="d-block img-fluid" src="{{ Storage::disk('local')->url($photo->image) }}" alt="{{ $photo->title }}">
            <div class="carousel-caption d-none d-md-block">
                {{-- <h3>{{ $photo->title }}</h3>
                <p>{{ $photo->descriptoin }}</p> --}}
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>