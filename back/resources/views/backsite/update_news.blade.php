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
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('news-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news-create') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">عرض</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الخبر</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                        placeholder="ادخل عنوان الخبر" value="{{ $newss->title }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">موضوع الخبر</label>
                    <textarea rows="15" name="object" class="form-control" id="exampleInputEmail1" placeholder="ادخل موضوع الخبر"> {{ $newss->object }}</textarea>
                </div>






                <table class="table" dir="rtl">
                    <thead>
                        <tr>

                            <th scope="col">الصورة الرئيسية</th>
                            <th scope="col"> تعديل الصورة الرئيسية </th>
                            <th scope="col">الصورة الفرعية </th>
                            <th scope="col"> تعديل الصورة الفرعية </th>

                        </tr>
                    </thead>
                    <tbody>


                        {{-- $id={{ $gen->id }}; --}}
                        {{-- <input type="hidden" name="hidden_id" value="{{ $gen->id }}"> --}}
                        <tr>
                            <td style="width:200px"> <img src="{{ asset('storage/' . $newss->image) }}" width="130 "
                                    height="90"></td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الصورة الرئيسية</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                        placeholder="ادخل الصورة الرئيسية" accept="image/*">
                                </div>
                            </td>
                            <td style="width:200px"> <img src="{{ asset('storage/' . $newss->subphotos1) }}" width="130 "
                                    height="90"></td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الصورة الفرعية </label>
                                    <input type="file" name="subphotos1" class="form-control" id="exampleInputEmail1"
                                        placeholder="ادخل الصور الفرعية" accept="image/*">
                                </div>
                            </td>



                        </tr>
                    </tbody>
                </table>
                <br>
                <input type="hidden" name="hidden_id" value="{{ $newss->id }}">
                <button class="btn btn-primary">تعديل</button>

            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل الأخبار
@endsection
