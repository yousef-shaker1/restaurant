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
                    @can('اضافةالمنتجات')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#exampleModal">اضافة منتج</a>
                    @endcan

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">صورة المنتج</th>
                                <th class="border-bottom-0">وصف المنتج</th>
                                <th class="border-bottom-0">سعر المنتج</th>
                                <th class="border-bottom-0">القسم التابع لية</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($prodects as $prodect)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $prodect->name }}</td>
                                    <td><a href="{{ Storage::url($prodect->image) }}"><img
                                                src="{{ Storage::url($prodect->image) }}"
                                                style="width: 80px; height:80px; auto;"></a></td>
                                    <td>{{ $prodect->description }}</td>
                                    <td>{{ $prodect->price }}</td>
                                    <td>{{ $prodect->section->name }}</td>
                                    <td>
                                        @can('تعديل المنتجات')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn edit-button"
                                                data-effect="effect-scale" data-id="{{ $prodect->id }}"
                                                data-name="{{ $prodect->name }}"
                                                data-image="{{ Storage::url($prodect->image) }}"
                                                data-description="{{ $prodect->description }}"
                                                data-price="{{ $prodect->price }}"
                                                data-section_id="{{ $prodect->section->id }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل">تعديل
                                                <i class="las la-pen"></i>
                                            </a>
                                        @endcan

                                        @can('حذف المنتجات')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $prodect->id }}" data-prodect_name="{{ $prodect->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="حذف">حذف
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper mt-4">
                        <ul class="pagination justify-content-center">
                            <!-- زر الصفحة السابقة -->
                            @if ($prodects->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">السابق</span></li>
                            @else
                                <li class="page-item"><a href="{{ $prodects->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                            @endif
    
                            <!-- أرقام الصفحات -->
                            @foreach(range(1, $prodects->lastPage()) as $page)
                                <li class="page-item {{ $page == $prodects->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $prodects->url($page) }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endforeach
    
                            <!-- زر الصفحة التالية -->
                            @if ($prodects->hasMorePages())
                                <li class="page-item"><a href="{{ $prodects->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
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
                <form action="{{ route('prodect.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">اسم منتج</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="description">وصف منتج</label>
                            <input type="text" class="form-control" id="description" name="description">
                            <label for="price">سعر المنتج </label>
                            <input type="text" class="form-control" id="price" name="price">
                            <label for="section">القسم التابع لية</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> -حدد القسم-</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>

                            <label for="image">صورة المنتج</label>
                            <input type="file" class="form-control" id="image" name="image">
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

                <form action="{{ route('prodect.update', $i) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="edit-id" value="">
                        <label for="name">اسم منتج</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                        <label for="description">وصف منتج</label>
                        <input type="text" class="form-control" id="edit-description" name="description">
                        <label for="price">سعر المنتج </label>
                        <input type="text" class="form-control" id="edit-price" name="price">
                        <label for="section_name">القسم التابع لية</label>
                        <select name="section_id" id="edit-section_id" class="custom-select my-1 mr-sm-2" required>
                            @foreach ($sections as $section)
                                <option value='{{ $section->id }}'>{{ $section->name }}</option>
                            @endforeach
                        </select>
                        <label for="current-image">صورة المنتج الحالية</label>
                        <br>
                        <img id="current-image" style="width: 80px; height:80px;">
                        <br><br>
                        <input type="hidden" name="current_image" id="current_image">
                        <label for="image">رفع صورة جديدة</label>
                        <input type="file" class="form-control" id="image" name="image">
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
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('prodect.destroy', $i) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="delete-id" value="">
                    <input class="form-control" name="prodect_name" id="delete-prodect_name" type="text" vlaue=""
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

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var image = button.data('image');
            var description = button.data('description');
            var section_id = button.data('section_id');
            var price = button.data('price');
            var modal = $(this);
            modal.find('.modal-body #edit-id').val(id);
            modal.find('.modal-body #edit-name').val(name);
            modal.find('.modal-body #edit-description').val(description);
            modal.find('.modal-body #edit-price').val(price);
            modal.find('.modal-body #edit-section_id').val(section_id);
            modal.find('.modal-body #current-image').attr('src', image);
            modal.find('.modal-body #current_image').val(image);
        });
    });

    $(document).ready(function() {
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var prodect_name = button.data('prodect_name');
            var modal = $(this);
            modal.find('.modal-body #delete-id').val(id);
            modal.find('.modal-body #delete-prodect_name').val(prodect_name);
        });
    });
</script>

@endsection
