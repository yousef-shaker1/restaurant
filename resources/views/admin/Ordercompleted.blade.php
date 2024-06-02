@extends('layout.master_admin')
@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .navbar-custom {
            background-color: #343a40;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }

        .navbar-custom .nav-link:hover {
            color: #d4d4d4;
        }
    </style>
@endsection

@section('title')
الاوردرات اللي تمت
@endsection

@section('con')

    @if(session()->has('delete'))
    <div class="alart alert-denger alert-dismissible fade show" role='alert'>
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">اسم العميل</th>
                                    <th class="border-bottom-0">ايميل العميل</th>
                                    <th class="border-bottom-0">تليفون العميل</th>
                                    <th class="border-bottom-0">تاريخ الاودر</th>
                                    <th class="border-bottom-0">وقت الاودر</th>
                                    <th class="border-bottom-0"> اسم الوجبة</th>
                                    <th class="border-bottom-0">عدد الوجبات</th>
                                    <th class="border-bottom-0"> سعر الوجبة</th>
                                    <th class="border-bottom-0">المجموع</th>
                                    <th class="border-bottom-0">حالة الطلب</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->email }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->birthdate }}</td>
                                    <td>{{ $order->time }}</td>
                                    <td>{{ $order->prodect->name }}</td>
                                    <td>{{ $order->count }}</td>
                                    <td>{{ $order->prodect->price }}</td>
                                    <td>{{ $order->prodect->price * $order->count }}</td>
                                    <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;" class="text-white bg-success">
                                        {{ $order->status }}
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <form action="{{ route('order.destroy', $order->id) }}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">حذف الاوردر</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    


        
        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
@endsection

@section('js')
<!-- تأكد من إضافة سكربتات الجافا سكريبت في نهاية البودي -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection

