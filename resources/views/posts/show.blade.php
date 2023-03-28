@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <h1 class="text-2xl font-bold mb-4 md:mb-0">{{ $post->title }}</h1>
            <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <div class="border rounded-lg overflow-hidden">
                    <img class="w-full h-auto" src="{{ $post->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $post->title }}">
                </div>
                <div class="mt-4 flex flex-wrap -mx-2">
                    @foreach($post->getMedia('images') as $image)
                        <div class="w-1/2 px-2 mb-4">
                            <div class="border rounded-lg overflow-hidden">
                                <img class="w-full h-auto" src="{{ $image->getUrl('thumb') }}" alt="{{ $post->title }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:w-1/2">
                <p class="mb-4">{{ $post->description }}</p>
                <p class="mb-4"><strong>Price:</strong> ${{ $post->price }}</p>
                <p class="mb-4"><strong>Category:</strong> {{ $post->category->name }}</p>
                <p class="mb-4"><strong>Subcategory:</strong> {{ $post->subcategory->name }}</p>
                <p class="mb-4"><strong>Subsubcategory:</strong> {{ $post->subsubcategory->name }}</p>
            </div>
        </div>
    </div>
@endsection
