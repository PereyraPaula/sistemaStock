<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return $category->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'nameCategory' => 'required|string',
        ]);

        $in = $request->input('nameCategory');
        $search = DB::table('categories')->where('nameCategory', $in)->first();
        $rtaSearch = isset($search->nameCategory);

        if ($rtaSearch == true || $v->fails()) {
            return response()->json(['Estado' => 'Error', 'Mensaje' => 'Verifique que el rubro ya exista o que haya intrucido un valor']);
        }else{
            $category = Category::create($request->all());
            return response()->json(['Estado' => 'Satisfactorio', 'Mensaje' => 'Rubro añadido']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response()->json($category,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return response()->json(['Estado' => 'Satisfactorio', 'Mensaje' => 'Rubro eliminado']);
    }
}
