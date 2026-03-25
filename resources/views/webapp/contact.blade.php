<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="#">Home</a>
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
                            <img src="{{ asset('website/assets/img/contact1banner.png') }}" alt="" class="contact1banner">
                            <img src="{{ asset('website/assets/img/contact2banner.png') }}" alt="" class="contact2banner">
                            <img src="{{ asset('website/assets/img/building1.png') }}" alt="" class="building1">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-section">
            <div class="container">
                <h2 class="contact-title">
                    Thoughtful Conversations Begin  With Clarity
                </h2>
                <p>This platform is designed for leaders, coaches, and decision-makers who value discretion, intent, and relevance.
Every message we receive is read with care and responded to selectively.</p>
<p>To maintain quality and focus, we do not offer phone-based support. All communication is handled through written correspondence.</p>

                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" />
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" />
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea></textarea>
                    </div>

                    <button class="send-btn">Send Message <span>»</span></button>
                </form>
            </div>
        </section>
        <div class="contact-box">
            <!-- contact info -->

            <div class="contact-info">
                <div class="info-item">
                    <i class="fa fa-phone"></i>
                    <div class="info-text">
                        <small>Requesting A Call:</small>
                        <strong>(629) 555-0129</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fa fa-envelope"></i>
                    <div class="info-text">
                        <small>E-mail</small>
                        <strong>info@example.com</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fa fa-location-dot"></i>
                    <div class="info-text">
                        <small>Location</small>
                        <strong>6391 Elgin St. Celina,<br />Delaware 10299</strong>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- timing -->

            <div class="timing">
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
            </div>

            <!-- map -->

            <div class="map">
                <img src="{{ asset('website/assets/img/googlemap.png') }}" alt="map" />
            </div>
        </div>
    </main>

</x-web-app-layout>
