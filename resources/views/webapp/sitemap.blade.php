{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- 1. Main Static Pages --}}
    <url>
        <loc>{{ route('webapp.home') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('webapp.about-us') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('webapp.contact') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('webapp.rank') }}</loc>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('webapp.find-coach') }}</loc>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('webapp.searchCoaches') }}</loc>
        <priority>0.8</priority>
    </url>

    {{-- 2. Legal Pages --}}
    <url>
        <loc>{{ route('privacy-policy') }}</loc>
        <priority>0.3</priority>
    </url>

    <url>
        <loc>{{ route('terms-and-conditions') }}</loc>
        <priority>0.3</priority>
    </url>

    {{-- 3. Dynamic Blogs Index and Single Posts --}}
    <url>
        <loc>{{ route('webapp.blogs') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    @foreach ($blogs as $blog)
        <url>
            <loc>{{ route('blog-detail', $blog->slug) }}</loc>
            <lastmod>{{ $blog->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach


</urlset>
