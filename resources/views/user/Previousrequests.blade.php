@extends('layout.master')
@section('title')
الطلبات السابقة
@endsection
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

@section('content')
<div class="heading_container heading_center">
  <h2>
    الطلبات السابقة
  </h2>
</div>
<div class="row">
  <div class="col-xl-12">
      <div class="card mg-b-20">
          <div class="card-body">
              <div class="table-responsive">
                  <table id="example1" class="table key-buttons text-md-nowrap">
                      <thead>
                          <tr>
                              <th class="border-bottom-0">العنوان</th>
                              <th class="border-bottom-0">تاريخ الاودر</th>
                              <th class="border-bottom-0">وقت الاودر</th>
                              <th class="border-bottom-0"> اسم الوجبة</th>
                              <th class="border-bottom-0">عدد الوجبات</th>
                              <th class="border-bottom-0"> سعر الوجبة</th>
                              <th class="border-bottom-0">المجموع</th>
                              <th class="border-bottom-0">حالة الطلب</th>
                          </tr>
                      </thead>
                      <tbody> 
                          @foreach ($orders as $order)
                          <tr>
                              <td>{{ $order->customer->address }}</td>
                              <td>{{ $order->birthdate }}</td>
                              <td>{{ $order->time }}</td>
                              <td>{{ $order->prodect->name }}</td>
                              <td>{{ $order->count }}</td>
                              <td>{{ $order->prodect->price }} $</td>
                              <td>{{ $order->prodect->price * $order->count }} $</td>
                              <td style="width: 150px; height: 60px; padding: 17px; text-align: center; vertical-align: middle; display: flex; align-items: center; justify-content: center;" class="
                              @if ($order->status == 'يتم مراجعة الطلب') 
                                  bg-secondary text-white 
                              @elseif($order->status == 'قبول') 
                                  bg-primary text-white 
                              @elseif($order->status == 'رفض') 
                                  bg-danger text-white 
                              @elseif($order->status == 'اتمام') 
                                  bg-success text-white 
                              @endif">
                              {{ $order->status }}
                          </td>
                              
                          </tr>
                          @endforeach
                          @foreach ($offers as $offer)
                          <tr>
                              <td>{{ $offer->customer->address }}</td>
                              <td>{{ $offer->birthdate }}</td>
                              <td>{{ $offer->time }}</td>
                              <td>{{ $offer->offer->name }}</td>
                              <td>{{ $offer->count }}</td>
                              <td>{{ $offer->offer->price }} $</td>
                              <td>{{ $offer->offer->price * $offer->count }} $</td>
                              <td style="width: 150px; height: 60px; padding: 17px; text-align: center; vertical-align: middle; display: flex; align-items: center; justify-content: center;" class="
                              @if ($offer->status == 'يتم مراجعة الطلب') 
                                  bg-secondary text-white 
                              @elseif($offer->status == 'قبول') 
                                  bg-primary text-white 
                              @elseif($offer->status == 'رفض') 
                                  bg-danger text-white 
                              @elseif($offer->status == 'اتمام') 
                                  bg-success text-white 
                              @endif">
                              {{ $offer->status }}
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection