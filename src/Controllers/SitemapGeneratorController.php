<?php 
namespace Megaads\Generatesitemap\Controllers;

use Megaads\Generatesitemap\Models\Stores;
use Megaads\Generatesitemap\Models\Categories;
use Illuminate\Routing\Controller as BaseController;

class SitemapGeneratorController extends BaseController
{
    protected $storeRouteName = 'frontend::store::listByStore';
    protected $categoryRouteName = 'frontend::category::listByCategory';
    protected $publicPath = null;
    private $sitemapConfigurator;

    /***
     * SitemapGeneratorController constructor.
     */
    public function __construct()
    {
        $this->publicPath = base_path() . '/public';
        $this->sitemapConfigurator = app()->make('sitemapConfigurator');
    }

    /***
     * Generate sitemap from table
     * @return null
     */
    public function generate() {

        $stores = Stores::get(['slug']);
        foreach ($stores as $store) {
            $piority = '0.8';
            $lastMode = date('Y-m-d');
            $changefreq = 'daily';
            $this->sitemapConfigurator->add(route($this->storeRouteName, ['slug' => $store->slug]), $piority, $lastMode, $changefreq);
        }
        $categories = Categories::get(['slug']);
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $piority = '0.8';
                $lastMode = date('Y-m-d');
                $changefreq = 'daily';
                $this->sitemapConfigurator->add(route($this->storeRcategoryRouteNameouteName, ['slug' => $category->slug]), $piority, $lastMode, $changefreq);
            }
        }
        $this->sitemapConfigurator->store('xml', 'sitemap');
    }
}