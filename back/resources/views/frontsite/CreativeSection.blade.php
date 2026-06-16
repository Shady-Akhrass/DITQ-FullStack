@extends('frontsite.layout.master')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v15.0"
        nonce="GMvlQ1kt"></script>
    <!-- Start header -->

    <div class="title">
       <h2><a href="#">قسم التربية والمواهب الإبداعية</a></h2>
    </div>



    <div class="image-siled">
        <div class="container">


           
 <div class="image-siled">
        <div class="container">


            <div class="cont s--inactive">
                <!-- cont inner start -->
                <div class="cont__inner">
                    <!-- el start -->
                    @foreach ($creative_images as $image)
                        <div class="el">
                            <div class="el__overflow">
                                <div class="el__inner">
                                    <div class="el__bg" style="background-image">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="">

                                    </div>
                                    <div class="el__preview-cont">
                                    </div>
                                    <div class="el__content">

                                        <div class="el__close-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
                </div>
            </div>
            <div class="dis">
                <div class="discraption">
                    <h3>عن القسم : </h3>


                    <p class="p-list">
                        {{ $creatives[0]->about }}
                    </p>

                </div>

                <div class="ifram">
                    <div class="fb-page" data-href="https://www.facebook.com/dar.etqan.gaza" data-tabs="timeline"
                        data-width="396" data-height="530" data-small-header="false" data-adapt-container-width="true"
                        data-hide-cover="true" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/dar.etqan.gaza" class="fb-xfbml-parse-ignore"><a
                                href="https://www.facebook.com/dar.etqan.gaza"> الإتقان لتعليم القرآن الإدارة
                                العامة</a></blockquote>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('title')
    فسم التربية والمواهب الإبداعية
@endsection
