@extends('frontsite.layout.master')

@section('content')
    <div id="myButton" href=></div>
  
    <main class="all-news ">
        <div class="title " id="myHeader">
            <h2><a>نتائج البحث</a></h2>
        </div>
        @if (count($news) != 0)
            <ul id="paginated-list" data-current-page="1" aria-live="polite">


                <div class="new-item ">

                    <div class="container" id="paginated-list" data-current-page="1" aria-live="polite">
                        @for ($i = count($news) - 1; $i >= 0; --$i)
                            <a a href="{{ url('/itqan/news/' . str_replace(' ', '-', $news[$i]->title) . '/details') }}"
                                class="a-card">

                                <div class="card">
                                    <img src="{{ asset('storage/' . $news[$i]->image) }}" />
                                    <div class="card-body">
                                        <h5 class="card-text" align="center">
                                            {{ $news[$i]->title }}
                                        </h5>
                                    </div>
                                    <button class="button">عرض
                                        التفاصيل
                                    </button>
                                    <p class="date" align="center">{{ substr($news[$i]->created_at, 0, 11) }}</p>
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
        @else
            <p class="result">لاتوجد نتائج </p>
        @endif

    </main>


    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
@endsection

@section('title')
    دار الإتقان لتعليم القران
@endsection
