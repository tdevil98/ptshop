<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Auth;
use DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('backend.products.index', compact('categories', 'products'));
    }

    public function getData()
    {
        $products = Product::select(['id', 'name', 'origin_price', 'sale_price', 'category_id', 'status', 'created_at']);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a href="javascript:;" class="btn btn-warning edit" data-id="' . $product->id . '" title="Sửa sản phẩm" data-toggle="modal" data-target="#editModal"><i style="color: white" class="far fa-edit"></i></a>&nbsp;<a id="deleteProduct" href="javascript:;" data-id="' . $product->id . '" class="btn btn-danger" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Xóa sản phẩm"><i class="far fa-trash-alt"></i></a>';
            })
            ->editColumn('origin_price',function ($product){
                return number_format($product->origin_price) . " đồng";
            })
            ->editColumn('sale_price',function ($product){
                return number_format($product->sale_price) . " đồng";
            })
            ->editColumn('category_id', function ($product) {
                return $product->category->name;
            })
            ->editColumn('status', function ($product) {
                if ($product->status) {
                    return "Đang bán";
                } elseif ($product->status == 0) {
                    return "Bị ẩn";
                } else {
                    return "Hết hàng";
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getDeleted()
    {
        $products = Product::withTrashed()->select(['id', 'name', 'origin_price', 'sale_price', 'category_id', 'status', 'deleted_at']);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a href="javascript:;" class="btn btn-warning edit" data-id="' . $product->id . '" title="Sửa sản phẩm" data-toggle="modal" data-target="#editModal"><i style="color: white" class="far fa-edit"></i></a>&nbsp;<a id="deleteProduct" href="javascript:;" data-id="' . $product->id . '" class="btn btn-danger" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Xóa sản phẩm"><i class="far fa-trash-alt"></i></a>';
            })
            ->editColumn('origin_price',function ($product){
                return number_format($product->origin_price) . " đồng";
            })
            ->editColumn('sale_price',function ($product){
                return number_format($product->sale_price) . " đồng";
            })
            ->editColumn('category_id', function ($product) {
                return $product->category->name;
            })
            ->editColumn('status', function ($product) {
                if ($product->status) {
                    return "Đang bán";
                } elseif ($product->status == 0) {
                    return "Bị ẩn";
                } else {
                    return "Hết hàng";
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function listDeleted()
    {
        return view('backend.products.trashbin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $products = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'origin_price' => $request->origin_price,
            'sale_price' => $request->sale_price,
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);
        ProductImage::create([
            'product_id' => $products->id,
            'image' => $request->image
        ]);

        return redirect()->route('backend.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if($request()->ajax()){
//            $product = Product::findOrFail($id);
//            return response()->json(['product' => $product]);
//        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        Product::find($id)->update([
            'name' => $request->get('name'),
            'slug' => \Illuminate\Support\Str::slug($request->get('name')),
            'category_id' => $request->get('category_id'),
            'origin_price' => $request->get('origin_price'),
            'sale_price' => $request->get('sale_price'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'user_id' => Auth::user()->id,
        ]);
        return response()->json(['mess' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id);
        $product->delete($product);
    }
    public function softDelete($id)
    {
        $product = Product::where('id', $id);
        $product->delete($product);
    }
}
