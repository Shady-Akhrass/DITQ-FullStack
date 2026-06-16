@extends('backsite.layout.master')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="{{ asset('image/logo.icon') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
        <title>Add sound</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('sound-store') }}">
                @csrf
                @if (count($sound) > 0)
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <button class="nav-link active" aria-current="page" href="#">الاضافة</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sound-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>

                    <div class="form-group">
                        <label> الرابط الرئيسي </label>
                        <input type="text" name="main" class="form-control" placeholder="ادخل الرابط الرئيسي (iframe)"
                            value="{{ $sound[0]->main }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>اسم القناة</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم القناة"
                            value="{{ $sound[0]->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label> رابط القناة</label>
                        <input type="text" name="link" class="form-control" placeholder="ادخل رابط قائمة التشغيل"
                            value="{{ $sound[0]->link }}" disabled>
                    </div>

                    <div class="form-group">
                        <label> عنوان قائمة التشغيل</label>
                        <input type="text" name="title" class="form-control" placeholder="ادخل عنوان قائمة التشغيل"
                            value="{{ $sound[0]->title }}" disabled>
                    </div>

                    <div class="form-group">
                        <label> رابط قائمة التشغيل</label>
                        <input type="text" name="playlist" class="form-control" placeholder="ادخل رابط قائمة التشغيل"
                            value="{{ $sound[0]->playlist }}" disabled>
                    </div>

                    <button class="btn btn-primary" disabled>نشر</button>
                @else
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <button class="nav-link active" aria-current="page" href="#">الاضافة</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link disabled" href="{{ route('sound-edit') }}">التعديل</button>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">
                        <label> الرابط الرئيسي </label>
                        <input type="text" name="main" class="form-control" placeholder="ادخل الرابط الرئيسي (iframe)"
                            required>
                    </div>
                    <div class="form-group">
                        <label>اسم القناة</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم القناة">
                    </div>
                    <div class="form-group">
                        <label> رابط القناة</label>
                        <input type="text" name="link" class="form-control" placeholder="ادخل رابط قائمة التشغيل">
                    </div>

                    <div class="form-group">
                        <label> عنوان قائمة التشغيل</label>
                        <input type="text" name="title" class="form-control" placeholder="ادخل عنوان قائمة التشغيل">
                    </div>

                    <div class="form-group">
                        <label> رابط قائمة التشغيل</label>
                        <input type="text" name="playlist" class="form-control" placeholder="ادخل رابط قائمة التشغيل">
                    </div>


                    <br>
                    <button class="btn btn-primary">نشر</button>
                @endif
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection

@section('title')
    اضافة الصوتيات
@endsection
