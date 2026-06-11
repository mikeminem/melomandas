<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $type = Auth::user()->type ?? '';
            if (!in_array($type, ['admin', 'company'])) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Acceso no autorizado.'], 403);
                }
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rows = Category::select('id', 'name', 'description', 'image')
                ->where('is_deleted', 0)
                ->where('is_active', 1)

                ->get();

            return DataTables::of($rows)
                ->addColumn('action', function ($row) {
                    $routeEdit   = route('categories.show', $row->id);
                    $routeDelete = route('categories.destroy', $row->id);

                    return '<a href="' . $routeEdit . '" class="btn btn-sm btn-outline-primary me-1" title="Editar Registro" id="btnUpdate">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="' . $routeDelete . '" class="btn btn-sm btn-outline-danger" title="Borrar Registro" data-name="' . e($row->name) . '" id="btnDelete">
                                <i class="bi bi-trash"></i> Borrar
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categories.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:120',
        ];

        $attributes = [
            'name' => 'Nombre',
        ];

        $validated = Validator::make($request->all(), $rules, [], $attributes);

        if ($validated->fails()) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Error al intentar guardar la categoría.',
                'errors'  => $validated->errors(),
            ]);
        }

        if (empty($request->id)) {
            $model = new Category($request->all());

            if ($model->save()) {
                return response()->json(['type' => 'success', 'message' => 'Se ha creado la categoría.']);
            }
        } else {
            $model = Category::find($request->id);
            $model->fill($request->all());

            if ($model->update()) {
                return response()->json(['type' => 'success', 'message' => 'Se ha modificado la categoría.']);
            }
        }

        return response()->json(['type' => 'error', 'message' => 'Error al intentar guardar la categoría.']);
    }

    public function show($id)
    {
        if ($id) {
            return Category::select('id', 'name', 'description', 'image')
                ->find($id);
        }

        return response()->json(null, 404);
    }

    public function destroy($id)
    {
        if (isset($id) && $id > 0) {
            Category::where('id', $id)->update(['is_deleted' => 1]);

            return response()->json(['type' => 'success', 'message' => 'La categoría se ha borrado.']);
        }

        return response()->json(['type' => 'error', 'message' => 'Error al intentar borrar la categoría.']);
    }
}
