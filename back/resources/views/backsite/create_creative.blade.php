@extends('backsite.layout.master')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
        <link rel="icon" href="{{ asset('image/logo.icon') }}" />
        <title>create_home </title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->
            @if (count($creative) == 0)
                <form method="POST" action="{{ route('creative-store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('creative-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">

                        <div class="form-group">
                            <label> حول القسم </label>
                            <textarea name="about" class="form-control" id="exampleFormControlTextarea1" rows="8" placeholder="ادخل النص"
                                required></textarea>
                        </div>
                        <label>الصور الرئيسية</label>
                        <input type="file" id=image name="image[]" class="form-control" id="exampleInputEmail1"
                            multiple="multiple" placeholder="ادخل الصور الفرعية" accept="image/*" required>
                        <br>
                        <button class="btn btn-primary">نشر</button>

                </form>
            @else
                <form method="POST" action="{{ route('creative-store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('creative-edit') }}">التعديل</a>
                        </li>
                    </ul>
                    <br>
                    <br>
                    <div class="form-group">

                        <div class="form-group">
                            <label> حول القسم </label>
                            <textarea name="about" class="form-control" id="exampleFormControlTextarea1" rows="8" placeholder="ادخل النص"
                                disabled></textarea>
                        </div>
                        <label>الصور الرئيسية</label>
                        <input type="file" id=image name="image[]" class="form-control" id="exampleInputEmail1"
                            multiple="multiple" placeholder="ادخل الصور الفرعية" accept="image/*" disabled>
                        <br>
                        <button class="btn btn-primary" disabled>نشر</button>

                </form>
            @endif
            <br>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
@section('title')
 اضافة قسم التربية والمواهب الابداعية 
@endsection