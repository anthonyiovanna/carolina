@extends('layouts.app')

@section('content')

    <create-post-component
        :user="{{ auth()->user() }}"
        :categories="{{ $categories }}"
        :subcategories="{{ $subcategories }}"
        :subsubcategories="{{ $subsubcategories }}">
    </create-post-component>

@endsection

