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
        <title> تعديل صور قسم التحفيظ</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('memorization-image-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="exampleInputEmail1">الصورة</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" required
                        placeholder="ادخل الصورة الرئيسية" accept="image/*">
                </div>


                <br>
                <div>
                    <input type="hidden" name="hidden_id" value="{{ $memorization_image->id }}">
                </div>
                <button class="btn btn-primary">تعديل</button>
            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل صور قسم تحفيظ القرآن الكريم
@endsection
