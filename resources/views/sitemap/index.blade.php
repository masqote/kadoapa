<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
  <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
      <loc>{{ url('sitemap/kado') }}</loc>
      <lastmod>{{ Carbon\Carbon::parse($kado->created_at)->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
      <loc>{{ url('sitemap/blog') }}</loc>
      <lastmod>{{ Carbon\Carbon::parse($blog->created_at)->toAtomString() }}</lastmod>
    </sitemap>
  </sitemapindex>