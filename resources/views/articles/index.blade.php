@extends ('layout')

@section ('content')
<div id="wrapper">
    <div id="page" class="container">
        @forelse ($articles as $article)
        <div id="content">

            <div class="title">
                <a href="{{$article->path()}}"><h1>{{$article->title}}</h1></a>

            </div>
            <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
           <p>{!!$article->excerpt!!}</p>
        </div>
        @empty
        <h1>Bij deze tag horen nog geen relevante artikelen.</h1>
        @endforelse
    </div>
</div>


@endsection
