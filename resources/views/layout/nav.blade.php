<!-- header section starts -->
<header class="header_section" style="background-color: black;">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
                <span>
                    Feane
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('homee') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.create') }}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showuseroffer') }}">Offer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Previous.requests') }}">Previous Requests</a>
                    </li>
                </ul>
                @if (!empty(Auth::user()->email))
                    <div class="user_option">
                        <div class="container mt-5">
                            <div class="dropdown nav-item main-header-notification">
                                <a class="new nav-link position-relative" href="#" id="notificationDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="notification-badge bg-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                                    <i class="fa fa-bell notification-icon" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 350px;">
                                    <div class="main-message-list chat-scroll">
                                        <div class="menu-header-content bg-primary text-right p-3">
                                            <div class="d-flex">
                                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h6>
                                                <span class="badge badge-pill badge-warning ml-auto my-auto">
                                                    <a href="{{ route('notification.markall') }}" class="text-white">قراءة الكل</a>
                                                </span>
                                            </div>
                                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">
                                                عدد الاشعارات الغير مقروءة: {{ Auth::user()->unreadNotifications->count() }}
                                            </p>
                                        </div>
                                        <div class="main-notification-list Notification-scroll p-2">
                                            @foreach (Auth::user()->unreadNotifications as $not)
                                            <a class="d-flex p-3 border-bottom align-items-center" href="{{ route('show_single_product', $not->data['pro_id']) }}">
                                                <div class="notifyimg bg-pink">
                                                    <i class="la la-file-alt text-white"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h5 class="notification-label mb-1">منتج جديد {{ $not->data['prodect'] }}</h5>
                                                    <div class="notification-subtext text-muted">{{ $not->created_at }}</div>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                        <div class="dropdown-footer text-center p-2">
                                            <a href="" class="text-primary">VIEW ALL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif

                <a class="cart_link" href="{{ route('Basketall') }}">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029"
                          style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                          <g>
                              <g>
                                  <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                  c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                              </g>
                          </g>
                          <g>
                              <g>
                                  <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
              C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
              c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
              C457.728,97.71,450.56,86.958,439.296,84.91z" />
                              </g>
                          </g>
                          <g>
                              <g>
                                  <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
              c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                              </g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                      </svg>
                </a>
                <div class="auth_links">
                    @if (!empty(Auth::user()->email))
                        <a class="order_online" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out"></i> {{ Auth::user()->name }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('register_customer') }}" class="order_online">
                            {{ __('Register') }}
                        </a>
                        <a href="{{ route('login') }}" class="order_online">
                            {{ __('Login') }}
                        </a>
                    @endif
                </div>
            </div>
    </div>
    </nav>
    </div>
</header>
