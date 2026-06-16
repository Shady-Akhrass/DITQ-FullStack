@extends('frontsite.layout.master')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v15.0"
        nonce="GMvlQ1kt"></script>
    <!-- Start header -->

    <div class="title">
        <h2><a href="#">قسم تحفيظ القرآن الكريم</a></h2>
    </div>


<style>
    /* hide inactive slides */
.carousel-inner .carousel-item:not(.active) {
    display: none;
}

 set slide transition duration 
.carousel-item {
    transition: transform 1s ease-in-out;
}

 set the container height and position 
.container {
    position: relative;
    height: 400px;
}

 set the position and style of the carousel indicators 
.carousel-indicators {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 15;
    list-style: none;
    margin: 0;
    padding: 0;
}

.carousel-indicators li {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 0 5px;
    border-radius: 50%;
    background-color: #fff;
    cursor: pointer;
}

.carousel-indicators li.active {
    background-color: #000;
}

/* add styles for the previous and next arrows */
.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 15;
    width: 30px;
    height: 30px;
    margin: 0;
    border-radius: 50%;
    border: none;
    background-color: rgba(255, 255, 255, 0.8);
    opacity: 0.5;
    cursor: pointer;
}

/*.carousel-control-prev:hover,*/
.carousel-control-next:hover {
    opacity: 1;
}

<!--.carousel-control-prev {-->
    left: 20px;
}

.carousel-control-next {
    right: 20px;
}

</style>
 <div class="image-siled">
    <div class="container">
        <div class="cont s--inactive">
            <!-- cont inner start -->
            <div class="cont__inner">
                <!-- el start -->
                @foreach ($memorization_images as $image)
                    <div class="el">
                        <div class="el__overflow">
                            <div class="el__inner">
                                <div class="el__bg" style="background-image">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="">
                                </div>
                                <div class="el__preview-cont"></div>
                                <div class="el__content">
                                    <div class="el__close-btn"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- cont inner end -->
        </div>

        <div class="dis">
            <div class="discraption">
                <h3>عن القسم : </h3>
                <p class="p-list" style="direction:rtl;unicode-bidi: bidi-override; width:100%;overflow: auto; white-space: pre-line; margin: 1em 0; display: block">
                    {{ $memorizations[0]->about }}
                </p>
            </div>

            <div class="ifram">
                <div class="fb-page" data-href="https://www.facebook.com/dar.etqan.gaza" data-tabs="timeline" data-width="396" data-height="530" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/dar.etqan.gaza" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/dar.etqan.gaza">الإتقان لتعليم القرآن الإدارة العامة</a>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<!--        <script>-->
<!--            $(document).ready(function(){-->
    <!--// Activate Carousel-->
<!--    $("#carouselExampleIndicators").carousel();-->

    <!--// Set interval time-->
<!--    var interval_time = 7000;-->

    <!--// Set interval function-->
<!--    var slider_interval = setInterval(function() {-->
<!--        $("#carouselExampleIndicators").carousel('next');-->
<!--    }, interval_time);-->

    <!--// Pause on mouseover-->
<!--    $('#carouselExampleIndicators').mouseover(function(){-->
<!--        clearInterval(slider_interval);-->
<!--    });-->

    <!--// Resume on mouseout-->
<!--    $('#carouselExampleIndicators').mouseout(function(){-->
<!--        slider_interval = setInterval(function() {-->
<!--            $("#carouselExampleIndicators").carousel('next');-->
<!--        }, interval_time);-->
<!--    });-->
<!--});-->

<!--        </script>-->
    @endsection


    @section('title')
        قسم تحفيظ القرآن الكريم
    @endsection
