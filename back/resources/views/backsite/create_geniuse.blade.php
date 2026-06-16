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
        <title>Add Geniuse</title>
    </head>

    <body>
        <div class="container">
            <!-- Content here -->
            <form method="POST" action="{{ route('geniuse-store') }}" enctype="multipart/form-data" dir="rtl">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('geniuse-show') }}">عرض</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    الصورة
                    <input type="file" name="image" class="form-control" placeholder="ادخل الصورة الرئيسية"
                        accept="image/*" required>
                </div>
                <div class="form-group">
                    الاسم
                    <input type="text" name="name" class="form-control" placeholder="ادخل الاسم " required>
                </div>
                <div class="form-group">
                     التفاصيل
                 <textarea style="height: 200px;" name="details"  class="form-control" placeholder="ادخل التفاصيل" required></textarea>
                </div>


                <br>
                <button class="btn btn-primary">نشر</button>

            </form>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection

@section('title')
    اضافة نوابغ
@endsection
