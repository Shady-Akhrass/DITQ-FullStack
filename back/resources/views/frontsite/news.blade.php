@extends('frontsite.layout.master')
@section('meta')
    @foreach ($newss as $news)
        <meta name="description" content="{{ $news->object }}">
        <meta name="keywords" content="{{ $news->title }}, news, details">
        <meta property="og:title" content="{{ $news->title }}">
        <meta property="og:description" content="{{ $news->object }}">
        <meta property="og:image" content="{{ asset('storage/' . $news->image) }}">
    @endforeach
@endsection
@section('content')

    <head>
        <title>قسم الاخبار</title>
        <meta charset="UTF-8">
        @foreach ($newss as $news)
            <meta name="description" content="{{ $news->object }} ">
            <meta name="keywords" content="{{ $news->titie }}">
        @endforeach
        <link rel="icon" href="{{ asset('image/logo.icon') }}" />
    </head>

    <div class="title" id="myHeader">
        <h2><a>أخبار الدار</a></h2>
    </div>
    <main class="all-news">

        <ul id="paginated-list" data-current-page="1" aria-live="polite">


           <div class="new-item  all-new-item">
    <div class="container" id="paginated-list" data-current-page="1" aria-live="polite">
         @for ($i = count($newss) - 1; $i >= 0; --$i)
            <a href="{{ url('/itqan/news/' . str_replace(' ', '-', $newss[$i]->title) . '/details') }}" class="a-card">
                <div class="card">
                    <img src="{{ asset('storage/' . $newss[$i]->image) }}"  />
                    <div class="card-body">
                        <h5 class="card-text" align="center">
                            {{ $newss[$i]->title }}
                        </h5>
                    </div>
                    <button class="button">عرض التفاصيل</button>
                    <p class="date" align="center">{{ substr($newss[$i]->created_at, 0, 11) }}</p>
                </div>
            </a>
        @endfor
    </div>
            </div>
        </ul>

        <nav class="pagination-container">
            <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                &lt;
            </button>

            <div id="pagination-numbers">

            </div>

            <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                &gt;
            </button>
        </nav>
    </main>
@endsection
@section('title')
    كافة الأخبار
@endsection
