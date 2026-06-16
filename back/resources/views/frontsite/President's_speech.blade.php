@extends('frontsite.layout.master')
@section('content')
    <div class="main-speech">
        <div class="container">
            <div class="speech">
                <h3 class="main-word">كلمة رئيس الدار</h3>
                <p class="word-ps">
                    {{ $speechs[0]->speech }}
                </p>

            </div>
            @foreach ($director as $dir)
                    <div class="image_President">
                        <img src="{{ asset('storage/' . $dir->image) }}" alt="">
                        <h4 class="name-p">{{ $dir->name }}</h4>
                        <h5>
                            {{ $dir->postion }}
                        </h5>
                    </div>
                    @php
                    break;
                    @endphp
            @endforeach

        </div>
    </div>
@endsection

@section('title')
    كلمة رئيس الدار
@endsection
