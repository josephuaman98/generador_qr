<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use PDOException;

class UsuarioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only' => ['index']]);
        $this->middleware('permission:crear-usuario', ['only' => ['create','store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        // Recibe parámetros de búsqueda, paginación y ordenación desde la solicitud
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);
        $sort = $request->input('sort', 'users.id'); // Orden por defecto con prefijo correcto
        $direction = $request->input('direction', 'asc'); // Dirección por defecto
        
        $userId = auth()->id();
    
        // Consulta base
        $query = "
            SELECT 
                users.id AS id,
                users.name as nombre,
                users.apellido_paterno as apellido_paterno, 
                users.apellido_materno as apellido_materno,
                users.dni as dni, 
                users.user_name AS users_usuario,
                roles.name AS role_nombre
            FROM users
            INNER JOIN model_has_roles ON users.id = model_has_roles.model_id
            INNER JOIN roles ON roles.id = model_has_roles.role_id"; 
    
        $params = [];
    
        // Añadir filtros de búsqueda
        if ($search) {
            $query .= " WHERE (users.name LIKE ? OR users.apellido_paterno LIKE ? OR users.apellido_materno LIKE ? OR users.dni LIKE ? OR users.user_name LIKE ? OR roles.name LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
    
        // Añadir ordenación
        $query .= " ORDER BY $sort $direction"; // Agrega la ordenación a la consulta
    
        // Ejecutar la consulta y obtener los resultados
        $results = DB::select($query, $params);
    
        // Paginación
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($results);
        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
    
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
    
        // Consulta para los módulos y permisos
        $modules = DB::select("
            SELECT 
                permissions.id AS id,
                permissions.module_id AS module_id,
                permissions.name AS name_permissions,
                modules.name AS name_module
            FROM 
                permissions 
            INNER JOIN 
                modules 
                ON permissions.module_id = modules.id
        ");
    
        // Agrupa los permisos por module_id
        $groupedModules = [];
        foreach ($modules as $module) {
            $groupedModules[$module->module_id]['name_module'] = $module->name_module;
            $groupedModules[$module->module_id]['permissions'][] = $module;
        }

        // dd($paginatedItems, $groupedModules);

    
        // Si es una solicitud AJAX, devolver solo la tabla paginada
        if ($request->ajax()) {
            return response()->json([
                'html' => view('usuarios.index_table', compact('paginatedItems', 'groupedModules'))->render(),
                'pagination' => $paginatedItems->links()->render()
            ]);
        }

        // Devolver la vista completa si no es AJAX
        return view('usuarios.index', compact('paginatedItems', 'groupedModules', 'search', 'perPage', 'sort', 'direction'));
    }
    
    

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        
        return view('usuarios.crear', compact('roles'));
    }

    public function store(Request $request)
    {
        
        try{

            
            try {
                        $seguridad_usuario_id = DB::connection('sqlsrv')->select('SELECT TOP 1 usuario_id FROM SEGURIDAD.USUARIO ORDER BY usuario_id DESC');
                    } catch (QueryException $e) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Error en la consulta a la base de datos.',
                            'details' => $e->getMessage() // Quitar en producción si no es necesario.
                        ], 500);
                    } catch (PDOException $e) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'No se pudo conectar a la base de datos.',
                            'details' => $e->getMessage() // Quitar en producción si no es necesario.
                        ], 500);
                    } catch (\Throwable $th) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Ocurrió un error inesperado.',
                            'details' => $th->getMessage() // Quitar en producción si no es necesario.
                        ], 500);
                    }

        
        $seguridad_usuario_id = $seguridad_usuario_id[0]->usuario_id;
        $seguridad_usuario_id +=1;    

        $this->validate($request, [
            'name' => 'required',   
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required',
            'user_name' => 'required|unique:users,user_name',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        // Crear una nueva instancia de User
        $user = new User();
        $user->name = $request->input('name');
        $user->apellido_paterno = $request->input('apellido_paterno');
        $user->apellido_materno = $request->input('apellido_materno');
        $user->dni = $request->input('dni');
        $user->user_name = $request->input('user_name');
        $user->password = Hash::make($request->input('password'));
        $user->user_id = $seguridad_usuario_id;
        
        // Guardar el usuario en la base de datos
        $user->save();
        $user->assignRole($request->input('roles'));

        
        try {
                DB::connection('sqlsrv')->insert("INSERT INTO SEGURIDAD.USUARIO (usuario_id, nombre_usuario, apellidos, nombres, estado, fecha_actualizacion, terminal, fecha_registro, dni) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                    $seguridad_usuario_id,
                    $request->input('user_name'),
                    $user->apellidos = $request->input('apellido_paterno') . ' ' . $request->input('apellido_materno'),
                    $request->input('name'),
                    1,
                    $fecha = Carbon::now()->format('Y-m-d H:i:s'),
                    $ipAddress = request()->ip(),
                    $fecha = Carbon::now()->format('Y-m-d H:i:s'),
                    $request->input('dni'),
                ]);                
            } catch (QueryException $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error en la consulta a la base de datos.',
                        'details' => $e->getMessage() // Quitar en producción si no es necesario.
                    ], 500);
            } catch (PDOException $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'No se pudo conectar a la base de datos.',
                        'details' => $e->getMessage() // Quitar en producción si no es necesario.
                    ], 500);
            } catch (\Throwable $th) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Ocurrió un error inesperado.',
                        'details' => $th->getMessage() // Quitar en producción si no es necesario.
                    ], 500);
            }
        
        return redirect()->route('usuarios.index');

        }catch(\Exception $e){
            return redirect()->route('usuarios.index');
        }
    }

    public function updatePermissions(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Actualiza los permisos asociados al usuario
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $usuario->permissions()->sync($permissions);
        } else {
            $usuario->permissions()->detach();
        }

        return redirect()->route('usuarios.index')->with('success', 'Permisos actualizados con éxito.');
    }




    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required',
            'user_name' => 'required|unique:users,user_name,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
