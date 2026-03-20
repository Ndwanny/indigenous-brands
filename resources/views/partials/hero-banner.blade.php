{{--
    Reusable inner-page hero banner.

    Required variables:
      $title       (string)  — Page title shown as <h1> and in the breadcrumb trail.

    Optional variables:
      $bgImage     (string)  — Path to background image (relative to asset()). Defaults to 'images/bg_1.jpg'.
      $parent      (string)  — Label for a parent breadcrumb link (e.g. "Blog").
      $parentUrl   (string)  — URL for the parent breadcrumb link (e.g. route('blog.index')).

    Usage example:
      @include('partials.hero-banner', [
          'title'     => 'Brand Profile',
          'parent'    => 'Brands',
          'parentUrl' => route('brands.index'),
      ])
--}}

<div class="hero-wrap hero-wrap-2"
     style="background-image: url({{ asset($bgImage ?? 'images/bg_1.jpg') }});">

    <div class="overlay"></div>

    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">

                {{-- Breadcrumb trail --}}
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('home') }}">Home <i class="fa fa-chevron-right small"></i></a>
                    </span>

                    @if(isset($parent))
                        <span class="mr-2">
                            <a href="{{ $parentUrl ?? '#' }}">{{ $parent }} <i class="fa fa-chevron-right small"></i></a>
                        </span>
                    @endif

                    <span>{{ $title }}</span>
                </p>

                {{-- Page title --}}
                <h1 class="mb-0 bread">{{ $title }}</h1>

            </div>
        </div>
    </div>

</div>
