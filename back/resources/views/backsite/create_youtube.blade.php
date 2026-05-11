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
        <title>Add Youtube Links</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->
            <form method="POST" action="{{ route('youtube-store') }}">
                @csrf
                @if (count($youtube) > 0)
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('youtube-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>

                    <div class="form-group">
                        <label> رابط الفيديو الاساسي</label>
                        <input type="text" name="main" class="form-control" placeholder="ادخل رابط يوتيوب"
                            value="{{ $youtube[0]->main }}" disabled>
                    </div>
                    <div class="form-group">
                        <label> رابط القيديو الفرعي الاول</label>
                        <input type="text" name="secondary1" class="form-control" placeholder="ادخل رابط يوتيوب"
                            value="{{ $youtube[0]->secondary1 }}" disabled>
                    </div>
                    <div>
                        <label> رابط القيديو الفرعي الثاني</label>
                        <input type="text" name="secondary2" class="form-control" placeholder="ادخل رابط يوتيوب"
                            value="{{ $youtube[0]->secondary2 }}" disabled>

                    </div>

                    <br>
                    <button class="btn btn-primary" disabled>نشر</button>
                @else
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('youtube-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>

                    <div class="form-group">
                        <label> رابط الفيديو الاساسي</label>
                        <input type="text" name="main" class="form-control" placeholder="ادخل رابط يوتيوب" required>
                    </div>
                    <div class="form-group">
                        <label> رابط القيديو الفرعي الاول</label>
                        <input type="text" name="secondary1" class="form-control" placeholder="ادخل رابط يوتيوب"
                            required>
                    </div>
                    <div>
                        <label> رابط القيديو الفرعي الثاني</label>
                        <input type="text" name="secondary2" class="form-control" placeholder="ادخل رابط يوتيوب"
                            required>

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
    اضافة روابط اليوتيوب
@endsection
