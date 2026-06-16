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
        <title> تعديل الادلة </title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('clues-update') }}" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clues-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <embed src=" {{ asset('storage/' . $clues[0]->pdf) }}" class="form-control" height="700" />

                <div class="form-group">
                    <label for="exampleInputEmail1">الملف</label>
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                </div>


                <br>
                <div>
                    <input type="hidden" name="hidden_id" value="{{ $clues[0]->id }}">
                </div>
                <button class="btn btn-primary">تعديل</button>
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
@section('title')
تعديل الأدلة
@endsection
