{{-- Layouting Using Template Inheritance --}}
{{-- @extends('layouts.main')
@section('title', $title)
@section('content')
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        <p>Welcome To My Home Page</p>
    </div>
@endsection --}}

{{-- Layouting Using Component Based --}}
<x-layout :title="$title">
    <!-- Your content -->
    <p>Welcome to my {{ $title }}</p>
</x-layout>
