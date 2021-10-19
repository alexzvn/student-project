<?php

namespace App\Controllers\Manager;

use App\Models\Product;
use Core\Http\FileUpload;
use Core\Http\Request;
use Core\Http\Response;
use Core\Support\Collection;

class ProductController
{
    public function index()
    {
        return view('manager.product.index', [
            'products' => new Collection(Product::all())
        ]);
    }

    public function create()
    {
        return view('manager.product.create');
    }

    public function store(Request $request, Response $response)
    {
        if ($error = $this->validate($request) ?? $this->validateAvatar($request)) {
            session()->flash('alert:error', $error);

            return $response->redirect($request->referer());
        }

        $product = new Product;

        $product->fill($request->all())->forceFill([
            'avatar' =>$this->publishAvatar($request->file('avatar'))
        ])->save();

        return $response->redirect('/manager/products');
    }

    public function show($id)
    {
        if (!$product = Product::find((int) $id)) {
            return;
        }

        return view('manager.product.view', [
            'product' => $product
        ]);
    }

    public function update($id, Request $request, Response $response)
    {
        if (!$product = Product::find((int) $id)) {
            return;
        }

        $error = $this->validate($request);

        if ($request->file('avatar')) {
            $this->validateAvatar($request);
        }

        if ($error) {
            session()->flash('alert:error', $error);
            return $response->redirect($request->referer());
        }

        $product->fill($request->all());

        if ($avatar = $request->file('avatar')) {
            $product->forceFill(['avatar' => $this->publishAvatar($avatar)]);
        }

        $product->save();

        session()->flash('alert:success', 'Saved change for current product.');
        return $response->redirect($request->referer());
    }

    public function delete($id, Response $response)
    {
        if ($product = Product::find($id)) {
            $product->delete();
            session()->flash('alert:success', "Deleted product $product->name");
        }

        return $response->redirect('/manager/products');
    }

    public function publishAvatar(FileUpload $upload)
    {
        $file = uniqid('image-') . '.' . $upload->ext();

        $upload->moveToNewFile($file, public_path('media'));

        return "/media/$file";
    }

    public function validate(Request $request)
    {
        if (strlen($request->name) < 2) {
            return 'Name too short';
        }

        if (! preg_match('/[+-]?([0-9]*[.])?[0-9]+/', $request->price)) {
            return 'Price is invalid';
        }

        return null;
    }

    public function validateAvatar(Request $request)
    {
        if (!$avatar = $request->file('avatar')) {
            return 'Avatar product is required';
        }

        if (! in_array($avatar->ext(), ['jpg', 'png', 'webp', 'bmp'])) {
            return 'Not allowed image';
        }

        return null;
    }
}
