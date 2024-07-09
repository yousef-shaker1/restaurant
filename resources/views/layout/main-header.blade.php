<title> @yield('title') </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />

  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Custom styles for this template -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .user_option {
  display: flex;
  align-items: center;
}

.auth_links {
  display: flex;
  gap: 10px; /* مسافة بين الروابط */
}

.auth_links a {
  color: white; /* يمكنك تعديل اللون حسب الحاجة */
  text-decoration: none;
  padding: 5px 10px;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.auth_links a:hover {
  background-color: rgba(255, 255, 255, 0.1); /* لون الخلفية عند التمرير */
}
.user_option {
    position: relative;
}
.main-header-notification {
    position: absolute;
    top: 3px; 
    left: -25px; 
}

.notification-badge {
    position: absolute;
    top: -10px; /* تعديل هذه القيمة حسب الحاجة */
    right: 0;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 12px;
}

/* تكبير عرض القائمة المنسدلة */
.dropdown-menu {
    width: 350px; /* تعديل العرض حسب الحاجة */
}

.main-notification-list.Notification-scroll {
    max-height: 300px; /* تعديل الارتفاع حسب الحاجة */
    overflow-y: auto;
}
.order_online {
    background-color: orange;
    color: white; 
    border: none; 
    padding: 10px 50px;
    font-size: 16px;
   
}

  </style>
@yield('css')
