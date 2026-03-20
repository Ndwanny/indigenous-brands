@extends('layouts.app')

@section('title', 'Get Involved - Indigenous Brands | Join the Zambian Entrepreneurship Movement')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'Get Involved'])

    {{-- ===================== OPPORTUNITIES SECTION ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Ways to Participate</span>
                    <h2 class="mb-4">How to Get Involved</h2>
                    <p class="w-md-75 mx-auto">Join the Indigenous Brands movement and help celebrate Zambian entrepreneurship. There are many ways you can contribute and benefit from our growing community.</p>
                </div>
            </div>
            <div class="row">

                {{-- Featured Brand Card --}}
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#brand-form" class="img" style="background-image: url('https://i.ibb.co/mCBC0x28/1-18.jpg');">
                            <span class="price">Featured Brand</span>
                        </a>
                        <div class="text p-4">
                            <h3><a href="#brand-form">Become a Featured Brand</a></h3>
                            <p class="location"><span class="fa fa-map-marker"></span> Lusaka, Zambia</p>
                            <p>Join our platform to showcase your unique Zambian brand to a wider audience. Gain exposure through our events, website, and marketing campaigns.</p>
                            <ul>
                                <li><span class="flaticon-shower"></span>Brand Exposure</li>
                                <li><span class="flaticon-king-size"></span>Networking Opportunities</li>
                                <li><span class="flaticon-mountains"></span>Marketing Support</li>
                            </ul>
                            <p><a href="{{ route('contact') }}" class="btn btn-primary px-4 py-2">Apply Now</a></p>
                        </div>
                    </div>
                </div>

                {{-- Partnership/Sponsorship Card --}}
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="{{ route('contact') }}" class="img" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
                            <span class="price">Partnership / Sponsorship</span>
                        </a>
                        <div class="text p-4">
                            <h3><a href="{{ route('contact') }}">Partnership / Sponsorship Inquiries</a></h3>
                            <p class="location"><span class="fa fa-map-marker"></span> Lusaka, Zambia</p>
                            <p>Collaborate with Indigenous Brands to support Zambian entrepreneurs. Sponsor our events or partner with us to promote creativity and innovation.</p>
                            <ul>
                                <li><span class="flaticon-shower"></span>Event Sponsorship</li>
                                <li><span class="flaticon-king-size"></span>Brand Collaboration</li>
                                <li><span class="flaticon-sun-umbrella"></span>Community Impact</li>
                            </ul>
                            <p><a href="{{ route('contact') }}" class="btn btn-primary px-4 py-2">Inquire Now</a></p>
                        </div>
                    </div>
                </div>

                {{-- Volunteer/Ambassador Card --}}
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#volunteer-form" class="img" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg');">
                            <span class="price">Volunteer / Ambassador</span>
                        </a>
                        <div class="text p-4">
                            <h3><a href="#volunteer-form">Volunteer or Ambassador Sign-Up</a></h3>
                            <p class="location"><span class="fa fa-map-marker"></span> Lusaka, Zambia</p>
                            <p>Be part of our movement by volunteering at events or becoming an ambassador to promote Indigenous Brands in your community.</p>
                            <ul>
                                <li><span class="flaticon-shower"></span>Event Support</li>
                                <li><span class="flaticon-king-size"></span>Community Engagement</li>
                                <li><span class="flaticon-sun-umbrella"></span>Brand Advocacy</li>
                            </ul>
                            <p><a href="#volunteer-form" class="btn btn-primary px-4 py-2">Sign Up</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== VOLUNTEER / AMBASSADOR FORM SECTION ===================== --}}
    <section class="ftco-section ftco-no-pt" id="volunteer-form">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Take Action</span>
                    <h2 class="mb-4">Volunteer &amp; Ambassador Sign-Up</h2>
                </div>
            </div>
            <div class="row block-9">

                {{-- Form --}}
                <div class="col-md-6 order-md-last d-flex ftco-animate">
                    <div class="bg-light p-5 contact-form w-100">

                        {{-- Success Flash --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <span class="fa fa-check-circle mr-2"></span>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Validation Errors Summary --}}
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

                        <h3 class="mb-4">Volunteer / Ambassador Application Form</h3>

                        <form action="{{ route('get-involved.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="applicant_name">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="applicant_name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Full Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="applicant_email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="applicant_email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="applicant_phone">Phone Number</label>
                                <input type="text" name="phone" id="applicant_phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Your Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="applicant_role">Select Role <span class="text-danger">*</span></label>
                                <select name="role" id="applicant_role" class="form-control @error('role') is-invalid @enderror" required>
                                    <option value="">Select Role</option>
                                    <option value="volunteer" {{ old('role') == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                    <option value="ambassador" {{ old('role') == 'ambassador' ? 'selected' : '' }}>Ambassador</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="applicant_message">Why do you want to join Indigenous Brands? <span class="text-danger">*</span></label>
                                <textarea name="message" id="applicant_message" cols="30" rows="7" class="form-control @error('message') is-invalid @enderror" placeholder="Tell us about yourself and why you want to get involved..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Submit Application" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sidebar Image / Info --}}
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="w-100">
                        <div class="img w-100 mb-4" style="background-image: url('https://i.ibb.co/5f6Zzpz/1-2.jpg'); min-height: 300px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        <div class="p-4 bg-light">
                            <h4 class="mb-3">Why Get Involved?</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Connect with Zambia's leading entrepreneurs</li>
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Gain valuable experience at events</li>
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Help build a stronger entrepreneurship ecosystem</li>
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Represent Indigenous Brands in your community</li>
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Access to exclusive IB events and workshops</li>
                                <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"></span>Be part of a movement celebrating Zambian pride</li>
                            </ul>
                            <div class="block-23 mt-4">
                                <ul>
                                    <li><span class="icon fa fa-map-marker"></span><span class="text">Lusaka, Zambia</span></li>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
