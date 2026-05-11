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
        <title>Add speech</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->
            @if (count($speech) == 0)
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="{{ route('speech-edit') }}">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <form method="POST" action="{{ route('speech-store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>كلمة رئيس الدار</label>
                        <textarea type="text" name="speech" class="form-control" placeholder="ادخل كلمة رئيس الدار" rows="12"> </textarea>
                    </div>


                    <br>
                    <button class="btn btn-primary">نشر</button>

                </form>
            @else
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('speech-edit') }}">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <form method="POST" action="{{ route('speech-store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label>كلمة رئيس الدار</label>
                        <textarea type="text" name="speech" class="form-control" placeholder="ادخل كلمة رئيس الدار" rows="12" disabled
                            required> </textarea>
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
    اضافة كلمة الرئيس
@endsection
