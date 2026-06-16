@extends('frontsite.layout.master')

@section('content')
    <div class="title">
        <h2><a href="#">نسعد بتواصلك</a></h2>
    </div>

    <div class="contact-us">

        <div class="container">
            <div class="form-container">
                <div class="right-container">
                    <div class="right-inner-container">
                        <form method="POST" action="{{ route('contact-us/send-email') }}">
                            @csrf
                            <h3 class="lg-view">اتصل بنا</h3>
                            <input type="text" placeholder="الاسم" name="name" required />
                            <input type="email" placeholder="الإيميل" name="email" required />
                            <input type="phone" placeholder="الجوال" name="phone" required />
                            <input type="text" placeholder="العنوان" name="subject"required />
                            <textarea rows="4" placeholder="نص الرسالة" name="message" required></textarea>
                            <button>إرسال</button>
                        </form>
                    </div>
                </div>
                <div class="left-container">
                    <div class="left-inner-container">
                        <h3>كن على تواصل دائمًا معنا </h3>
                        <p> دار الإتقان لتعليم القرآن مؤسسة قرآنية تشرف على مراكز تعليم القرآن من خلال برامج تربوية
                            وتعليمية
                            متميزة ومناهج متطورة وكادر كفء</p>
                        <br>

                        <p class="location-contactUc">المقر - فلسطين - قطاع غزة </p>
                        <p class="phone-contactUc">+972 59-288-9891</p>
                        <p class="email-contactUc">daretqan@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    تواصل معنا
@endsection
