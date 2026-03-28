    <div class="container">
      <div class="row d-flex flex-wrap justify-content-between py-5">
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-001">
            <div class="footer-intro mb-4">
              <a href="index.html">
                <img src="{{ asset($settings['site_logo']) }}" alt="logo">
              </a>
            </div>
            <p>{{ $settings['about_content'] }}.</p>
            <div class="social-links">
              <ul class="list-unstyled d-flex flex-wrap gap-3">
                <li>
                     @isset($settings['facebook'])
                  <a href="{{ $settings['facebook'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#facebook"></use>
                    </svg>
                  </a>
                    @endisset
                </li>
                <li>
                     @isset($settings['x'])
                  <a href="{{ $settings['x'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#twitter"></use>
                    </svg>
                  </a>
                    @endisset
                </li>
                <li>
                     @isset($settings['instagram'])
                  <a href="{{ $settings['instagram'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#instagram"></use>
                    </svg>
                  </a>
                    @endisset
                </li>
                <li>
                     @isset($settings['youtube'])
                  <a href="{{ $settings['youtube'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#youtube"></use>
                    </svg>
                  </a>
                    @endisset
                </li>
                <li>
                     @isset($settings['pinterest'])
                  <a href="{{ $settings['pinterest'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#pinterest"></use>
                    </svg>
                  </a>
                    @endisset
                </li>

                <li>
                        @isset($settings['linkedin'])
                  <a href="{{ $settings['linkedin'] }}" class="text-secondary" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#linkedin"></use>
                    </svg>
                  </a>
                    @endisset
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-002">
            <h5 class="widget-title text-uppercase mb-4">Quick Links</h5>
            <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
              <li class="menu-item">
                <a href="{{ route('front.home') }}" class="item-anchor">Home</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('front.pages.about') }}" class="item-anchor">About</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('front.blog.index') }}" class="item-anchor">Services</a>
              </li>

              <li class="menu-item">
                <a href="{{ route('front.contact') }}" class="item-anchor">Contact</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-003">
            <h5 class="widget-title text-uppercase mb-4">Help & Info</h5>
            <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
              <li class="menu-item">
                <a href="#" class="item-anchor">Track Your Order</a>
              </li>
              <li class="menu-item">
                <a href="#" class="item-anchor">Returns + Exchanges</a>
              </li>
              <li class="menu-item">
                <a href="#" class="item-anchor">Shipping + Delivery</a>
              </li>
              <li class="menu-item">
                <a href="#" class="item-anchor">Contact Us</a>
              </li>
              <li class="menu-item">
                <a href="#" class="item-anchor">Find us easy</a>
              </li>
              <li class="menu-item">
                <a href="index.html" class="item-anchor">Faqs</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-004 border-animation-left">
            <h5 class="widget-title text-uppercase mb-4">Contact Us</h5>
            <p>Do you have any questions or suggestions? <a href="mailto:{{ $settings['mail_us'] }}"
                class="item-anchor">contact : {{ $settings['mail_us'] }}</a></p>
            <p>Do you need support? Give us a call. <a href="tel:{{ $settings['call_us'] }}" class="item-anchor">{{ $settings['call_us'] }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="border-top py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 d-flex flex-wrap">
            <div class="shipping">
              <span>We ship with:</span>
              <img src="{{ asset('assets/images/arct-icon.png') }}" alt="icon">
              <img src="{{ asset('assets/images/dhl-logo.png') }}" alt="icon">
            </div>
            <div class="payment-option">
              <span>Payment Option:</span>
              <img src="{{ asset('assets/images/visa-card.png') }}" alt="card">
              <img src="{{ asset('assets/images/paypal-card.png') }}" alt="card">
              <img src="{{ asset('assets/images/master-card.png') }}" alt="card">
            </div>
          </div>
          <div class="col-md-6 text-end">
            <p>© Copyright 2022 Kaira. All rights reserved. Design by <a href="https://templatesjungle.com"
                target="_blank">TemplatesJungle</a> Distribution By <a href="https://themewagon.com"
              target="blank">ThemeWagon</a></p>
          </div>
        </div>
      </div>
    </div>

