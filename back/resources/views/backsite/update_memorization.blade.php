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
        <title>update memoraization </title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('memorization-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('memorization-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">

                    <div class="form-group">
                        <label> حول القسم </label>
                        <textarea name="about" class="form-control" id="exampleFormControlTextarea1" rows="8" placeholder="ادخل النص"
                            > {{ $memorization[0]->about }}</textarea>
                    </div>
                    <table class="table" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الصورة </th>
                                <th scope="col">الحدث </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($memorization_image as $image)
                                <tr>
                                    <th scope="row" style="padding-top: 42px; width:70px">{{ $image->id }}</th>
                                    <td style="width:fit-content"> <img src="{{ asset('storage/' . $image->image) }}"
                                            width="1080" height="420"></td>
                                    <td style="padding-top: 42px"><a
                                            href="{{ url('admin/memorization-image/edit/' . $image->id) }}"
                                            class="btn btn-primary">تغير</a>
                                    </td>
                                </tr>
                                <input type="hidden" name="hidden_id" value="{{ $image->id }}">
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <input type="hidden" name="hidden_id" value="{{ $memorization[0]->id }}">
                    <button class="btn btn-primary">تعديل</button>

            </form>
            <br>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
تعديل قسم تحفيظ القرآن الكريم
@endsection
