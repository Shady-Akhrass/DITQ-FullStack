@extends('frontsite.layout.master')

@section('content')
    <div class="branches">
        <div class="title">
            <h2><a href="news.blade.php">فروع الدار</a></h2>
        </div>
        <div class="container">
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d727.4593171648501!2d34.46291217081485!3d31.51169914217265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x99e1d7ece5501508!2zMzHCsDMwJzQyLjEiTiAzNMKwMjcnNDQuNSJF!5e1!3m2!1sar!2s!4v1672570219244!5m2!1sar!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <br>
            <br>
            <h5 class="title">تضم الدار أكثر من 150 حلقة و مركز موزعين في مناطق قطاع غزة</h5>
            <div class="branches-name">
                <ul>
                    <li>فرع غزة </li>
                    <li>فرع الوسطى </li>
                    <li>فرع الشمال</li>
                    <li>فرع خانيونس</li>
                    <li>فرع رفح</li>
                </ul>
            </div>
        </div>

    </div>
@endsection

@section('title')
    فروع الدار
@endsection
