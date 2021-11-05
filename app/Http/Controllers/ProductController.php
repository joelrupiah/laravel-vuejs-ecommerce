<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index($number = 10)
    {
        $products = Product::latest()->with('category')->paginate($number);

        return response()->json([
            'products' => $products
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->productValidation($request);
        $request['flavor'] = explode(',',$request->flavor);
        $request['occassion'] = explode(',',$request->occassion);
        $file = '';
        $upload_path = public_path('uploads');

        if ($request->hasFile('imageOne')) {
            $file = $request->file('imageOne');
            $nameOne = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameOne);
            // $product->imageOne = $name;
            // dd($name);
        }
        if ($request->hasFile('imageTwo')) {
            $file = $request->file('imageTwo');
            $nameTwo = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameTwo);
        }
        if ($request->hasFile('imageThree')) {
            $file = $request->file('imageThree');
            $nameThree = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameThree);
        }
        $product = new Product();
        $product->create(array_merge($request->all(), [
            'imageOne' => $nameOne,
            'imageTwo' => $nameTwo,
            'imageThree' => $nameThree,
        ]));
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return response()->json([
            'product' => $product
        ], 200);
    }

    public function update(Request $request, Product $product)
    {
        dd($request->all());
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->index();
    }

    public function multipleDelete(Request $request)
    {
        // dd($request);
        foreach($request->all() as $product)
        {
            // dd($product['id']);
            Product::find($product['id'])->delete();
        }
    }

    public function productValidation($request, $id=null)
    {
        if ($id) {
            $image = '';
        }else{
            $image = 'required|mimes:jpg,jpeg,png,jfif,gif,svg|max:5000';
        }
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'description' => 'required',
                'imageOne' => $image,
                'imageTwo' => $image,
                'imageThree' => $image,
                'quantity' => 'required|integer',
            ],
            [
                'category_id.required' => 'The category field is required'
            ]
        );
    }

    public function updateProduct(Request $request, $id)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
        $this->productValidation($request, $id);
        $this->productValidation($request);
        $request['flavor'] = explode(',',$request->flavor);
        $request['occassion'] = explode(',',$request->occassion);
        $file = '';
        $upload_path = public_path('uploads');
        if ($request->hasFile('imageOne')) {
            $file = $request->file('imageOne');
            $nameOne = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameOne);
            $imageOne = public_path("uploads/$product->imageOne");
            if (file_exists($imageOne)) {
                unlink($imageOne);
            }
            // dd($name);
        }
        if ($request->hasFile('imageTwo')) {
            $file = $request->file('imageTwo');
            $nameTwo = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameTwo);
            $imageTwo = public_path("uploads/$product->imageTwo");
            if (file_exists($imageTwo)) {
                unlink($imageTwo);
            }
        }
        if ($request->hasFile('imageThree')) {
            $file = $request->file('imageThree');
            $nameThree = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $nameThree);
            $imageThree = public_path("uploads/$product->imageThree");
            if (file_exists($imageThree)) {
                unlink($imageThree);
            }
        }
        else{
            $nameOne = $product->imageOne;
            $nameTwo = $product->imageTwo;
            $nameThree = $product->imageThree;
        }
        // dd($file);

        $product->update(array_merge($request->all(), [
            'imageOne' => $nameOne,
            'imageTwo' => $nameTwo,
            'imageThree' => $nameThree
        ]));
    }

    public function getAllProduct()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        return $this->index(10);
    }

    public function sidebarInfo()
    {
        // dd('sidebar');
        // return response()->json('sidebar');
        $categories = Category::all();
        $min_price = Product::min('price');
        $max_price = Product::max('price');

        return response()->json([
            'categories' => $categories,
            'price' => [
                'min' => $min_price,
                'max' => $max_price
            ]
        ]);
    }

    public function maincategoryInfo()
    {
        // dd('category');
        // return response()->json('category');
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function productFilter($data)
    {
        // dd($data);
        $data = json_decode($data);
        // dd($data);
        $field = $data->field;
        $data = $data->data;
        // dd($field);
        if ($field==='price') {
            $products = $this->priceRangeFilter($data);
        }else if ($field==='flavor' || $field==='occassion') {
            $products = $this->flavororOccassionFilter($data, $field);
        }else if ($field==='category_id'){
            $products = Product::where($field, $data)->paginate(15);
        }else{
            $products = $this->index(15);
        }
        return response()->json([
            'products' => $products
        ]);
    }

    public function priceRangeFilter($data)
    {
        $min = $data['0'];
        $max = $data['1'];
        $products = Product::whereBetween('price',[$min, $max])->paginate(15);

        return $products;
    }

    public function flavororOccassionFilter($data, $field)
    {
        // dd($data);
        // $keyword = $data->value;
        $products = Product::query()->where($field, 'like', "%{$data}%")->paginate(15);
        return $products;
    }
}
