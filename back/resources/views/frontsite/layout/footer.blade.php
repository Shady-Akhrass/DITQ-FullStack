<!-- Start Footer -->

<div class="footer">
    <div class="container">
        <div class="about-footer">
            <div class="logo-footer">
                <img src="{{ asset('image/logoss.png') }}" alt="">
            </div>
            <div class="linking">
                <div class="div-1">
                    <h4>روابط مهمة</h4>
                    <a href="{{ route('home') }}">الرئيسية</a>
                    <a href="{{ route('speech') }}">كلمة رئيس الدار</a>
                    <a href="{{ route('index') }}">قسم الأخبار</a>
                    <a href="#">تبرع لنا</a>
                    <a href="{{ route('contact-us') }}">تواصل الان</a>
                </div>
            </div>
            <div class="contact-information">
                <h4>معلومات التواصل</h4>
                <p class="phone">+972 59-288-9891</p>
                <p class="email">daretqan@gmail.com</p>
                <p class="location-in">المقر - فلسطين - قطاع غزة</p>
            </div>

            <div class="partners">
                <h4>شركاء النجاح</h4>
                <div class="partners-img">

                    <img src="{{ asset('image/ead.jpg') }}" alt="">
                    <p>مؤسسة عيد </p>
                </div>
                <br>
                <div class="partners-img">

                    <img src="{{ asset('image/peduli.jpg') }}" alt="">
                    <p>مؤسسة عيد </p>
                </div>
            </div>
        </div>
    </div>
    <div class="icon">
        <div class="social-buttons">
            <a href="https://www.facebook.com/dar.etqan.gaza" target="_blank"
                class="social-button social-button--facebook" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.youtube.com/@user-pd4pk8ex4z" target="_blank"
                class="social-button social-button--youtube" aria-label="Youtube">
                <i class="fab fa-youtube"></i>
            </a>

            <a href="https://twitter.com/dar_etqan" target="_blank" class="social-button social-button--twitter"
                aria-label="GitHub">
                <i class="fab fa-twitter"></i>
            </a>

        </div>

    </div>
    <p class="copyright">
        جميع الحقوق محفوظة لدى مؤسسة دار الإتقان &copy; <span> {{ date('Y') }}-2022 </span>
    </p>
</div>


<!-- End Footer -->

<button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class="fa-solid fa-arrow-up"></i>

</button>
