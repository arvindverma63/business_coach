<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Blog;
use App\Models\CoachProfile;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the XML sitemap for SEO';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // 1. Static Pages
        $sitemap->add(Url::create(route('webapp.home'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
                ->add(Url::create(route('webapp.about-us'))->setPriority(0.8))
                ->add(Url::create(route('webapp.contact'))->setPriority(0.8))
                ->add(Url::create(route('webapp.rank'))->setPriority(0.9))
                ->add(Url::create(route('webapp.find-coach'))->setPriority(0.9));

        // 2. Dynamic Blogs
        Blog::where('is_published', 1)->get()->each(function ($blog) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog-detail', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setPriority(0.7)
            );
        });

        // 3. Dynamic Coach Profiles
        CoachProfile::where('approval_status', 'approved')->get()->each(function ($coach) use ($sitemap) {
            $sitemap->add(
                Url::create(route('view-profile', $coach->id))
                    ->setLastModificationDate($coach->updated_at)
                    ->setPriority(0.6)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
