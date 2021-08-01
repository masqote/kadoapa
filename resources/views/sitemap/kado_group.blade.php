<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($list_group as $row)
@php
  $group = str_replace(" ", "-", $row->nama_group);
  $group = strtolower($group);
@endphp
<url>
  <loc>{{ url('/inspirasi-kado-'.$group) }}</loc>
  <lastmod>{{ Carbon\Carbon::parse($row->created_at)->toAtomString() }}</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.8</priority>
</url>
@endforeach
</urlset>