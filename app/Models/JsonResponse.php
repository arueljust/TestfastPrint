<?php

namespace App\Models;

use App\Http\Controllers\JsonResController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonResponse extends Model
{
    use HasFactory;
    private $resJson;
    private $product;
    private $status;
    private $satuan;

    public function __construct(JsonResController $resJson, Product $product, Status $status, Satuan $satuan)
    {
        $this->resJson = $resJson;
        $this->product = $product;
        $this->status = $status;
        $this->satuan = $satuan;
    }

    public function saveSatuan()
    {
        $data = $this->resJson->getResponseApi();
        $jsonstring = json_decode($data, true);
        $array = $jsonstring['data'];
        foreach ($array as $item) {
            $satuan = $this->satuan->firstOrCreate(['name' => $item['kategori']]); // mencari data yang sama ya
            $satuan->name = $item['kategori'];
            $satuan->save();
        }
    }

    public function saveStatus()
    {
        $data = $this->resJson->getResponseApi();
        $jsonstring = json_decode($data, true);
        $array = $jsonstring['data'];
        foreach ($array as $item) {
            $satuan = $this->status->firstOrCreate(['name' => $item['status']]); // mencari data yang sama ya
            $satuan->name = $item['status'];
            $satuan->save();
        }
    }

    public function saveData()
    {
        $data = $this->resJson->getResponseApi();
        $jsonstring = json_decode($data, true);
        $array = $jsonstring['data'];
        foreach ($array as $item) {
            $product = new $this->product;
            $product->product_id = $item['id_produk'];
            $product->product_name = $item['nama_produk'];
            $product->price = $item['harga'];
            $category = $this->satuan->where('name', $item['kategori'])->first(); // mencari filed yang sama
            if ($category) {
                $product->category_id = $category->id; //jika ada maka simpan id dari category ke product filed category_id
            }
            $status = $this->status->where('name', $item['status'])->first(); // mencari filed yang sama
            if ($status) {
                $product->status_id = $status->id; //jika ada maka simpan id dari status ke product filed status_id
            }
            $product->save();
        }
    }
}
