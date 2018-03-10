@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div class="row">
        <div class="col-md-10">
            <p>
                Publicado por <a href="#">{{ $post->user->name }}</a>
                {{ $post->created_at->diffForHumans() }}
                en <a href="{{ $post->category->url }}">{{ $post->category->name }}</a>
                @if ($post->pending)
                    <span class="label label-warning">Pendiente</span>
                @else
                    <span class="label label-success">Completado</span>
                @endif
            </p>

            {!! $post->vote_component !!}

            {!! $post->safe_html_content !!}

            @if (auth()->check())
                @if (!auth()->user()->isSubscribedTo($post))
                    {!! Form::open(['route' => ['posts.subscribe', $post], 'method' => 'POST']) !!}
                        <button type="submit" class="btn btn-primary">Suscribirse al post</button>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['posts.unsubscribe', $post], 'method' => 'DELETE']) !!}
                        <button type="submit" class="btn btn-default">Desuscribirse del post</button>
                    {!! Form::close() !!}
                @endif
            @endif

            <hr>

            <h4>Comentarios</h4>

            @foreach($post->latestComments as $comment)
                <article class="{{ $comment->answer ? 'answer' : '' }}">
                    {{ $comment->comment }}

                    @if(Gate::allows('accept', $comment) && !$comment->answer)
                        {!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST']) !!}
                        <button type="submit">Aceptar respuesta</button>
                        {!! Form::close() !!}
                    @endif
                </article>

                <hr>
            @endforeach

            {!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST']) !!}

                {!! Field::textarea('comment') !!}

                <button type="submit">Publicar comentario</button>

            {!! Form::close() !!}
        </div>
        @include('posts.sidebar')
    </div>
@endsection
