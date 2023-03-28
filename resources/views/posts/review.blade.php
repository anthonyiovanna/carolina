@extends('layouts.app')

@section('content')

    <h1>Review Post</h1>

    <div>
        <p><strong>Title:</strong> {{ $post['title'] }}</p>
        <p><strong>Description:</strong> {{ $post['description'] }}</p>
        <p><strong>Category:</strong> {{ $post['category']['name'] }}</p>
        <p><strong>Subcategory:</strong> {{ $post['subcategory']['name'] }}</p>
        <p><strong>Subsubcategory:</strong> {{ $post['subsubcategory']['name'] }}</p>
        <p><strong>Price:</strong> {{ $post['price'] }}</p>
        <p><strong>Images:</strong></p>
        <ul>
            @foreach ($post['images'] as $image)
                <li><img src="{{ $image['url'] }}" alt="{{ $image['name'] }}"></li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <input type="hidden" name="post" value="{{ json_encode($post) }}">
        <button type="submit">Submit Post</button>
    </form>

@endsection
