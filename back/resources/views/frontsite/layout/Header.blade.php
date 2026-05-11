
<header clsss="header">
    <nav>
        <div class="navbar">
            <i class='bx bx-menu'></i>
            <div class="logo">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" />
                </a>
            </div>

            <div class="nav-links">
                <div class="sidebar-logo">
                    <span class="logo-name">دار الإتقان لتعليم القران</span>
                    <i class='bx bx-x'></i>
                </div>
                <ul class="links">
                    <li><a href="{{ route('home') }}" class="actives">الرئيسية</a></li>
                    <li>
                        <a href="#">عن الدار</a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            <li><a href="{{ route('director') }}">مجلس الإدارة</a></li>
                            <li><a href="{{ route('vision') }}">الرؤية والرسالة</a></li>
                            <li><a href="{{ route('speech') }}">كلمة رئيس الدار</a></li>
                            <li><a href="{{ route('branche') }}">الفروع</a></li>
                       <li class="more">
                                 <span><a href="#"></a>
                                     <i class='bx bxs-chevron-right arrow more-arrow'></i>
                                 </span>
                                 <ul class="more-sub-menu sub-menu">
                                    
                                 </ul>
                             </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">أقسام الدار</a>
                        <i class='bx bxs-chevron-down js-arrow arrow '></i>
                        <ul class="js-sub-menu sub-menu">
                            <li><a href="{{ route('memorization') }}">قسم تحفيظ القرآن الكريم </a></li>
                            <li><a href="{{ route('course') }}">قسم الدورات والتجويد والأسانيد</a></li>
                            <li><a href="{{ route('diwan') }}">قسم ديوان الحفاظ</a></li>
                            <li><a href="{{ route('creative') }}">قسم التربية والمواهب الإبداعية </a></li>
                            <li><a href="{{ route('activity') }}">قسم الأنشطة والمسابقة </a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('index') }}">قسم الأخبار</a></li>
                    <li><a href="{{ route('clues') }}">أدلة الدار</a></li>
                    <li><a href="{{ route('contact-us') }}">تواصل معنا </a></li>
                    <li><a href="https://wa.me/+972592889891" class="donation" target="_blank">تبرع لنا</a></li>
                </ul>
            </div>

            <form  class="search-box" role="search" method="GET"action="{{ url('itqan/search') }}" enctype="multipart/form-data">
                <div class="search-box">
                    <i class='bx bx-search'></i>
                    <div class="input-box">
                        <input type="search" name="search" placeholder="بحث..." aria-label="Search"
                            aria-describedby="search-addon">

                    </div>
                </div>


            </form>
        </div>
    </nav>
    <div class="container">



    </div>
</header>
