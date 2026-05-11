@extends('backsite.layout.master')
@section('title')
    اضافة خبر
@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="{{ asset('image/logo.icon') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
        <title>اضافة خبر</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('news-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('news-show') }}">العرض</a>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان الخبر</label>
                        <input type="text" name="title" class="form-control" required placeholder="ادخل عنوان الخبر">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">موضوع الخبر</label>
                        <textarea rows="15" name="object" class="form-control" placeholder="ادخل موضوع الخبر" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">الصورة الرئيسية</label>
                        <input type="file" name="image" class="form-control" required
                            placeholder="ادخل الصورة الرئيسية" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">الصورة الفرعية </label>
                        <input type="file" name="subphotos1" class="form-control" required
                            placeholder="ادخل الصور الفرعية" accept="image/*">
                    </div>


                    <br>
                    <button class="btn btn-primary">نشر</button>
                </div>
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
