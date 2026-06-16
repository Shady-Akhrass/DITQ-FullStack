@extends('backsite.layout.master')
@section('title')
    تعديل الصفحة الرئيسية
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
        <style>

        </style>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('home-update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    @if (count($home) != 0)
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home-post') }}">الاضافة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                            </li>
                        </ul>
                        <br>
                        <br>
                        <div class="form-group">
                            <label> الرؤية </label>
                            <textarea name="vision" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="ادخل الرؤية"
                                required>{{ $home[0]->vision }} </textarea>
                        </div>
                        <div class="form-group">
                            <label>الرسالة</label>

                            <textarea name="mission" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="ادخل الرسالة"
                                required>
                        {{ trim($home[0]->mission) }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="ex1">عدد الطلاب والطالبات</label>
                            <input name="student_number" class="form-control" type="text" required
                                value="{{ $home[0]->student_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex2">عدد الحلقات </label>
                            <input class="form-control" id="ex2" type="text" name="lesson_number" required
                                value="{{ $home[0]->lesson_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد حفاظ كتاب الله</label>
                            <input class="form-control" id="ex3" type="text" name="memorizing_number" required
                                value="{{ $home[0]->memorizing_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد المحفظين و المحفظات</label>
                            <input class="form-control" id="ex3" type="text" name="teacher_number" required
                                value="{{ $home[0]->teacher_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الدورات</label>
                            <input class="form-control" id="ex3" type="text" name="course_number" required
                                value="{{ $home[0]->course_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد المخيمات القرائية</label>
                            <input class="form-control" id="ex3" type="text" name="camp_number" required
                                value="{{ $home[0]->camp_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عددالمسابقات</label>
                            <input class="form-control" id="ex3" type="text" name="contest_number" required
                                value="{{ $home[0]->contest_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الاحتفالات والتكريمات</label>
                            <input class="form-control" id="ex3" type="text" name="celebration_number" required
                                value="{{ $home[0]->celebration_number }}">
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

                                @foreach ($images as $image)
                                    <tr>
                                        <th scope="row" style="padding-top: 42px; width:70px">{{ $image->id }}</th>
                                        <td style="width:fit-content"> <img src="{{ asset('storage/' . $image->image) }}"
                                                width="1080" height="420"></td>
                                        <td style="padding-top: 42px"><a
                                                href="{{ url('admin/slider/edit/' . $image->id) }}"
                                                class="btn btn-primary">تغير</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <div>
                            <input type="hidden" name="hidden_id" value="{{ $home[0]->id }}">
                        </div>
                        <button class="btn btn-primary">تعديل</button>

                </div>
            @else
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home-post') }}">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">التعديل</a>
                    </li>
                </ul>
                <br>
                <br>
                <div class="form-group">
                    <label> الرؤية </label>
                    <textarea name="vision" class="form-control" id="exampleFormControlTextarea1" rows="5"
                        placeholder="ادخل الرؤية" disabled> </textarea>
                </div>
                <div class="form-group">
                    <label>الرسالة</label>

                    <textarea name="mission" class="form-control" id="exampleFormControlTextarea1" rows="5"
                        placeholder="ادخل الرسالة" disabled>
                    </textarea>
                </div>
                <label>الصور الرئيسية</label>
                <input type="file" id=image name="image[]" class="form-control" id="exampleInputEmail1"
                    multiple="multiple" placeholder="ادخل الصور الفرعية" accept="image/*" disabled>
                <div>
                    <label for="ex1">عدد الطلاب والطالبات</label>
                    <input name="student_number" class="form-control" type="text" value="" disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex2">عدد الحلقات </label>
                    <input class="form-control" id="ex2" type="text" name="lesson_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عدد حفاظ كتاب الله</label>
                    <input class="form-control" id="ex3" type="text" name="memorizing_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عدد المحفظين و المحفظات</label>
                    <input class="form-control" id="ex3" type="text" name="teacher_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عدد الدورات</label>
                    <input class="form-control" id="ex3" type="text" name="course_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عدد المخيمات القرائية</label>
                    <input class="form-control" id="ex3" type="text" name="camp_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عددالمسابقات</label>
                    <input class="form-control" id="ex3" type="text" name="contest_number" value=""
                        disabled>
                </div>
                <div class="col-md-3">
                    <label for="ex3">عدد الاحتفالات والتكريمات</label>
                    <input class="form-control" id="ex3" type="text" name="celebration_number" value=""
                        disabled>
                </div>
                <br>
                <div>
                    <input type="hidden" name="hidden_id" value="" disabled>
                </div>
                <button class="btn btn-primary" disabled>تعديل</button>
                @endif
            </form>
            <br>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
