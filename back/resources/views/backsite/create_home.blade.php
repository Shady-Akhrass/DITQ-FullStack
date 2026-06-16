@extends('backsite.layout.master')
@section('title')
    إنشاء الصفحة الرئيسية
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
        <title>create_home </title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('home-store') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="row g-3">
                    @if (count($home) != 0)
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home-edit') }}">التعديل</a>
                            </li>
                        </ul>
                        <br>
                        <br>
                        <div class="form-group">
                            <label> الرؤية </label>
                            <textarea name="vision" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="ادخل الرؤية"
                                disabled>{{ $home[0]->vision }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>الرسالة</label>

                            <textarea name="mission" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="ادخل الرسالة"
                                disabled>{{ trim($home[0]->mission) }}</textarea>
                        </div>
                        <label>الصور الرئيسية</label>
                        <input type="file" id=image name="image[]" class="form-control" id="exampleInputEmail1"
                            multiple="multiple" placeholder="ادخل الصور الفرعية" accept="image/*" disabled>

                        <div class="col-md-3">
                            <label for="ex1">عدد الطلاب والطالبات</label>
                            <input name="student_number" class="form-control" type="text" disabled
                                value="{{ $home[0]->student_number }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ex2">عدد الحلقات </label>
                            <input class="form-control" type="text" name="lesson_number"
                                value="{{ $home[0]->lesson_number }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد حفاظ كتاب الله</label>
                            <input class="form-control" id="ex3" type="text" name="memorizing_number"
                                value="{{ $home[0]->memorizing_number }}" disabled>
                        </div>

                        <div class="col-md-3">
                            <label for="ex3">عدد المحفظين </label>
                            <input class="form-control" id="ex3" type="text" name="teacher_number"
                                value="{{ $home[0]->teacher_number }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الدورات</label>
                            <input class="form-control" id="ex3" type="text" name="course_number"
                                value="{{ $home[0]->course_number }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد المخيمات القرائية</label>
                            <input class="form-control" id="ex3" type="text" name="camp_number"
                                value="{{ $home[0]->camp_number }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عددالمسابقات</label>
                            <input class="form-control" id="ex3" type="text" name="contest_number"
                                value="{{ $home[0]->contest_number }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الاحتفالات والتكريمات</label>
                            <input class="form-control" id="ex3" type="text" name="celebration_number"
                                value="{{ $home[0]->celebration_number }}" disabled>
                        </div>
                        <br>
                        <button class="btn btn-primary" disabled>نشر</button>
                    @else
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('home-edit') }}">التعديل</a>
                            </li>
                        </ul>
                        <br>
                        <br>

                        <div class="form-group">
                            <label> الرؤية </label>
                            <textarea name="vision" class="form-control" id="exampleFormControlTextarea1" rows="5"
                                placeholder="ادخل الرؤية"></textarea>
                        </div>
                        <div class="form-group">
                            <label>الرسالة</label>

                            <textarea name="mission" class="form-control" id="exampleFormControlTextarea1" rows="5"
                                placeholder="ادخل الرسالة"></textarea>
                        </div>
                        <label>الصور الرئيسية</label>
                        <input type="file" id=image name="image[]" class="form-control" id="exampleInputEmail1"
                            multiple="multiple" placeholder="ادخل الصور الفرعية" accept="image/webp">
                        <div class="col-md-3">
                            <label for="ex1">عدد الطلاب والطالبات</label>
                            <input name="student_number" class="form-control" type="text" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex2">عدد الحلقات </label>
                            <input class="form-control" id="ex2" type="text" name="lesson_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد حفاظ كتاب الله</label>
                            <input class="form-control" id="ex3" type="text" name="memorizing_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد المحفظين </label>
                            <input class="form-control" id="ex3" type="text" name="teacher_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الدورات</label>
                            <input class="form-control" id="ex3" type="text" name="course_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد المخيمات القرائية</label>
                            <input class="form-control" id="ex3" type="text" name="camp_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عددالمسابقات</label>
                            <input class="form-control" id="ex3" type="text" name="contest_number" required>
                        </div>
                        <div class="col-md-3">
                            <label for="ex3">عدد الاحتفالات والتكريمات</label>
                            <input class="form-control" id="ex3" type="text" name="celebration_number"
                                required>
                        </div>
                        <br>
                        <button class="btn btn-primary" style="width: fit-content !important">نشر</button>

                </div>
                @endif
            </form>
            <br>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
