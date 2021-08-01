<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ url('/') }}</loc>
    <lastmod>{{ Carbon\Carbon::parse($last_kado->created_at)->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  @foreach ($kado as $row)
  @php
    $group = str_replace(" ", "-", $row->nama_group);
    $group = strtolower($group);
  @endphp
    <url>
      <loc>{{ url('/rekomendasi-kado-'.$group.'/'.$row->id.'/'.$row->slug) }}</loc>
      <lastmod>{{ Carbon\Carbon::parse($row->created_at)->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
  @endforeach
</urlset>