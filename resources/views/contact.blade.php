{{-- @extends('layouts.main')
@section('title', $title)
@section('content')
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        <p>Welcome To {{ $title }} Page</p>
    </div>
    @endsection --}}

<x-layout :title="$title">
    <!-- Your content -->
    <p>Welcome to {{ $title }} page</p>
</x-layout>
