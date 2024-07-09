<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">dachbored </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        @can('صفحة الادمن')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">home</a>
        </li>
        @endcan
        @can('الاقسام')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('section.index') }}">Section</a>
        </li>
        @endcan
        @can('المنتجات')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('prodect.index') }}">Product</a>
        </li>
        @endcan
        @can('العروض')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('offer.index') }}">offer</a>
        </li> 
        @endcan
        @can('الطلبات')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('offer.create') }}">Orderoffer</a>
        </li>
        @endcan
        @can('الطلبات')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index') }}">Orders</a>
        </li>
        @endcan
        @can('الطلبات المقبولة')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.acceptedshow') }}">Order accepted</a>
        </li>
        @endcan
        @can('الطلبات المرفوضة')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.Orderrejected') }}">Order rejected</a>
        </li>
        @endcan
        @can('الطلبات اللي تمت')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.Ordercompleted') }}">Order completed</a>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" href="{{ route('table_show') }}">tables</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('show_users') }}">users</a>
        </li>

            @can('الصلاحيات المستخدمين')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">roles</a>
            </li>
            @endcan
            @can('المستخدمين')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">admins</a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bx bx-log-out"></i> تسجيل خروج
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
