@extends('backsite.layout.master')
@section('title')
    عرض التبرع
@endsection
@section('content')

    <head>

        <head>
            <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
            <title>show donate table</title>
        </head>

    </head>

    <div class="container" dir="rtl">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('donate-post') }}">الاضافة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">عرض</a>
            </li>
        </ul>
        <br>
        <br>
        <table class="table" dir="rtl">
            <thead>
                <tr align="center">
                    <th scope="col">#</th>
                    <th scope="col">العنوان </th>
                    <th scope="col">التفاصيل </th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">الصورة</th>
                    <th scope="col">الحدث </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($donate as $don)
                    {{-- $id={{ $don->id }}; --}}
                    {{-- <input type="hidden" name="hidden_id" value="{{ $don->id }}"> --}}
                    <tr align="center">
                        <th scope="row" style="padding-top: 42px">{{ $don->id }}</th>
                        <td style="padding-top: 42px">{{ $don->title }}</td>
                        <td style="padding-top: 42px">{{ Str::limit($don->details, 30) }}</td>
                        <td style="padding-top: 42px ; width: 170px">{{ $don->date }}</td>
                        <td style="width:200px"> <img src="{{ asset('storage/' . $don->image) }}" width="130 "
                                height="90"></td>
                        <td style="padding-top: 42px; width: 170px"><a href="{{ url('admin/donate/edit/' . $don->id) }}"
                                class="btn btn-primary">تعديل</a>

                            <a href="{{ url('admin/donate/destroy/' . $don->id) }}" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
@endsection
