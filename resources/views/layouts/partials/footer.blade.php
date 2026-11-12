<footer class="footer">
    <div class="container">
        <div class="row gy-3">
            <!-- Quick Links -->
            <div class="col-6 col-md-3">
                <h5>{{ __('messages.quick_links') }}</h5>
                <ul class="list-unstyled footer-link-list">
                    <li><a href="{{ route('about.index') }}"><i class="fas fa-chevron-right"></i>{{ __('messages.about_us') }}</a></li>
                    <li><a href="{{ route('gallery.photos') }}"><i class="fas fa-chevron-right"></i>{{ __('messages.photo_gallery') }}</a></li>
                    <li><a href="{{ route('gallery.videos') }}"><i class="fas fa-chevron-right"></i>{{ __('messages.video_gallery') }}</a></li>
                    <li><a href="{{ route('contact.index') }}"><i class="fas fa-chevron-right"></i>{{ __('messages.contact_us') }}</a></li>
                </ul>
            </div>

            <!-- Useful Links -->
            <div class="col-6 col-md-3">
                <h5>{{ __('messages.useful_links') }}</h5>
                <ul class="list-unstyled footer-link-list useful-links">
                    <li><a href="{{ route('education.quran') }}"><i class="fas fa-book-open"></i>কুরআন শিক্ষা</a></li>
                    <li><a href="{{ route('education.hadith') }}"><i class="fas fa-book-reader"></i>হাদীস শিক্ষা</a></li>
                    <li><a href="{{ route('central.committee') }}"><i class="fas fa-users"></i>কমিটি</a></li>
                    <li><a href="{{ route('donate.index') }}"><i class="fas fa-hand-holding-heart"></i>অনলাইন দান</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-12 col-md-3">
                <h5>{{ __('messages.contact_us') }}</h5>
                <ul class="list-unstyled footer-contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>৭৯/ক/৩, উত্তর যাত্রাবাড়ী, ঢাকা-১২০৪</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:+8801765812261" class="text-decoration-none text-light">+৮৮০১৭৬৫-৮১২২৬১</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info.shubbanbd@gmail.com" class="text-decoration-none text-light">info.shubbanbd@gmail.com</a>
                    </li>
                </ul>
            </div>

            <!-- Social Media & Newsletter -->
            <div class="col-12 col-md-3">
                <h5>{{ __('messages.social_media') }}</h5>
                <div class="social-links mb-3">
                    <a href="https://www.facebook.com/shubban" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/@ShubbanDawah" target="_blank" rel="noopener noreferrer" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>

                <!-- Newsletter -->
                <div class="newsletter-wrap">
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control form-control-sm" placeholder="{{ __('messages.email') }}">
                            <button class="btn btn-sm btn-primary" type="submit">{{ __('messages.subscribe') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container p-0">
                <p>কপিরাইট &copy; {{ date('Y') }} জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ। সর্বস্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </div>
</footer>
