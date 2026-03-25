<x-web-app-layout>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-box">
                    <a href="#">Home</a>
                    <span><i class="bi bi-chevron-right"></i></span>
                    <a href="#">{{ $content->title }}</a>
                </div>
            </div>
        </div>
    </div>
    <section class="hero-contact">
        <div class="container">
            <div class="row">
                <div class="col-12 contact-h">
                    <h1>{{ $content->title }} <img src="{{ asset('website/assets/img/arrow.png') }}" alt=""></h1>
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
            {!! $content->description !!}
        </div>
    </section>
</x-web-app-layout>
