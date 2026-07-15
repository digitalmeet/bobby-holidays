<?php

namespace App\Console\Commands;

use App\Models\Destination;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tour;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml in public directory';

    public function handle(): int
    {
        $urls = collect();

        // Static pages
        $urls->push(['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily']);
        $urls->push(['loc' => route('frontend.destinations'), 'priority' => '0.8', 'changefreq' => 'weekly']);
        $urls->push(['loc' => route('frontend.domestic'), 'priority' => '0.8', 'changefreq' => 'weekly']);
        $urls->push(['loc' => route('frontend.international'), 'priority' => '0.8', 'changefreq' => 'weekly']);
        $urls->push(['loc' => route('frontend.blog'), 'priority' => '0.7', 'changefreq' => 'weekly']);
        $urls->push(['loc' => route('frontend.services'), 'priority' => '0.7', 'changefreq' => 'monthly']);
        $urls->push(['loc' => route('frontend.contact'), 'priority' => '0.6', 'changefreq' => 'monthly']);
        $urls->push(['loc' => route('frontend.faq'), 'priority' => '0.5', 'changefreq' => 'monthly']);

        // Destinations
        Destination::active()->get()->each(fn ($d) => $urls->push([
            'loc' => route('frontend.destination.show', $d->slug),
            'lastmod' => $d->updated_at->toW3cString(),
            'priority' => '0.8',
            'changefreq' => 'weekly',
        ]));

        // Tours
        Tour::active()->published()->get()->each(fn ($t) => $urls->push([
            'loc' => route('frontend.tour.show', $t->slug),
            'lastmod' => $t->updated_at->toW3cString(),
            'priority' => '0.9',
            'changefreq' => 'weekly',
        ]));

        // Blog posts
        Post::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('frontend.blog.show', $p->slug),
            'lastmod' => $p->updated_at->toW3cString(),
            'priority' => '0.7',
            'changefreq' => 'monthly',
        ]));

        // Service pages
        Page::service()->published()->get()->each(fn ($s) => $urls->push([
            'loc' => route('frontend.service.show', $s->slug),
            'lastmod' => $s->updated_at->toW3cString(),
            'priority' => '0.6',
            'changefreq' => 'monthly',
        ]));

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . PHP_EOL;
            if (!empty($url['lastmod'])) {
                $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            }
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>' . PHP_EOL;

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generated with ' . $urls->count() . ' URLs.');

        return self::SUCCESS;
    }
}
