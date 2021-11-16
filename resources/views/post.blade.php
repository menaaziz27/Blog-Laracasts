@extends ("layout")

@section("title")
    <title>my post</title>
@endsection


@section("content")
    <article>
        <h1>{{ $post->title  }}</h1>
        <div>
            {!! $post->body !!}
        </div>
    </article>
@endsection
