@extends('frontsite.layout.master')
@section('content')
    <div class="bac-story">



        <div class="container">

            <div class="image-story">

                <img src="{{ asset('storage/' . $geniuses[0]->image) }}" alt="">

            </div>


        </div>
        <div class="container">
            <h3 class="name-story"> {{ $geniuses[0]->name }} </h3>

        </div>
        <div class="container">
            <p class="story-details">
                {{ $geniuses[0]->details }}
            </p>
        </div>
    </div>
@endsection
@section('title')
    {{ $geniuses[0]->name }}
@endsection
