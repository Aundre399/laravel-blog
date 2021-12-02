<x-layout>




@foreach ($posts as $post )


<article>
    <h1>
    <a href= "/posts/{{$post->slug }}">
        {!! $post->title !!}
    </h1>
    </a>

    <div>
    {{ $post->excerpt }}
    </div>

</article>
@endforeach









</x-layout>



