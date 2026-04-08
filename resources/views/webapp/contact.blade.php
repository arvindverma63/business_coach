<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="{{ route('webapp.home') }}">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="hero-contact">
            <div class="container">
                <div class="row">
                    <div class="col-12 contact-h">
                        <h1>Contact Us <img src="{{ asset('website/assets/img/arrow.png') }}" alt=""></h1>
                    </div>
                    <div class="col-12">
                        <div class="contact-banner contact-banner1">
                            <img src="{{ asset('website/assets/img/contact1banner.png') }}" alt=""
                                class="contact1banner">
                            <img src="{{ asset('website/assets/img/contact2banner.png') }}" alt=""
                                class="contact2banner">
                            <img src="{{ asset('website/assets/img/building1.png') }}" alt="" class="building1">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <div class="container">
                <h2 class="contact-title">
                    Thoughtful Conversations Begin With Clarity
                </h2>
                <p>This platform is designed for leaders, coaches, and decision-makers who value discretion, intent, and
                    relevance.
                    Every message we receive is read with care and responded to selectively.</p>
                <p>To maintain quality and focus, we do not offer phone-based support. All communication is handled
                    through written correspondence.</p>

                <form id="contactInquiryForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" required />
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required />
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" required></textarea>
                    </div>

                    <button type="submit" class="send-btn" id="btnSubmitInquiry">
                        <span>Send Message »</span>
                    </button>
                </form>
            </div>
        </section>

        <div class="contact-box">
            <div class="contact-info">
                <div class="info-item">
                    <i class="fa fa-phone"></i>
                    <div class="info-text">
                        <small>Requesting A Call:</small>
                        <strong>{{ $settings->phone ?? '(629) 555-0129' }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fa fa-envelope"></i>
                    <div class="info-text">
                        <small>E-mail</small>
                        <strong>{{ $settings->email ?? 'info@example.com' }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fa fa-location-dot"></i>
                    <div class="info-text">
                        <small>Location</small>
                        <strong>{!! nl2br(e($settings->address)) ?? '6391 Elgin St. Celina, <br /> Delaware 10299' !!}</strong>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="timing">
                @if ($settings->office_timing)
                    <div class="office-timing-html">
                        {!! $settings->office_timing !!}
                    </div>
                @else
                    <div class="time-item">
                        <small>Monday</small>
                        <span><i class="fa fa-clock"></i> 9 am - 8 pm</span>
                    </div>
                    <div class="time-item">
                        <small>Tuesday–Friday</small>
                        <span><i class="fa fa-clock"></i> 12 am - 9 pm</span>
                    </div>
                    <div class="time-item">
                        <small>Saturday</small>
                        <span><i class="fa fa-clock"></i> 8 am - 3 pm</span>
                    </div>
                @endif
            </div>

            <div class="map">
                @if ($settings->google_map_link)
                    {!! $settings->google_map_link !!}
                @else
                    <img src="{{ asset('website/assets/img/googlemap.png') }}" alt="map" />
                @endif
            </div>
        </div>
    </main>

    @push('scripts')
        <style>
            .office-timing-html p {
                margin-bottom: 0.75rem;
            }

            .office-timing-html p:last-child {
                margin-bottom: 0;
            }

            .office-timing-html ul,
            .office-timing-html ol {
                margin-bottom: 0.75rem;
                padding-left: 1.25rem;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#contactInquiryForm').on('submit', function(e) {
                    e.preventDefault();

                    let btn = $('#btnSubmitInquiry');
                    btn.prop('disabled', true).html('Sending... <i class="fa fa-spinner fa-spin"></i>');

                    $.ajax({
                        url: "{{ route('contact.inquiry.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Message Sent',
                                text: res.message,
                                timer: 3000
                            });
                            $('#contactInquiryForm')[0].reset();
                        },
                        error: function(xhr) {
                            let errorMsg = xhr.responseJSON?.message || "Something went wrong.";
                            Swal.fire('Error', errorMsg, 'error');
                        },
                        complete: function() {
                            btn.prop('disabled', false).html('<span>Send Message »</span>');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-web-app-layout>
