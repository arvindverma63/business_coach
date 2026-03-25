<footer class="footer-section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <h4 class="footer-title">Business Coaching India</h4>

                <p class="footer-text">
                    India's premier platform connecting entrepreneurs, CEOs, and business families with
                    vetted coaches to drive growth and organizational excellence.
                </p>

                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Quick Links</h5>

                <ul class="footer-list">
                    <li>
                        <a href="{{ route('webapp.home') }}"><i class="bi bi-check-lg"></i> Home</a>
                    </li>
                    <li>
                        <a href="{{ route('webapp.about-us') }}"><i class="bi bi-check-lg"></i> About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('webapp.rank') }}"><i class="bi bi-check-lg"></i> Coach Rankings</a>
                    </li>
                    <li>
                        <a href="{{ route('webapp.find-coach') }}"><i class="bi bi-check-lg"></i> Find a Coach</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Resources</h5>

                <ul class="footer-list">
                    <li>
                        <a href="{{ route('webapp.blogs') }}"><i class="bi bi-chevron-right"></i> Latest Blogs</a>
                    </li>
                    <li>
                        <a href="{{ route('webapp.contact') }}"><i class="bi bi-chevron-right"></i> Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('webapp.find-coach') }}"><i class="bi bi-chevron-right"></i> Search
                            Coaches</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="footer-heading">Subscribe Our Newsletter</h5>

                <p class="footer-text">
                    Stay updated with the latest coaching insights and success stories.
                </p>
                {{-- Newsletter Form --}}
                <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="newsletter">
                        <input type="email" name="email" id="newsletter_email" placeholder="Enter Email" required />
                        <button type="submit" id="newsletter_btn">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                    {{-- Container for AJAX messages --}}
                    <div id="newsletter-status" class="mt-2 small" style="display:none;"></div>
                </form>
            </div>
        </div>

        <hr class="footer-line" />

        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="bottom-text">
                    &copy; {{ date('Y') }} India's Trusted Platform to Find the Best Business Coaches.
                </p>
            </div>

            <div class="col-md-6 text-md-end endfooter">
                <a href="{{ route('terms-and-conditions') }}">Terms & Condition</a>
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('webapp.contact') }}">Contact Us</a>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#newsletterForm').on('submit', function (e) {
                    e.preventDefault();

                    const $form = $(this);
                    const $btn = $('#newsletter_btn');
                    const $status = $('#newsletter-status');
                    const originalBtnHtml = $btn.html();

                    // UI Reset
                    $status.hide().removeClass('text-success text-danger').html('');
                    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

                    $.ajax({
                        url: $form.attr('action'),
                        method: 'POST',
                        data: $form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $status.addClass('text-success').html(response.message).fadeIn();
                            $form.trigger('reset'); // Clear the email input
                        },
                        error: function (xhr) {
                            let errorMsg = 'Something went wrong. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            $status.addClass('text-danger').html(errorMsg).fadeIn();
                        },
                        complete: function () {
                            $btn.prop('disabled', false).html(originalBtnHtml);
                        }
                    });
                });
            });
        </script>
    @endpush
</footer>
