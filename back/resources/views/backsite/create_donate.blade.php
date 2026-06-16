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
    </head>

    <body>
        <div class="container">
            <!-- Content here -->
            <form method="POST" action="{{ route('donate-store') }}" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('donate-show') }}">عرض</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    الصورة
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="form-group">
                    العنوان
                    <input type="text" name="title" class="form-control" placeholder="ادخل العنوان" required>
                </div>
               <div class="form-group">
                     التفاصيل
                 <textarea style="height: 200px;" name="details"  class="form-control" placeholder="ادخل التفاصيل" required></textarea>
                </div>
                <div class="form-group" dir="rtl">
                    التاريخ
                    <input type="date" name="date" class="form-control" placeholder="ادخل التاريخ">
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
    اضافة مشاريع تحتاج دعم
@endsection
