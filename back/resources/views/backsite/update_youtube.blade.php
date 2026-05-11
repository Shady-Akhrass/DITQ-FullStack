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
        <div class="container" dir="rtl" class="foo">
            <!-- Content here -->


            <form method="POST" action="{{ route('youtube-update') }}">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('youtube-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    <label> رابط الفيديو الاساسي</label>
                    <input type="text" name="main" class="form-control" placeholder="ادخل رابط يوتيوب"
                        value="{{ $youtube[0]->main }}">
                </div>
                <div class="form-group">
                    <label> رابط القيديو الفرعي الاول</label>
                    <input type="text" name="secondary1" class="form-control" placeholder="ادخل رابط يوتيوب"
                        value="{{ $youtube[0]->secondary1 }}">
                </div>
                <div>
                    <label> رابط القيديو الفرعي الثاني</label>
                    <input type="text" name="secondary2" class="form-control" placeholder="ادخل رابط يوتيوب"
                        value="{{ $youtube[0]->secondary2 }}">

                </div>
                <br>
                <input type="hidden" name="hidden_id" value="{{ $youtube[0]->id }}">
                <button class="btn btn-primary">تعديل</button>
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل روابط اليوتيوب
@endsection
