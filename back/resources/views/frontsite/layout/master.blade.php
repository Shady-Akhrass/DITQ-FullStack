<head>
    <!--<meta charset="UTF-8" />-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('meta')
    <title>
        @yield('title')
    </title>
    
    <!-- logo -->
    <link rel="icon" href="{{ asset('image/logo.icon') }}" />

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"-->
    <!--    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->


    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    {{-- 
    <meta name="description" content="Page Description">
    <meta name="keywords" content="keyword1, keyword2, keyword3"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- link bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <!-- normalize CSS -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <!-- all.min CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <!-- styel CSS -->
    <link rel="stylesheet" href="{{ asset('css/styel.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />

    <!-- CSS -->

    <link rel="stylesheet" href="{{ asset('css/style-cards.css') }}" />
    <!-- Sldier الأقسام -->
    <link rel="stylesheet" href="{{ asset('css/Quran_memorization.css') }}">


    <link href="https://rawgit.com/kenwheeler/slick/master/slick/slick-theme.css" rel="stylesheet" crossorigin />
    <link href="https://rawgit.com/kenwheeler/slick/master/slick/slick.css" rel="stylesheet"crossorigin />

    <!-- link Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa+Ink&family=Open+Sans:wght@300;400;500;700&family=Work+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/floating-wpp.css') }}" />
    <script type="text/javascript" src="{{ asset('js/floating-wpp.js') }}"></script>



  

</head>

<body>
    <div id="fb-root"></div>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v15.0"
        nonce="FnlOFCj2"></script>


    <div id="myButton"></div>

  <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap" rel="stylesheet">

    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @include('frontsite.layout.Header')
    @yield('content')
    @include('frontsite.layout.footer')


    <script>
        window.jQuery || document.write('<script src='
            {{ asset('js/vendor/jquery-1.9.1.min.js') }} '><\/script>')
    </script>




</body>



</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js" crossorigin></script>
<script src="https://rawgit.com/kenwheeler/slick/master/slick/slick.js" crossorigin></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js" crossorigin></script>
<script src="{{ asset('js/js.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin></script>

<script src="{{ asset('js/jquery.carousel-line-arrow.js') }}"></script>

{{-- image slider main --}}
<script src="{{ asset('js/slider.js') }}"></script>
<script src="{{ asset('js/nav.js') }}"></script>
<!-- card-Geniuse js -->

<!-- reveal js -->
<script src="{{ asset('js/reveal.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

{{-- JavaScript  --}}
<script src="{{ asset('js/script.js') }}"></script>

<script src="{{ asset('js/Quran_memorization.js') }}"></script>



<script script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" crossorigin></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js" crossorigin></script>

<script src="https://rawgit.com/kenwheeler/slick/master/slick/slick.js" crossorigin></script>


<script src="{{ asset('js/pagination.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" crossorigin></script>


<script src="{{ asset('js/counter_and_btn.js') }}"></script>



<script type="text/javascript" src="{{ asset('js/floating-wpp.js') }}"></script>
<script src="{{ asset('js/card-Geniuse.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $("#myButton").floatingWhatsApp({
            phone: "+972 59-288-9891",
            popupMessage: "هل تحتاج تتواصل بشكل أسرع ؟ ",
            message: "السلام عليكم ورحمة الله أريد أن..",
            showPopup: true,
            showOnIE: false,
            headerTitle: "اتصل بنا ",
            headerColor: "#893f32",
            backgroundColor: "#893f32",
            buttonImage: '<img src="{{ asset('image/whatsapp.svg') }}"/>',
        });
    });
</script>

<script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>


<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"-->
<!--    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">-->
<!--</script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"-->
<!--    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">-->
<!--</script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"-->
<!--    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">-->
<!--</script>-->