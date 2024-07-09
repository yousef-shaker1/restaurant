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
الاوردرات
@endsection

@section('con')

    <!-- row -->
    @if ($errors->any())
        <div class='alert alert-danger'>
            @foreach ($errors->all() as $error)
                {{ $error }}
                <br>
            @endforeach
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="row">
        
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @can('اضافةقسم')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                        data-toggle="modal" href="#exampleModal">اضافة قسم</a>
                        @endcan
                        
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sections as $section)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $section->name }}</td>
                                        <td>

                                            @can('تعديل قسم')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                                data-effect="effect-scale" data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->name }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل">تعديل
                                                <i class="las la-pen"></i>
                                            </a>
                                            @endcan

                                            @can('حذف قسم')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $section->id }}" data-section_name="{{ $section->name }}" data-toggle="modal"
                                                href="#modaldemo9" title="حذف">حذف<i class="las la-trash"></i></a>

                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper mt-4">
                            <ul class="pagination justify-content-center">
                              <!-- زر الصفحة السابقة -->
                              @if ($sections->onFirstPage())
                                  <li class="page-item disabled"><span class="page-link">السابق</span></li>
                              @else
                                  <li class="page-item"><a href="{{ $sections->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                              @endif
                      
                              <!-- أرقام الصفحات -->
                              @foreach(range(1, $sections->lastPage()) as $page)
                                  <li class="page-item {{ $page == $sections->currentPage() ? 'active' : '' }}">
                                      <a href="{{ $sections->url($page) }}" class="page-link">{{ $page }}</a>
                                  </li>
                              @endforeach
                      
                              <!-- زر الصفحة التالية -->
                              @if ($sections->hasMorePages())
                                  <li class="page-item"><a href="{{ $sections->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                              @else
                                  <li class="page-item disabled"><span class="page-link">التالي</span></li>
                              @endif
                          </ul>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة قسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('section.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">اسم قسم</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- End Basic modal -->
    </div>
    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('section.update', $i) }}" method="post" autocomplete="off">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="section_name" class="col-form-label">اسم القسم:</label>
                            <input class="form-control" name="name" id="section_name" type="text">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('section.destroy', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="section_name" id="section_name" type="text"
                            vlaue="" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
                </form>
        </div>
    </div>




    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    @endsection
    @section('js')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    $('#exampleModal2').on('show.bs.modal', function(event) {
        // الحصول على الزر الذي أطلق الحدث
        var button = $(event.relatedTarget);
        // استخراج المعلومات من سمات البيانات
        var id = button.data('id');
        var sectionName = button.data('section_name');
        // تحديث محتوى الحقول في النموذج داخل الـ modal
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(sectionName);
    });
});

$(document).ready(function() {
    $('#modaldemo9').on('show.bs.modal', function(event) {
        // الحصول على الزر الذي أطلق الحدث
        var button = $(event.relatedTarget);
        // استخراج المعلومات من سمات البيانات
        var id = button.data('id');
        var section_name = button.data('section_name');
        // تحديث محتوى الحقول في النموذج داخل الـ modal
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    });
});
    </script>
@endsection
