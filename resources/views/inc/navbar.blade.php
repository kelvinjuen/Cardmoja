<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<header class="site-navbar py-2 bg-white" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-11 col-xl-2">
            <h2 class="mb-0 site-logo"><a class="text-blue" href="/home">Card<span class="text-purple">moja</span></a></h2>
        </div>
        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="/home"><i class="icon-home"></i><span>HOME</span></a></li>
                <li><a href="/card/{{auth()->user()->user_id}}/edit"><span>EDITCARD</span></a></li>
                <li><a href="#"><span>FEATURES</span></a></li>
                <li><a href="#"><span>PRICING</span></a></li>

                 <!-- Authentication Links -->
                @guest
                    <li><a class="cta" href="{{ route('login') }}"><span class="border-left pl-xl-4"></span><span class="bg-primary text-white rounded">{{ __('Sign in') }}</span></a></li>
                @else
                    <li class="has-children">
                        <a href="#"><span class="border-left pl-xl-4"></span><img src="{{ asset('images/uploads/medium/user.png')}}" width="40px"> <span class="caret"></span></a>

                        <ul class="dropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
          </nav>
        </div>


        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>

      </div>
    </div>

  </header>
