@extends('layout.master_admin')

@section('css')
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


@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
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
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم العميل</th>
                                <th class="border-bottom-0">ايميل العميل</th>
                                <th class="border-bottom-0">رقم التليون العميل</th>
                                <th class="border-bottom-0">عدد الاشخاص</th>
                                <th class="border-bottom-0">تاريخ الحجز</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($tables as $table)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->email }}</td>
                                    <td>{{ $table->phone }}</td>
                                    <td>{{ $table->count }}</td>
                                    <td>{{ $table->date }}</td>
                                    <td>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $table->id }}" data-table_name="{{ $table->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="حذف">حذف
                                                <i class="las la-trash"></i>
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- delete -->
          <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('delete_table', $i) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="delete-id" value="">
                            <input class="form-control" name="table_name" id="delete-table_name" type="text" vlaue=""
                                readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
          </div>

        </div>
    </div>

<!-- row closed -->
<!-- Container closed -->
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
  $('#modaldemo9').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var table_name = button.data('table_name');
      var modal = $(this);
      modal.find('.modal-body #delete-id').val(id);
      modal.find('.modal-body #delete-table_name').val(table_name);
  });
});
</script>

@endsection
