<?php

namespace App\Http\Controllers;

use App\Models\JsonResponse;
use App\Models\Product;
use App\Models\Satuan;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $jsonResponse;
    private $model;
    private $status;
    private $satuan;

    public function __construct(JsonResponse $jsonResponse, Product $model, Status $status, Satuan $satuan)
    {
        $this->jsonResponse = $jsonResponse;
        $this->model = $model;
        $this->status = $status;
        $this->satuan = $satuan;
    }

    public function saveSatuan()
    {
        $data = $this->jsonResponse->saveSatuan();
        return response()->json(['msg' => 'ok']);
    }

    public function saveStatus()
    {
        $data = $this->jsonResponse->saveStatus();
        return response()->json(['msg' => 'ok']);
    }

    public function saveData()
    {
        $data = $this->jsonResponse->saveData();
        return response()->json(['msg' => 'ok']);
    }

    public function getAllData()
    {
        $data = $this->model
            ->join('m_satuan as ma', 'm_product.category_id', '=', 'ma.id')
            ->join('m_status as ms', 'm_product.status_id', '=', 'ms.id')
            ->select('m_product.product_id', 'm_product.product_name', 'm_product.price', 'ma.name as kategori', 'ms.name as status')
            ->get();
        return view('welcome', compact('data'));
    }

    public function getInStock()
    {
        $data = $this->model
            ->join('m_satuan as ma', 'm_product.category_id', '=', 'ma.id')
            ->join('m_status as ms', 'm_product.status_id', '=', 'ms.id')
            ->select('m_product.product_id', 'm_product.product_name', 'm_product.price', 'ma.name as kategori', 'ms.name as status')
            ->where('ms.id', '=', '1')
            ->get();
        return view('product_in_stock', compact('data'));
    }

    public function createProduct()
    {
        $statusData = $this->status->get();
        $satuanData = $this->satuan->get();
        return view('product.create-product', compact('statusData', 'satuanData'));
    }

    public function productStore(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);
        $data = new $this->model;
        $data->product_name = $validatedData['product_name'];
        $data->price = $validatedData['price'];
        $data->category_id = $validatedData['category_id'];
        $data->status_id = $validatedData['status_id'];
        $data->save();

        return redirect('/')->with('success', 'Data product berhasil disimpan');
    }

    public function editProduct($id)
    {
        $productData = $this->model->where('product_id', $id)->first();
        $statusData = $this->status->get();
        $satuanData = $this->satuan->get();
        return view('product.edit-product', compact('productData', 'statusData', 'satuanData'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);
        $data = $this->model->where('product_id', $id);
        $data->product_name = $validatedData['product_name'];
        $data->price = $validatedData['price'];
        $data->category_id = $validatedData['category_id'];
        $data->status_id = $validatedData['status_id'];
        $data->update($validatedData);

        return redirect('/')->with('success', 'Data product berhasil diupdate');
    }

    public function deleteData($id)
    {
        $data = $this->model->where('product_id', $id);
        $data->delete();

        return redirect('/')->with('success', 'Data product berhasil dihapus');
    }
}
