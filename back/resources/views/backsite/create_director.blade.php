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
        <title>Add director</title>
    </head>

    <body>
        <div class="container" dir="rtl">
            <!-- Content here -->

            <form method="POST" action="{{ route('director-store') }}" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">الاضافة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('director-show') }}">عرض</a>
                    </li>

                </ul>
                <br>
                <br>
                <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" name="image" class="form-control" placeholder="ادخل صورة " accept="image/*"
                        required>
                </div>
                <div class="form-group">
                    <label> الاسم</label>
                    <input type="text" name="name" class="form-control" placeholder="ادخل الاسم" required>
                </div>

                <br>

                <div>
                    <label for="القسم">اختار القسم:</label>
                    <select name="postion" id="postion" required class="form-select">
                        @if (in_array('رئيس مجلس الإدارة', $pos))
                            <option value="رئيس مجلس الإدارة" name="postion" disabled>رئيس مجلس الأدارة</option>
                        @else
                            <option value="رئيس مجلس الإدارة" name="postion">رئيس مجلس الإدارة</option>
                        @endif

                        @if (in_array('نائب رئيس مجلس الأدارة', $pos))
                            <option value="نائب رئيس مجلس الإدارة" name="postion" disabled>نائب رئيس مجلس الإدارة
                            </option>
                        @else
                            <option value="نائب رئيس مجلس الإدارة" name="postion">نائب رئيس مجلس الإدارة</option>
                        @endif

                        @if (in_array('أمين صندوق', $pos))
                            <option value="أمين صندوق" name="postion" disabled>أمين صندوق</option>
                        @else
                            <option value="أمين صندوق" name="postion">أمين صندوق</option>
                        @endif

                        @if (in_array('أمين سر', $pos))
                            <option value="أمين سر" name="postion" disabled>أمين سر</option>
                        @else
                            <option value="أمين سر" name="postion">أمين سر</option>
                        @endif
                        <option value="عضو" name="postion">عضو</option>
                    </select>
                </div>


                <br>
                <button class="btn btn-primary">نشر</button>

            </form>


        </div>
        <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
