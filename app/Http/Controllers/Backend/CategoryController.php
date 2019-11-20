<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
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
        $categories = Category::get();
        return view('backend.categories.index', compact('categories'));
    }

    public function getData()
    {
        $categories = Category::select(['id', 'name', 'slug', 'user_id', 'created_at']);
        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function ($category) {
                return '<a href="javascript:;" class="btn btn-warning edit" data-id="' . $category->id . '" title="Sửa danh mục" data-toggle="modal" data-target="#editModal"><i style="color: white" class="far fa-edit"></i></a>&nbsp;<a id="deleteCategory" href="javascript:;" data-id="' . $category->id . '" class="btn btn-danger" data-id="' . $category->id . '" data-token="' . csrf_token() . '" title="Xóa danh mục"><i class="far fa-trash-alt"></i></a>';
            })
            ->editColumn('user_id', function ($category) {
                return $category->user->name;
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
    public function store(StoreCategoryRequest $request)
    {
        if ($request->parent_id == '') {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => 0,
                'user_id' => Auth::user()->id
            ]);
        } else {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'user_id' => Auth::user()->id
            ]);
        }
        $categories = Category::get();
        Cache::forget('categories');
        Cache::put('categories', $categories, 60*60);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
//       return response()->json(['category'=>$category]);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        Category::find($id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id
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
        $category = Category::where('id', $id);
        $category->delete($category);
    }
}
