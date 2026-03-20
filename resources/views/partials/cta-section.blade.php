{{--
    Reusable CTA section — "Join Indigenous Brands".
    Place this above @include('partials.footer') on most public pages.

    Optional variables:
      $ctaTitle    (string) — Override the heading text.
      $ctaText     (string) — Override the sub-paragraph text.
      $ctaLabel    (string) — Override the button label. Defaults to 'Register Your Brand'.
      $ctaRoute    (string) — Override the button URL.   Defaults to route('register').
--}}

<section class="ftco-section ftco-no-pb img"
         style="background-image: url({{ asset('images/bg_2.jpg') }});"
         data-stellar-background-ratio="0.5">

    <div class="overlay"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center ftco-animate">

                <h2>{{ $ctaTitle ?? 'Become Part of the Indigenous Brands Community' }}</h2>

                <p>{{ $ctaText ?? 'Join thousands of Zambian entrepreneurs showcasing their brands to the world' }}</p>

                <p>
                    <a href="{{ $ctaRoute ?? route('register') }}"
                       class="btn btn-primary px-4 py-3 mt-3">
                        {{ $ctaLabel ?? 'Register Your Brand' }}
                    </a>
                </p>

            </div>
        </div>
    </div>

</section>
