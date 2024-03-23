<?php

namespace Fpaipl\Panel\Http\Controllers;

use Fpaipl\Prody\Actions\LoadTaxes;
use Fpaipl\Prody\Actions\LoadUnits;
use App\Http\Controllers\Controller;
use Fpaipl\Prody\Actions\LoadBrands;
use Fpaipl\Prody\Actions\LoadMaterials;
use Fpaipl\Prody\Actions\LoadCategories;
use Fpaipl\Prody\Actions\LoadCollections;

class SyncController extends Controller
{
    public function index ()
    {
        $data = [];
        $data[] = $this->loadUnits();
        $data[] = $this->loadMaterials();
        $data[] = $this->loadTaxes();
        $data[] = $this->loadBrands();
        $data[] = $this->loadCategories();
        $data[] = $this->loadCollections();
        return view('panel::pages.sync-report', compact('data'));
    }

    private function loadUnits()
    {
        $count = LoadUnits::execute(true);
        return $count > 0 ? $count . ' units synced' : 'No new units found';
    }

    private function loadMaterials()
    {
        $count = LoadMaterials::execute(config('monaal.url'), config('monaal.supplier_id'), true);
        return $count > 0 ? $count . ' materials synced' : 'No new materials found';
    }

    private function loadTaxes()
    {
        $count = LoadTaxes::execute(true);
        return $count > 0 ? $count . ' taxes synced' : 'No new taxes found';
    }

    private function loadBrands()
    {
        $count = LoadBrands::execute(true);
        return $count > 0 ? $count . ' brands synced' : 'No new brands found';
    }

    private function loadCategories()
    {
        $count = LoadCategories::execute(true);
        return $count > 0 ? $count . ' categories synced' : 'No new categories found';
    }

    private function loadCollections()
    {
        $count = LoadCollections::execute(true);
        return $count > 0 ? $count . ' collections synced' : 'No new collections found';
    }
}
