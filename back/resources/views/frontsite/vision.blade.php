@extends('frontsite.layout.master')
@section('content')
    <div class="message-section" id="message">
        <div class="container">
            <div class="about-dar">

                <div class="target">
                    <div class="title-1">
                        <h2><a href="#">رؤيتنا</a></h2>
                    </div>
                    <div>
                        <p>
                            {{ $visions[0]->vision }}
                        </p>
                    </div>
                </div>

                <div class="vision">
                    <div class="title-1">
                        <h2><a href="#">رسالتنا</a></h2>
                    </div>

                    <p>
                        {{ $visions[0]->mission }}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('title')
    دار الإتقان لتعليم القران
@endsection
