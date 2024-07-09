@extends('layout.master_admin')

@section('css')
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
الاوردرات المقبولة
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
                                    <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;" class="text-white bg-primary ">
                                        {{ $order->status }}
                                    </td>
                                    <td>
                                        @can('رفض الطلبات')
                                        <a href='{{ route('order.status2', $order->id) }}' class="btn btn-danger mb-1">رفض</a>
                                        @endcan
                                        @can('اتمام الطلبات')
                                        @endcan
                                        <a href='{{ route('order.status3', $order->id) }}' class="btn btn-success mb-1">اتمام</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper mt-4">
                            <ul class="pagination justify-content-center">
                                <!-- زر الصفحة السابقة -->
                                @if ($orders->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">السابق</span></li>
                                @else
                                    <li class="page-item"><a href="{{ $orders->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                                @endif
        
                                <!-- أرقام الصفحات -->
                                @foreach(range(1, $orders->lastPage()) as $page)
                                    <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $orders->url($page) }}" class="page-link">{{ $page }}</a>
                                    </li>
                                @endforeach
        
                                <!-- زر الصفحة التالية -->
                                @if ($orders->hasMorePages())
                                    <li class="page-item"><a href="{{ $orders->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">التالي</span></li>
                                @endif
                            </ul>
                        </div>
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
@endsection
    
