@extends('frontsite.layout.master')

<head>
    @section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="
دار الإتقان مؤسسة تهتم بتعليم القرآن الكريم سعياً للخيرية؛ عبر
برامج تعليمية وتربوية إبداعية ، وخبرات ريادية إدارية، ومناهج
متطورة وطرائق مستحدثة وكادر كفء، بشتى الوسائل المتاحة.">
    <meta name="keywords"
        content="دار الإتقان, ديوان الحفاظ, دورات تجويد،أسانيد،التربية والمواهب الابداعية ،دار الإتقان لتعليم القرآن ،نوابغ الآتقان ،صوتيات الإتقان ، أدلة الدار، كلمة الرئيس، مجلس الأدارة">
    @endsection
</head>
<style>
    @media(max-width:991px) {
.featured-brand .brand-image{
        height: 100%;
        max-height: 27%;
}
    
}
</style>
@section('content')
    <!-- partial:index.partial.html -->
    {{-- @for ($i = 0; $i < count($images); $i++) --}}
    <div class="featured-brand-carousel">

        <div class="timer-wrap d-none" style="direction: rtl">
            <div class="timer">
                <div class="numeral">
                    <span class="current"></span> / <span class="total"></span>
                </div>
                <canvas class="canvas-timer" width="100" height="100"></canvas>
            </div>
        </div>

        <div class="region-wrap">

            <div class="component-wrap">
                <div class="featured-brand">
                    <div class="media-wrap">
                        <picture>

                            <img class="brand-image"src="{{ asset('storage/' . $images[0]->image) }}" itemprop="image" />
                        </picture>
                        <i class="brand-overlay"></i>
                    </div>


                </div>
            </div>
            <div class="component-wrap">
                <div class="featured-brand">
                    <div class="media-wrap">
                        <picture>

                            <img class="brand-image" src="{{ asset('storage/' . $images[1]->image) }}" itemprop="image" />
                        </picture>
                        <i class="brand-overlay"></i>
                    </div>


                </div>
            </div>
            <div class="component-wrap">
                <div class="featured-brand">
                    <div class="media-wrap">
                        <picture>

                            <img class="brand-image" src="{{ asset('storage/' . $images[2]->image) }}" itemprop="image" />
                        </picture>
                        <i class="brand-overlay"></i>
                    </div>


                </div>
            </div>
        </div>
    </div>
    
       <div class="pohne-bac">

    </div>
    {{-- @endfor --}}
    <!-- partial -->

    <br>

    <!-- Start new-item -->
    <div class="new-item reveal main-new">
        <div class="title">
            <h2><a href="{{ route('index') }}">أخبار الدار</a></h2>
        </div>

        <div class="container">
            @if (count($newss) > 3)
              @for ($i = count($newss) - 1; $i >= count($newss) - 4; $i--)
                    <a href="{{ url('/itqan/news/' . str_replace(' ', '-', $newss[$i]->title) . '/details') }}" class="a-card">
                        <div class="card">
                            <img src="{{ asset('storage/' . $newss[$i]->image) }}" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <h5 class="card-text">
                                    {{ $newss[$i]->title }}
                                </h5>

                            </div>

                            <button class="button">عرض التفاصيل</button>
                            <p class="date">{{ substr($newss[$i]->created_at, 0, 11) }}</p>

                        </div>
                    </a>
                @endfor
            @else
             @for ($i = count($newss) - 1; $i >= 0; $i--)
                    <a href="{{ url('/itqan/news/' . str_replace(' ', '-', $newss[$i]->title) . '/details') }}" class="a-card">
                        <div class="card">
                            <img src="{{ asset('storage/' . $newss[$i]->image) }}" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <h5 class="card-text">
                                    {{ $newss[$i]->title }}
                                </h5>

                            </div>

                            <button class="button">عرض التفاصيل</button>
                            <p class="date">{{ substr($newss[$i]->created_at, 0, 11) }}</p>

                        </div>
                    </a>
                @endfor
            @endif
        </div>

    </div>
    <!-- End new-item -->

    <!-- Start message-section -->
    <div class="message-section" id="message">
        <div class="container">
            <div class="about-dar">

                <div class="target reveal">
                    <div class="title-1">
                        <h2><a href="#">رؤيتنا</a></h2>
                    </div>
                    <div>
                        <p>
                            {{ $homes[0]->vision }}
                        </p>
                    </div>
                </div>

                <div class="vision reveal">
                    <div class="title-1">
                        <h2><a href="#">رسالتنا</a></h2>
                    </div>

                    <p>
                        {{ $homes[0]->mission }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- End message-section -->

    <div class="youtube reveal">
        <div class="container">
            <div class="title">
                <h2><a href="https://www.youtube.com/channel/UCNZ9hzVx-Q4kwSJCfiJuLUA"  target="_blank">المكتبة المرئية</a></h2>
            </div>

            <div class="main-video">
                <iframe src="{{ $youtubes[0]->main }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="secend-video">
                <div class="ved-1">
                    <iframe src="{{ $youtubes[0]->secondary1 }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <div class="ved-2">
                    <iframe src="{{ $youtubes[0]->secondary2 }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>

    <!-- Start Achievements -->
    <div class="Achievements ">
        <div class="container reveal">
            <div class="row">
                <div class="titles">
                    <h2><a href="">إنجازات الدار خلال 17 عامًا</a></h2>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-person"></i>
                        </div>
                        <h3>طالب وطالبة</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->student_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <h3>عدد الحلقات</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->lesson_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h3>حفاظ كتاب الله</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->memorizing_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-person"></i>
                        </div>
                        <h3>عدد المحفظين والمحفظات</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->teacher_number }}">0</div>
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 Achievements-pho AchievPhone">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-users-line"></i>
                        </div>
                        <h3>عدد الدورات</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->course_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 AchievPhone">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-person-shelter"></i>
                        </div>
                        <h3>مخيمات قرانية</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->camp_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 AchievPhone">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h3>المسابقات</h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->contest_number }}">0</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 AchievPhone">
                    <div class="counter blue">
                        <div class="counter-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3>عدد الاحتفالات والتكريمات </h3>
                        <span class="counter-value">
                            <div class="num" data-goal="{{ $homes[0]->celebration_number }}">0</div>
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Achievements -->

    <div class="help">
        <div class="container reveal">

            <div class="title">
                <h2><a href=""> نوابغ الإتقان</a></h2>
            </div>

            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-Geniuse-wrapper swiper-wrapper">

                        @foreach ($geniuses as $geniuse)
                           

                                <div class="card-Geniuse swiper-slide">
                                    <a  href="{{ url('/itqan/geniuse/' . str_replace(' ', '-', $geniuse->name) . '/details') }}" class="a-card">
                                    <div class="image-content">
                                        <span class="overlay"></span>

                                        <div class="card-Geniuse-image">
                                            <img src="{{ asset('storage/' . $geniuse->image) }}" alt=""
                                                class="card-Geniuse-img" />
                                        </div>
                                    </div>

                                    <div class="card-Geniuse-content">
                                        <h2 class="name">{{ $geniuse->name }}</h2>
                                        <?php
                                        $details = $geniuse->details;
                                        $details = explode(' ', $details);
                                        $details = implode(' ', array_slice($details, 0, 6));
                                        ?>

                                     <p class="description">
                                       
                                        {{ $details }}
                                        
                                    </p>
                                        <button class="button">عرض القصة</button>
                                    </div>
                                    </a>
                                </div>
                            
                        @endforeach


                    </div>
                </div>

                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Start Geniuse -->
    <div class="Geniuse reveal">

        <div class="container">

            <div class="title">
                <h2><a href="#">مشاريع تحتاج دعمكم</a></h2>
            </div>


            <div class="blog-slider">
                <div class="blog-slider__wrp swiper-wrapper">
                    @foreach ($donate as $don)
                        <div class="blog-slider__item swiper-slide">
                            <div class="blog-slider__img">
                                <img src="{{ asset('storage/' . $don->image) }}" alt="">
                            </div>
                            <div class="blog-slider__content">
                                <span class="blog-slider__code">{{ $don->date }}</span>
                                <div class="blog-slider__title">{{ $don->title }}</div>
                                <div class="blog-slider__text">
                                    {{ $don->details }}
                                </div>
                                <a href="https://wa.me/+972592889891" target="_blank" class="blog-slider__button">تبرع
                                    الان</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="blog-slider__pagination"></div>
            </div>

        </div>


        <!-- End Geniuse -->
    </div>
  <div class="partners">
        <div class="container">
            <div class="title">
                <h2><a href="#">شركاء النجاح</a></h2>
            </div>
            <div class="partners-logo">
                <div class="logo-image">
                    <img src="{{ asset('image/ead.jpg') }}" alt="Logo" />
                </div>
                <div class="logo-image">
                    <img src="{{ asset('image/peduli.jpg') }}" alt="Logo" />
                </div>
                <div class="logo-image">
                    <img src="{{ asset('image/nabaa.jpeg') }}" alt="Logo" />
                </div>
                <div class="logo-image">
                    <img src="{{ asset('image/rabow.jpeg') }}" alt="Logo" />
                </div>
                <div class="logo-image">
                    <img src="{{ asset('image/samee.jpeg') }}" alt="Logo" />
                </div>
            </div>
        </div>
    </div>
    <div class="sound reveal">
        <div class="container">
            <div class="image">

                <img src="{{ asset('image/phone-with-logo.jpg') }}" alt="">
            </div>
            <div class="soundcloud">
                <div class="title">
                    <h2><a href="#">صوتيات الإتقان</a></h2>
                </div>
                <div class="iframe">
                    <iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay"
                        src="{{ $sound[0]->main }}"></iframe>
                    <div
                        style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;">
                        <a href="{{ $sound[0]->link }}" title="{{ $sound[0]->title }}" target="_blank"
                            style="color: #cccccc; text-decoration: none;">{{ $sound[0]->title }}</a> · <a
                            href="{{ $sound[0]->playlist }}" title="{{ $sound[0]->name }}" target="_blank"
                            style="color: #cccccc; text-decoration: none;">{{ $sound[0]->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div id="loader-wrapper">-->
    <!--    <div id="loader"></div>-->

    <!--    <div class="loader-section section-left"></div>-->
    <!--    <div class="loader-section section-right"></div>-->

    <!--</div>-->
@endsection
@section('title')
دار الإتقان لتعليم القرآن 
@endsection
