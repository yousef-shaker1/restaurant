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
    الاوردرات العروض
@endsection

@section('con')
    @if (session()->has('delete'))
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
                                    <th class="border-bottom-0"> اسم العرض</th>
                                    <th class="border-bottom-0">عدد العروض</th>
                                    <th class="border-bottom-0"> سعر العرض</th>
                                    <th class="border-bottom-0">المجموع</th>
                                    <th class="border-bottom-0">حالة الطلب</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderoffers as $order)
                                    <tr>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        <td>{{ $order->customer->phone }}</td>
                                        <td>{{ $order->birthdate }}</td>
                                        <td>{{ $order->time }}</td>
                                        <td>{{ $order->offer->name }}</td>
                                        <td>{{ $order->count }}</td>
                                        <td>{{ $order->offer->price }}</td>
                                        <td>{{ $order->offer->price * $order->count }}</td>
                                        <td style="width: 100px; padding: 17px; text-align: center; vertical-align: middle;"
                                            class="text-white
                                    @if ($order->status == 'يتم مراجعة الطلب') bg-secondary 
                                        @elseif($order->status == 'قبول') 
                                        bg-primary
                                        @elseif($order->status == 'رفض')
                                        bg-danger
                                        @elseif($order->status == 'اتمام') 
                                        bg-success @endif">
                                            {{ $order->status }}
                                        </td>

                                        <td>
                                            @can('قبول الطلبات')
                                                <a href='{{ route('offer.status1', $order->id) }}'
                                                    class="btn btn-primary btn-sm mb-1">قبول</a>
                                            @endcan
                                            @can('رفض الطلبات')
                                                <a href='{{ route('offer.status2', $order->id) }}'
                                                    class="btn btn-danger btn-sm mb-1">رفض</a>
                                            @endcan
                                            @can('اتمام الطلبات')
                                                <a href='{{ route('offer.status3', $order->id) }}'
                                                    class="btn btn-success btn-sm mb-1">اتمام</a>
                                            @endcan
                                            <div class="d-flex flex-column align-items-center">
                                                <form action="{{ route('offer.del', $order->id) }}" method='POST'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">حذف الاوردر</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper mt-4">
                            <ul class="pagination justify-content-center">
                              <!-- زر الصفحة السابقة -->
                              @if ($orderoffers->onFirstPage())
                                  <li class="page-item disabled"><span class="page-link">السابق</span></li>
                              @else
                                  <li class="page-item"><a href="{{ $orderoffers->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                              @endif
                      
                              <!-- أرقام الصفحات -->
                              @foreach(range(1, $orderoffers->lastPage()) as $page)
                                  <li class="page-item {{ $page == $orderoffers->currentPage() ? 'active' : '' }}">
                                      <a href="{{ $orderoffers->url($page) }}" class="page-link">{{ $page }}</a>
                                  </li>
                              @endforeach
                      
                              <!-- زر الصفحة التالية -->
                              @if ($orderoffers->hasMorePages())
                                  <li class="page-item"><a href="{{ $orderoffers->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
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
@endsection
