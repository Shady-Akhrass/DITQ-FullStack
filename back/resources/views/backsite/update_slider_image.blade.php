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
        <title> تعديل الصورة الرئيسية</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('slider-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="exampleInputEmail1">الصورة</label>
                    <input type="file" name="image" class="form-control" required id="exampleInputEmail1"
                        placeholder="ادخل الصور الفرعية" accept="image/webp">
                </div>


                <br>
                <div>
                    <input type="hidden" name="hidden_id" value="{{ $images->id }}">
                </div>
                <button class="btn btn-primary">تعديل</button>
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل صور الصفحة الرئيسية
@endsection
