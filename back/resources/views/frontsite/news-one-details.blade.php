@extends('frontsite.layout.master')
@section('meta')
    <meta name="description" content="{{ $newss[0]->object }}">
    <meta name="keywords" content="{{ $newss[0]->title }}, news, details">
    <meta property="og:title" content="{{ $newss[0]->title }}">
    <meta property="og:description" content="{{ $newss[0]->object }}">
    <meta property="og:image" content="{{ asset('storage/' . $newss[0]->image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
@endsection

@section('content')
    <div class="new-one">
        <div class="container">
            <div class="path">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">الرئيسية - </a></li>
                    <li><a href="{{ route('index') }}">كافة الأخبار - </a></li>
                    <li aria-current="page"> التفاصيل</li>
                </ol>
            </div>

            <div class="content" dir>
                <div class="image-news">
                    <div class="titles">
                        <h3>{{ $newss[0]->title }}</h3>
                            
                        <div style="margin-top: 25px; margin-bottom: 10px; display: flex; gap: 10px;">
                            <button id="fbShareButton" style="border: none; background-color: brown; color: white; cursor: pointer; padding: 5px 10px; border-radius: 5px;">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button id="copyLinkButton" style="border: none; background-color: brown; color: white; cursor: pointer; padding: 5px 10px; border-radius: 5px;">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                        <hr class="hr">
                    </div>
                    
                    <div class="imags">
                        <img src="{{ asset('storage/' . $newss[0]->image) }}" alt="{{ $newss[0]->title }}" title ="{{ $newss[0]->title }}">
                    </div>
                    <pre style="direction:rtl; unicode-bidi: bidi-override; width:100%; overflow: auto; white-space: pre-line; margin: 1em 0; display: block">
                        <p dir="rtl">{{ trim($newss[0]->object) }}</p>
                    </pre>
                    <div class="imags">
                        <img src="{{ asset('storage/' . $newss[0]->subphotos1) }}" alt="">
                    </div>
                </div>
                <div class="ifram">
                    <div class="fb-page" data-href="https://www.facebook.com/dar.etqan.gaza" data-tabs="timeline"
                        data-width="400" data-height="100%" data-small-header="false" data-adapt-container-width="true"
                        data-hide-cover="true" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/dar.etqan.gaza" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/dar.etqan.gaza"> الإتقان لتعليم القرآن الإدارة العامة</a>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v15.0" nonce="GMvlQ1kt"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script>
        document.getElementById('copyLinkButton').addEventListener('click', function() {
            var id = "{{ $newss[0]->id }}"; // Assuming $newss[0]->id contains the ID of the news item
            var baseUrl = "https://ditq.org/itqan/news/";
            var detailsPath = "/details";
            var fullUrl = baseUrl + id + detailsPath;

            var dummy = document.createElement('input');
            document.body.appendChild(dummy);
            dummy.value = fullUrl;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
        });

        document.getElementById('fbShareButton').addEventListener('click', function() {
            var fbShareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
            window.open(fbShareUrl, 'facebook-share-dialog', 'width=800,height=600');
        });
    </script>
    <br>
    <br>
    <br>
@endsection

@section('title')
    {{ $newss[0]->title }}
@endsection