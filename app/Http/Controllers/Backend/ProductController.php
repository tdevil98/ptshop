<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductQuantity;
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
    public function listDeleted()
    {
        return view('backend.products.trashbin');
    }
    public function productQuantity($id){
        $parent_id = $id;
        return view('backend.products.productquantity', compact('parent_id'));
    }
    public function getData()
    {
        $products = Product::select(['id', 'name', 'category_id', 'user_id', 'status', 'created_at']);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a href="javascript:;" id="edit" class="btn btn-warning" title="Sửa sản phẩm" data-toggle="modal" data-target="#editModal"  data-id="' . $product->id . '"><i style="color: white" class="far fa-edit"></i></a>&nbsp;
                        <a id="deleteProduct" href="javascript:;" class="btn btn-danger" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Xóa sản phẩm"><i class="far fa-trash-alt"></i></a>
                        &nbsp;
                        <a id="subProduct" href="'. route('backend.products.quantity', $product->id). '" data-id="' . $product->id . '" class="btn btn-success" title="Quản lý số lượng hàng" ><i class="fas fa-sign-in-alt"></i></a>';
            })
            ->editColumn('category_id', function ($product) {
                return $product->category->name;
            })
            ->editColumn('user_id', function ($product) {
                return $product->user->name;
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
        $products = Product::onlyTrashed()->select(['id', 'name', 'origin_price', 'sale_price', 'category_id', 'status', 'deleted_at']);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a id="restore" href="javascript:;" data-id="' . $product->id . '" class="btn btn-success" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Khôi phục sản phẩm"><i class="fas fa-trash-restore-alt"></i></a>
                        <a id="destroy" href="javascript:;" data-id="' . $product->id . '" class="btn btn-danger" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Xóa vĩnh viễn sản phẩm"><i class="far fa-trash-alt"></i></a>';
            })
            ->editColumn('origin_price', function ($product) {
                return number_format($product->origin_price) . " đồng";
            })
            ->editColumn('sale_price', function ($product) {
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

    public function getProductQuantity($id){
        $products = ProductQuantity::where('product_id', $id)->select(['id', 'product_id', 'size', 'quantity', 'created_at']);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($product) {
                return '<a href="javascript:;" id="edit" class="btn btn-warning" title="Sửa sản phẩm" data-toggle="modal" data-target="#editModal"  data-id="' . $product->id . '"><i style="color: white" class="far fa-edit"></i></a>&nbsp;
                        <a id="deleteProduct" href="javascript:;" class="btn btn-danger" data-id="' . $product->id . '" data-token="' . csrf_token() . '" title="Xóa sản phẩm"><i class="far fa-trash-alt"></i></a>
                        &nbsp;
                        <a id="subProduct" href="'. route('backend.products.quantity', $product->id). '" data-id="' . $product->id . '" class="btn btn-success" title="Quản lý số lượng hàng" ><i class="fas fa-sign-in-alt"></i></a>';
            })
            ->editColumn('product_id', function ($product) {
                return $product->product->name;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
            'origin_price' => $request->origin_price,
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);
        $images = $request->file('images');
        foreach ($images as $image) {
            $file_name = $image->getClientOriginalName();
            $path = $image->storeAs("images/products/$product->id", Carbon::now()->format('YmdHs') . $file_name, 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path
            ]);
        }
        return redirect()->route('backend.products.index');
    }
    public function storeQuantity(StoreSubProductRequest $request)
    {
        $product = Product::create([
            'parent_id' => $request->parent_id,
            'color' => $request->color,
            'size' => $request->size,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);
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
        $product = Product::find($id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
            'origin_price' => $request->origin_price,
            'content' => $request->content,
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
        Product::where('id', $id)->forceDelete();
    }

    public function softDelete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->user_id = Auth::user()->id;
        $product->save();
        $product->delete($product);
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
    }
}
