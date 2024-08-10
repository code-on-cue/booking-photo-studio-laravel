<!-- ***** Header Area Start ***** -->
@php
    $names = explode(' ', ConfigHelper::get('appName'));
    $firstName = $names[0];
    if (count($names) >= 2) {
        array_shift($names);
        $lastName = implode(' ', $names);
    } else {
        $lastName = '';
    }
@endphp
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ asset('/') }}" class="logo">
                        <h4>
                            {{ $firstName }}
                            <span>{{ $lastName }}</span>
                        </h4>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        @yield('navbar')
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header> <!-- ***** Header Area End ***** -->
