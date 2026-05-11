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
        <title>اضافة الادلة</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->
            @if (count($clues) == 0)
                <form method="POST" action="{{ route('clues-store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('clues-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">الملف</label>
                        <input type="file" name="pdf" class="form-control" id="exampleInputEmail1" accept=".PDF"
                            required>
                    </div>
                    <br>
                    <button class="btn btn-primary">نشر</button>

                </form>
            @else
                <form method="POST" action="{{ route('clues-store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clues-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">الملف</label>
                        <input type="file" name="pdf" class="form-control" id="exampleInputEmail1" accept=".PDF"
                            disabled>
                    </div>
                    <br>
                    <button class="btn btn-primary" disabled>نشر</button>

                </form>
            @endif
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection

@section('title')
    اضافة الأدلة
@endsection
