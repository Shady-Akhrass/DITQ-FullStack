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
        <title>Edit Geniuse</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('geniuse-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('geniuse-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    <label> الاسم</label>
                    <input type="text" name="name" class="form-control" placeholder="ادخل الاسم"
                        value="{{ $geniuse->name }}">
                </div>
               
                <div class="form-group">
                     التفاصيل
                 <textarea style="height: 200px;" name="details"  class="form-control" placeholder="ادخل التفاصيل" required> {{$geniuse->details}}</textarea>
                </div>

                <table class="table" dir="rtl">
                    <thead>
                        <tr>
                            <th scope="col">الصورة </th>
                            <th scope="col">تعديل الصورة </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:200px"> <img src="{{ asset('storage/' . $geniuse->image) }}" width="130 "
                                    height="90"></td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الصورة</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                        placeholder="ادخل الصور الفرعية" accept="image/*">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <div>
                    <input type="hidden" name="hidden_id" value="{{ $geniuse->id }}">
                </div>
                <button class="btn btn-primary">تعديل</button>

            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل النوابغ
@endsection
