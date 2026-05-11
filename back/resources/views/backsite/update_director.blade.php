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
        <title> تعديل الإدارة</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('director-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('director-post') }}">الاضافة</a>
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
                        value="{{ $directors->name }}">
                </div>
                <br>
                <div>
                    <label for="القسم">اختار القسم:</label>

                    <select name="postion" id="postion" class="form-select">
                        @if (value("$directors->postion") == 'رئيس مجلس الإدارة')
                            <option value="رئيس مجلس الإدارة" name="postion" selected>رئيس مجلس الإدارة</option>
                            <option value="نائب رئيس مجلس الإدارة" name="postion">نائب رئيس مجلس الإدارة</option>
                            <option value="أمين صندوق"name="postion">أمين صندوق</option>
                            <option value="أمين سر"name="postion">أمين سر</option>
                            <option value="عضو"name="postion">عضو</option>
                        @elseif (value("$directors->postion") == 'نائب رئيس مجلس الإدارة')
                            <option value="رئيس مجلس الإدارة" name="postion">رئيس مجلس الإدارة</option>
                            <option value="نائب رئيس مجلس الإدارة" name="postion" selected>نائب رئيس مجلس الإدارة</option>
                            <option value="أمين صندوق"name="postion">أمين صندوق</option>
                            <option value="أمين سر"name="postion">أمين سر</option>
                            <option value="عضو"name="postion">عضو</option>
                        @elseif (value("$directors->postion") == 'أمين صندوق')
                            <option value="رئيس مجلس الإدارة" name="postion">رئيس مجلس الإدارة</option>
                            <option value="نائب رئيس مجلس الإدارة" name="postion">نائب رئيس مجلس الإدارة</option>
                            <option value="أمين صندوق"name="postion"selected>أمين صندوق</option>
                            <option value="أمين سر"name="postion">أمين سر</option>
                            <option value="عضو"name="postion">عضو</option>
                        @elseif (value("$directors->postion") == 'أمين سر')
                            <option value="رئيس مجلس الإدارة" name="postion">رئيس مجلس الإدارة</option>
                            <option value="نائب رئيس مجلس الإدارة" name="postion">نائب رئيس مجلس الإدارة</option>
                            <option value="أمين صندوق"name="postion">أمين صندوق</option>
                            <option value="أمين سر"name="postion" selected>أمين سر</option>
                            <option value="عضو"name="postion">عضو</option>
                        @elseif (value("$directors->postion") == 'عضو')
                            <option value="رئيس مجلس الإدارة" name="postion">رئيس مجلس الإدارة</option>
                            <option value="نائب رئيس مجلس الإدارة" name="postion">نائب رئيس مجلس الإدارة</option>
                            <option value="أمين صندوق"name="postion">أمين صندوق</option>
                            <option value="أمين سر"name="postion">أمين سر</option>
                            <option value="عضو"name="postion" selected>عضو</option>
                        @endif

                    </select>
                </div>

                <table class="table" dir="rtl">
                    <thead>
                        <tr>

                            <th scope="col">الصورة </th>
                            <th scope="col"> اضافة صورة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:200px"> <img src="{{ asset('storage/' . $directors->image) }}" width="130 "
                                    height="90"></td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الصورة </label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                        placeholder="ادخل الصورة الرئيسية" accept="image/*">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <input type="hidden" name="hidden_id" value="{{ $directors->id }}">
                <button class="btn btn-primary">تعديل</button>

            </form>
        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection


@section('title')
    تعديل مجلس الإدارة
@endsection
