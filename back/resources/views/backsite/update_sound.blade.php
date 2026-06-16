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
        <title>Edite Youtube Links</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->


            <form method="POST" action="{{ route('sound-update') }}">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sound-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>

                <div class="form-group">
                    <label> الرابط الرئيسي </label>
                    <input type="text" name="main" class="form-control" placeholder="(iframe) ادخل الرابط الرئيسي  "
                        value="{{ $sound[0]->main }}">
                </div>
                <div class="form-group">
                    <label>اسم القناة</label>
                    <input type="text" name="name" class="form-control" placeholder="ادخل اسم القناة"
                        value="{{ $sound[0]->name }}">
                </div>
                <div class="form-group">
                    <label> رابط القناة</label>
                    <input type="text" name="link" class="form-control" placeholder="ادخل رابط قائمة التشغيل"
                        value="{{ $sound[0]->link }}">
                </div>

                <div class="form-group">
                    <label> عنوان قائمة التشغيل</label>
                    <input type="text" name="title" class="form-control" placeholder="ادخل عنوان قائمة التشغيل"
                        value="{{ $sound[0]->title }}">
                </div>

                <div class="form-group">
                    <label> رابط قائمة التشغيل</label>
                    <input type="text" name="playlist" class="form-control" placeholder="ادخل رابط قائمة التشغيل"
                        value="{{ $sound[0]->playlist }}">
                </div>

                <br>
                <input type="hidden" name="hidden_id" value="{{ $sound[0]->id }}">
                <button class="btn btn-primary">تعديل</button>


            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل الصوتيات
@endsection
