<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ url('/blog')}}</loc>
    <lastmod>{{ Carbon\Carbon::parse($lastBlog->created_at)->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>
  @foreach ($blog as $row)
    <url>
      <loc>{{ url('/blog'.'/'.$row->id.'/'.$row->slug) }}</loc>
      <lastmod>{{ Carbon\Carbon::parse($row->created_at)->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
  @endforeach
</urlset>