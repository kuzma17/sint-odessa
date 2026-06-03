<title>{{ $page->seo_title ?? $page->title ?? settings('seo_title') ?? settings('title') }}</title>
<meta name="description" content="{{ $page->seo_description ?? settings('seo_description') ?? settings('description') }}">
<meta name="keywords" content="{{ $page->seo_keywords ?? settings('seo_keywords') }}">
<meta property="og:title" content="{{ $page->og_title ?? $page->seo_title ?? settings('og_title') ?? settings('seo_title') }}">
<meta property="og:description" content="{{ $page->og_description ?? $page->seo_description ?? settings('og_description') ?? settings('seo_description') }}">
<meta property="og:image" content="{{ $page->og_image ?? settings('image_og') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<link rel="canonical" href="{{ url()->current() }}">
<script type="application/ld+json">
        {
        "@@context": "https://schema.org",
        "@@type": "LocalBusiness",
        "name": "{{ settings('title') }}",
        "url": "{{ url('/') }}",
        "logo": "{{ settings('image_logo') }}",
        "telephone": "+{{ settings('phone') }}",
        "address": {
                "@@type": "PostalAddress",
                "addressLocality": "{{ settings('city') }}",
                "streetAddress": "{{ settings('address') }}",
                "addressCountry": "UA"
                }
        }
</script>