  <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">

          <div class="col-auto">
              <a class="navbar-brand text-white" href="{{ route('front.home') }}">
                  {{-- خلي اللوجو تبعك هون --}}
                  <svg width="112" height="45" viewBox="0 0 112 45" xmlns="http://www.w3.org/2000/svg" fill="#111">
                      <path d="..."></path>
                  </svg>
              </a>
          </div>

          <div class="col-auto">
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                  data-bs-target="#offcanvasNavbar">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                  <div class="offcanvas-header">
                      <h5 class="offcanvas-title">Menu</h5>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                  </div>

                  <div class="offcanvas-body">
                      <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">

                          <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}"
                                  href="{{ route('front.home') }}">Home</a>
                          </li>

                          <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('front.shop') ? 'active' : '' }}"
                                  href="{{ route('front.shop.index') }}">Shop</a>
                          </li>

                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle {{ request()->routeIs('front.pages.*') ? 'active' : '' }}"
                                  href="#" id="dropdownPages" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  Pages
                              </a>
                              <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownPages">
                                  <li><a class="dropdown-item item-anchor"
                                          href="{{ route('front.pages.about') }}">About</a></li>
                                  <li><a class="dropdown-item item-anchor"
                                    
                                          href="{{ route('front.cart.index') }}">Cart</a></li>
                                  <li><a class="dropdown-item item-anchor"
                                          href="{{ route('front.checkout.index') }}">Checkout</a></li>
                                  <li><a class="dropdown-item item-anchor" href="{{ route('profile.edit') }}">My
                                          Account</a></li>
                                  <li><a class="dropdown-item item-anchor"
                                          href="{{ route('front.pages.order-tracking.index') }}">Order Tracking</a>
                                  </li>
                                  <li><a class="dropdown-item item-anchor"
                                          href="{{ route('front.wishlist.index') }}">Wishlist</a></li>
                              </ul>
                          </li>

                          <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('front.blog.*') ? 'active' : '' }}"
                                  href="{{ route('front.blog.index') }}">Blog</a>
                          </li>

                          <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}"
                                  href="{{ route('front.contact') }}">Contact</a>
                          </li>
                          @guest
                              <a href="{{ route('login') }}"
                                  class="nav-item nav-link {{ Request()->routeIs('login') ? 'active' : '' }}">Login</a>
                              <a href="{{ route('register') }}"
                                  class="nav-item nav-link {{ Request()->routeIs('register') ? 'active' : '' }}">Register</a>

                          @endguest
                          @auth
                              <a href="{{ route('dashboard') }}"
                                  class="nav-item nav-link {{ Request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                  class="nav-item nav-link {{ Request()->routeIs('logout') ? 'active' : '' }}">Logout</a>

                          @endauth



                      </ul>
                  </div>
              </div>
          </div>

          <div class="col-3 col-lg-auto">
              <ul class="list-unstyled d-flex m-0 align-items-center">

                  <li class="d-none d-lg-block">
                      <a href="#" class="text-uppercase mx-3">
                          Wishlist (<span id="wishlist-count">{{ $wishlistCount }}</span>) </a>
                  </li>

                  <li class="d-none d-lg-block">
                      <a href="{{ route('front.cart.index') }}" class="text-uppercase mx-3" data-bs-toggle="offcanvas"
                          data-bs-target="#offcanvasCart">
                          Cart <span class="cart-count">({{ $cartCount }})</span>
                      </a>
                  </li>

                  <li class="search-box mx-2">
                      <a href="#search" class="search-button">
                          <svg width="24" height="24" viewBox="0 0 24 24">
                              <use xlink:href="#search"></use>
                          </svg>
                      </a>
                  </li>

              </ul>
          </div>

      </div>
  </div>
