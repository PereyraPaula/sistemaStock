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
        $maxPage = 5;
        $categories = DB::table('categories')->paginate($maxPage);
        return [
            "pagination"=>[
                'total' => $categories->total(),
                'current_page' => $categories->currentPage(),
                'per_page' => $categories->perPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastPage(),
            ],
            "categories" => $categories
        ];
    }

    public function allNameCategories(){
      return json_encode(DB::table('categories')->select('categories.id','categories.nameCategory')->get());
    }

    public function searchByNameCategory($name){
      $result = DB::table('categories')->select('categories.id')->where('nameCategory', $name)->get();
      if (!$result->count()) {
        return 'No existe '.$name.' como nombre de categoría.';
      }else{
        return $result[0]->id;
      }
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
            'nameCategory' => 'required',
        ]);

        $in = $request->input('nameCategory');

        $search = DB::table('categories')->where('nameCategory', $in)->first();
        $rtaSearch = isset($search->nameCategory);

        if ($rtaSearch == true || $v->fails() || is_numeric($in) ==
        true) {
            return response()->json(['Estado' => 'Error', 'Mensaje' => 'Verifique que el rubro ya exista o que haya introducido un valor']);
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
		// Validar si lo que se está editando ya existe en otro registro
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
