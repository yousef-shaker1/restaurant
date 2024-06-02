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
                        @can('اضافةعرض')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#exampleModal">اضافة عرض</a>
                        @endcan

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم العرض</th>
                                    <th class="border-bottom-0">صورة العرض</th>
                                    <th class="border-bottom-0">وصف العرض</th>
                                    <th class="border-bottom-0">سعر العرض</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($offers as $offer)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $offer->name }}</td>
                                        <td><a href="{{ Storage::url($offer->image) }}"><img src="{{ Storage::url($offer->image) }}" style="width: 80px; height:80px; auto;"> </a></td>
                                        <td>{{ $offer->description }}</td>
                                        <td>{{ $offer->price }}</td>
                                        <td>

                                            @can('تعديل عرض')
                                            <a class="modal-effect btn btn-sm btn-info custom-btn"
                                                data-effect="effect-scale" data-id="{{ $offer->id }}"
                                                data-name="{{ $offer->name }}" data-image="{{ $offer->image }}"
                                                data-description="{{ $offer->description }}"
                                                data-price="{{ $offer->price }}"
                                               data-toggle="modal"
                                                href="#exampleModal2" title="تعديل">تعديل
                                                <i class="las la-pen"></i>
                                            </a>
                                            @endcan

                                            @can('حذف عرض')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $offer->id }}" data-prodect_name="{{ $offer->name }}" data-toggle="modal"
                                                href="#modaldemo9" title="حذف">حذف<i class="las la-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    <form action="{{ route('offer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">اسم عرض</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <label for="name">وصف العرض</label>
                                <input type="text" class="form-control" id="description" name="description">
                                <label for="name">سعر العرض </label>
                                <input type="text" class="form-control" id="price" name="price">
                                <label for="section">القسم التابع لية</label>

                                <label for="image">صورة العرض</label>
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
                
                <form action="{{ route('offer.update', $i) }}" method="post" autocomplete="off">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                            <label for="name">اسم منتج</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="name">وصف منتج</label>
                            <input type="text" class="form-control" id="description" name="description">
                            <label for="name">سعر المنتج </label>
                            <input type="text" class="form-control" id="price" name="price">
                            <label for="section_name">القسم التابع لية</label>
                            <label for="image">صورة المنتج الحالية</label>
                            <br>
                            @if(!empty($offer))
                            <a href="{{ Storage::url($offer->image) }}"><img src="{{ Storage::url($offer->image) }}" style="width: 80px; height:80px; auto;"> </a>
                            @endif
                            <br>
                            <label for="image">رفع صورة جديدة</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <!-- عنصر لعرض اسم الملف المختار -->
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
                <form action="{{ route('offer.destroy', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="prodect_name" id="prodect_name" type="text"
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
<!-- تأكد من إضافة سكربتات الجافا سكريبت في نهاية البودي -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#exampleModal2').on('show.bs.modal', function(event) {
            // الحصول على الزر الذي أطلق الحدث
            var button = $(event.relatedTarget);
            // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var name = button.data('name');
                var image = button.data('image');
                var description = button.data('description');
                var section_id = button.data('section_id');
                var price = button.data('price');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                // لتحديث عرض الصورة
                modal.find('.modal-body #image-preview').attr('src', '/photo/' + image);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #price').val(price);
                // لتحديد القسم المناسب
            });
        });

        $(document).ready(function() {
            $('#modaldemo9').on('show.bs.modal', function(event) {
                // الحصول على الزر الذي أطلق الحدث
                var button = $(event.relatedTarget);
                // استخراج المعلومات من سمات البيانات
                var id = button.data('id');
                var prodect_name = button.data('prodect_name');
                // تحديث محتوى الحقول في النموذج داخل الـ modal
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #prodect_name').val(prodect_name);
            });
        });
    </script>

@endsection
