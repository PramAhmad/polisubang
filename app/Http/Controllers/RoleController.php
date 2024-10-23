<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\Menu;
use App\Models\MenuPermission;
use App\Models\RoleMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('role.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:roles,name'
        ]);

        Role::create($request->all());

        return response()->json(['success' => true, 'message' => 'Role created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $role, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }
        
        $request->validate([
            'name' => 'required|min:3|max:100|unique:roles,name,' . $id
        ]);

        $role->update($request->all());

        return response()->json(['success' => true, 'data' => $role, 'message' => 'Role updated successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }

    public function permission($id)
    {
        $role = Role::findOrFail($id);
        $menus = Menu::all();

        $modules = [];

        foreach ($menus as $menu) {
            $menuPermission = MenuPermission::where('menu_id', $menu->id)->get();
            $permission = [];

            foreach ($menuPermission as $mp) {
                $permission[] = [
                    'id' => $mp->id,
                    'name' => $mp->alias,
                    'permission_name' => $mp->permission?->name,
                    'checked' => $role->hasPermissionTo($mp->permission?->name)
                ];
            }

            $modules[] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'permission' => $permission,
                'checked' => RoleMenu::where(['role_id' => $id, 'menu_id' => $menu->id])->exists()
            ];
        }

        return view('role.permission', compact('role', 'modules'));
    }

    public function updatePermission(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        DB::beginTransaction();

        try {
            $role->syncPermissions($request->permission);

            $roleMenu = [];

            if ($request->menu) {
                foreach($request->menu as $m) {
                    $roleMenu[] = [
                        'role_id' => $id,
                        'menu_id' => $m,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            RoleMenu::where('role_id', $id)->delete();

            if (count($roleMenu) > 0){
                RoleMenu::insert($roleMenu);
            }
            
            DB::commit();

            return redirect(route('role.permission', $id))->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect(route('role.permission', $id))->with('error', $e->getMessage());
        }
    }
}