@extends('frontsite.layout.master')

@section('content')
    <div class="clues">
        <div class="container">
            <div class="title">
                <h2><a href="#">أدلة الدار</a></h2>
            </div>
            <div class="pdf">
                <div class="pdf-main">
                        <embed src=" {{ asset('storage/' . $clues[0]->pdf) }}" width="800" height="700" />
                </div>
                <div class="tweter">
                    <a class="twitter-timeline" data-lang="ar" data-width="300" data-height="700"
                        href="https://twitter.com/dar_etqan?ref_src=twsrc%5Etfw">Tweets by dar_etqan</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>

            </div>

        </div>
    </div>


    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>

    </button>
    <!-- javaScript Button Go to Top -->
    <script src="{{ asset('js/btn.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- javaScript Counter -->
    <script src="{{ asset('js/counter.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- <script src="js/slider.js"></script> -->
    <script src="{{ asset('js/js.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.carousel-line-arrow.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection

@section('title')
    أدلة الدار
@endsection
