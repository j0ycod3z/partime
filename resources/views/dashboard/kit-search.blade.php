{{-- resources/views/dashboard/kit-search.blade.php --}}
@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 px-4">
        <x-kit-results-modal :results="$results" />
    </div>
@endsection
