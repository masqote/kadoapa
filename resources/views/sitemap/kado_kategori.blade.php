<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($kategori as $row)
@php
  $kategori = str_replace(" ", "-", $row->nama_kategori);
  $kategori = strtolower($kategori);
@endphp
<url>
  <loc>{{ url('/kado-untuk-'.$kategori) }}</loc>
  <lastmod>{{ Carbon\Carbon::parse($row->created_at)->toAtomString() }}</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.8</priority>
</url>
@endforeach
</urlset>