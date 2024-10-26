<?php

namespace App\Providers;

use App\Models\Products\ProductsCategory;
use App\Models\websiteInformation as WebsiteInformationModel;
use Illuminate\Support\ServiceProvider;

class WebsiteInformationService extends ServiceProvider
{

    protected $infoArray = [];
    protected $keywordsArray = [];

    protected $categoriesArray = [];

    public function __construct()
    {
        $this->loadData();
    }

    protected function loadData()
    {

        $websiteInformation = WebsiteInformationModel::select('data')->get();

        $categories = ProductsCategory::with(['subCategories' => function ($query) {
            $query->where('status', 1)
                ->where('visibility', 1)
                ->where('menu_placement', 1);
        }])->whereNull('parent_id')->where('status', 1)->where('menu_placement', 1)
            ->where('visibility', 1)
            ->get();


        if ($websiteInformation->isEmpty()) {
            return;
        }

        $infoArray = [];
        foreach ($websiteInformation as $info) {
            $decodedData = json_decode($info['data'], true);
            $infoArray = array_merge($infoArray, $decodedData);
        }

        $keywordsArray = [];
        if (isset($infoArray['keywords'])) {
            $decodedKeywords = json_decode($infoArray['keywords'], true);
            if (is_array($decodedKeywords)) {
                foreach ($decodedKeywords as $keyword) {
                    if (isset($keyword['value'])) {
                        $keywordsArray[] = $keyword['value'];
                    }
                }
            }
        }


        $this->infoArray = $infoArray;
        $this->keywordsArray = $keywordsArray;
        $this->categoriesArray = $categories;
    }

    public function getInfoArray()
    {
        return $this->infoArray;
    }

    public function getKeywordsArray()
    {
        return $this->keywordsArray;
    }


    public function getCategoriesArray()
    {
        return $this->categoriesArray;
    }


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
