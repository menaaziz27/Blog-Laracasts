<x-layout>
@foreach($posts as $post)
    <article class="{{ $loop->even ? "active" : ""  }}">
        <h1><a href="/posts/{{$post->slug}}">{{ $post->title  }}</a></h1>
        <p>
            <a href="categories/{{$post->category->slug}}">{{ $post->category->name  }}</a>
        </p>
        <div>
            {{ $post->body }}
        </div>
    </article>
        <hr>
@endforeach
</x-layout>
