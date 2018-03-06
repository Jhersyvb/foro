@extends('layouts.app')

@section('content')
    <h1>{{ $category->exists ? 'Posts de ' . $category->name : 'Posts' }}</h1>

    <ul>
        @foreach($posts as $post)
            @include('posts.item', compact('post'))
        @endforeach
    </ul>

    {{ $posts->render() }}

    {!! Menu::make($categoryItems, 'nav categories') !!}
@endsection
