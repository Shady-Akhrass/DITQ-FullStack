@extends('backsite.layout.master')

@section('title')
    اضافة قسم تحفيظ القرآن الكريم
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
        <link rel="icon" href="{{ asset('image/logo.icon') }}" />
        <title>create memorization</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->
            @if (count($memorization) == 0)
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="{{ route('memorization-edit') }}">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>

                <form method="POST" action="{{ route('memorization-store') }}" enctype="multipart/form-data">
                    @csrf
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('memorization-edit') }}">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <form method="POST" action="{{ route('memorization-store') }}" enctype="multipart/form-data">
                    @csrf
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
