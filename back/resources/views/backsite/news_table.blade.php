@extends('backsite.layout.master')
@section('title')
    عرض الأخبار
@endsection
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
    <title>show news table</title>
</head>

<div class="container" dir="rtl">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('news-create') }}">الاضافة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">عرض</a>
        </li>
    </ul>
    <br>

    <table class="table" dir="rtl">
        <thead>
            <tr align="center">
                <th scope="col">#</th>
                <th scope="col">العنوان </th>
                <th scope="col">التفاصيل </th>
                <th scope="col">الصورة الرئيسية</th>
                <th scope="col">الصورة الفرعية  </th>
                <th scope="col">الحدث </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newss as $news)
                <tr align="center">
                    <th scope="row">{{ $news->id }}</th>
                    <td>{{ $news->title }}</td>
                    <td>{{ Str::limit($news->object, 30) }}</td>
                    <td><img src="{{ asset('storage/' . $news->image) }}" width="130" height="90"></td>
                    <td><img src="{{ asset('storage/' . $news->subphotos1) }}" width="130" height="90"></td>
                    <td style="width: 170px">
                        <a href="{{ url('admin/news/edit/' . $news->id) }}" class="btn btn-primary">تعديل</a>
                        <a href="{{ url('admin/news/destroy/' . $news->id) }}" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $newss->links() }}
</div>
<script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
@endsection