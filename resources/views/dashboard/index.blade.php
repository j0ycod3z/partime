@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-6 grid-rows-5 gap-4 p-8 h-full">
        <div class="col-span-6 col-start-1 row-start-1 border">
            Dashboard with subtitle
        </div>
        <div class="col-span-2 row-span-2 col-start-1 row-start-2 border">
            Short Introduction with button to modal
        </div>
        <div class="col-span-2 row-span-2 col-start-3 row-start-2 border">
            Short Introduction to modal
        </div>
        <div class="col-span-2 row-span-4 col-start-5 row-start-2 border">
            Summary of today
        </div>
        <div class="col-span-2 row-span-2 col-start-1 row-start-4 border">
            Empty for now
        </div>
        <div class="col-span-2 row-span-2 col-start-3 row-start-4 border">
            Empty for now
        </div>
    </div>
@endsection
