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
    المنتجات
@endsection

@section('con')
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                              <th class="border-bottom-0">#</th>
                                  <th class="border-bottom-0">اسم العميل</th>
                                  <th class="border-bottom-0">ايميل العميل</th>
                                  <th class="border-bottom-0">هاتف العميل</th>
                                  <th class="border-bottom-0">السلة</th>
                                  <th class="border-bottom-0">الاوردرات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($customers as $customer)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ \App\Models\basket::where('customer_id', $customer->id)->count() + \App\Models\basketoffer::where('customer_id', $customer->id)->count()}}</td>
                                <td>{{ \App\Models\order::where('customer_id', $customer->id)->count() + \App\Models\orderoffer::where('customer_id', $customer->id)->count() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div>

<!-- row closed -->
<!-- Container closed -->
</div>
@endsection
@section('js')

@endsection
