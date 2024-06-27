<div class="food_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>كل الوجبات</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input wire:model.lazy="search" type="text" class="form-control" placeholder="Search products...">
                    <div class="input-group-append">
                        <button wire:click="searchProducts" class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <ul class="filters_menu">
            <li class="{{ $sectionId === null || $sectionId === 'all' ? 'active' : '' }}" wire:click="showSection('all')">All</li>
            @foreach ($sections as $section)
                <li class="{{ $sectionId == $section->id ? 'active' : '' }}" wire:click="showSection('{{ $section->id }}')">{{ $section->name }}</li>
            @endforeach
        </ul>
        <div class="filters-content">
            <div class="row grid">
                @foreach ($products as $product)
                <div class="col-sm-6 col-lg-4 all {{ $product->section->name }}">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ Storage::url($product->image) }}" style="width: 200px; height:200px; auto;">
                        </div>
                        <div class="detail-box">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ $product->description }}</p>
                            <div class="options">
                                <h6>{{ $product->price }} EGP</h6>
                                <a href="{{ route('order.show', $product->id) }}">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                        <!-- SVG Content -->
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="pagination-wrapper mt-4">
            <ul class="pagination justify-content-center">
                <!-- زر الصفحة السابقة -->
                @if ($products->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">السابق</span></li>
                @else
                    <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
                @endif

                <!-- أرقام الصفحات -->
                @foreach(range(1, $products->lastPage()) as $page)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a href="{{ $products->url($page) }}" class="page-link">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- زر الصفحة التالية -->
                @if ($products->hasMorePages())
                    <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">التالي</span></li>
                @endif
            </ul>
        </div>

        <div class="btn-box">
            <a href="{{ route('home.create') }}">View More</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('input', function(event){
        if(event.target.matches('[wire\\:model]')){
            window.livewire.directive('refresh');
        }
    });
</script>
