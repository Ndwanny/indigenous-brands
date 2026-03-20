@extends('layouts.app')

@section('title', 'Contact Us - Indigenous Brands | Get in Touch')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'Contact'])

    {{-- ===================== CONTACT INFO BOXES ===================== --}}
    <section class="ftco-section ftco-no-pb contact-section mb-4">
        <div class="container">
            <div class="row d-flex contact-info">
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <h3 class="mb-2">Address</h3>
                        <p>Lusaka, Zambia</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-phone"></span>
                        </div>
                        <h3 class="mb-2">Contact Number</h3>
                        <p><a href="tel:+260123456789">+260 123 456 789</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-paper-plane"></span>
                        </div>
                        <h3 class="mb-2">Email Address</h3>
                        <p><a href="mailto:info@indigenousbrands.zm">info@indigenousbrands.zm</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-whatsapp"></span>
                        </div>
                        <h3 class="mb-2">WhatsApp</h3>
                        <p><a href="https://wa.me/2609737845" target="_blank" rel="noopener noreferrer">+260 973 7845</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== CONTACT FORM + MAP ===================== --}}
    <section class="ftco-section contact-section ftco-no-pt">
        <div class="container">
            <div class="row block-9">

                {{-- Contact Form --}}
                <div class="col-md-6 order-md-last d-flex ftco-animate">
                    <div class="bg-light p-5 contact-form w-100">

                        {{-- Success Flash Message --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <span class="fa fa-check-circle mr-2"></span>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- General Validation Errors Summary --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea name="message" id="contact_message" cols="30" rows="7" class="form-control @error('message') is-invalid @enderror" placeholder="Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Map --}}
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="w-100">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3847.09307654833!2d28.315255473661622!3d-15.371444712679885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19408b54ff5f1df7%3A0x2e53ebe8c4a4290!2sFoxdale%20Court!5e0!3m2!1sen!2szm!4v1755098319343!5m2!1sen!2szm"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Indigenous Brands Location - Lusaka, Zambia">
                        </iframe>

                        {{-- Address Details Below Map --}}
                        <div class="block-23 mt-4">
                            <ul>
                                <li>
                                    <span class="icon fa fa-map-marker"></span>
                                    <span class="text">Lusaka, Zambia</span>
                                </li>
                                <li>
                                    <a href="tel:+260123456789">
                                        <span class="icon fa fa-phone"></span>
                                        <span class="text">+260 123 456 789</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:info@indigenousbrands.zm">
                                        <span class="icon fa fa-paper-plane"></span>
                                        <span class="text">info@indigenousbrands.zm</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- Social Links --}}
                        <div class="mt-4">
                            <p class="text-muted mb-2">Follow Us</p>
                            <ul class="ftco-footer-social list-unstyled d-flex">
                                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
