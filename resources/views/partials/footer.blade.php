 <footer class="footer-section">

     <div class="container">

         <div class="row gy-4">

             <!-- Company -->
             <div class="col-lg-4">

                 <img src="{{ asset('assets/images/hero.png') }}" height="60">

                 <h5 class="mt-3 fw-bold">
                     Nature's Gold Honey
                 </h5>

                 <p>
                     We produce 100% pure natural honey directly from our own bee farms.
                     Visit our store in Hastinapur, Hyderabad.
                 </p>

             </div>

             <!-- Quick Links -->
             <div class="col-lg-2">

                 <h5>Quick Links</h5>

                 <ul class="footer-links">

                     <li><a href="{{ route('home') }}">Home</a></li>

                     <li><a href="{{ route('shop') }}">Shop</a></li>

                     <li><a href="{{ route('about') }}">About</a></li>

                     <li><a href="{{ route('contact') }}">Contact</a></li>

                 </ul>

             </div>

             <!-- Customer -->
             <div class="col-lg-3">

                 <h5>Customer</h5>

                 <ul class="footer-links">

                     @if (Auth::guard('customer')->check())
                         <li><a href="{{ route('customer.dashboard') }}">My Account</a></li>

                         <li><a href="{{ route('customer.orders') }}">My Orders</a></li>

                         <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                     @else
                         <li><a href="{{ route('customer.login') }}">My Account</a></li>

                         <li><a href="{{ route('customer.login') }}">My Orders</a></li>

                         <li><a href="{{ route('customer.login') }}">Wishlist</a></li>
                     @endif

                     <li><a href="{{ route('customer.login') }}">Login</a></li>

                 </ul>

             </div>

             <!-- Contact -->
             <div class="col-lg-3">

                 <h5>Contact Us</h5>

                 <p>
                     📍 Hastinapur, Hyderabad
                 </p>

                 <p>
                     📞 +91 7989499622
                 </p>

                 <p>
                     ✉ info@naturesgoldhoney.com
                 </p>

                 <div class="social-icons">

                     <a href="#"><i class="fab fa-facebook-f"></i></a>

                     <a href="#"><i class="fab fa-instagram"></i></a>

                     <a href="#"><i class="fab fa-youtube"></i></a>

                     <a href="#"><i class="fab fa-whatsapp"></i></a>

                 </div>

             </div>

         </div>

         <hr>

         <div class="text-center">

             © {{ date('Y') }} Nature's Gold Honey. All Rights Reserved.

         </div>

     </div>

 </footer>
 <a href="https://wa.me/917989499622" class="whatsapp-float" target="_blank">

     <i class="fab fa-whatsapp"></i>

 </a>

 <script>
     const scrollBtn = document.getElementById('scrollTop');

     window.addEventListener('scroll', function() {

         if (window.scrollY > 250) {
             scrollBtn.style.display = 'flex';
         } else {
             scrollBtn.style.display = 'none';
         }

     });

     scrollBtn.addEventListener('click', function() {

         window.scrollTo({
             top: 0,
             behavior: 'smooth'
         });

     });
 </script>
