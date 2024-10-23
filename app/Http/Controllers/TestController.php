<?php

namespace App\Http\Controllers;

use App\DataTables\testDataTable;
use App\Models\test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class testController extends Controller
{
    public function index(testDataTable $datatable)
    {
        return $datatable->render('test.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
        ]);

        test::create($request->all());

        return response()->json(['success' => true, 'message' => 'test created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $test = test::find($id);

        if (!$test) {
            return response()->json(['success' => false, 'message' => 'test not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $test, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|min:3|max:100'
        ]);

        $test = test::find($id);

        if (!$test) {
            return response()->json(['success' => false, 'message' => 'test not found'], 404);
        }

        $update = $request->all();

        $test->update($update);

        return response()->json(['success' => true, 'message' => '{{ caps_namename }} update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $test = test::find($id);

        if (!$test) {
            return response()->json(['success' => true, 'message' => 'test not found'], 404);
        }

        $test->delete();

        return response()->json(['success' => true, 'message' => '{{caps_ name }} deleted successfully', '_token' => csrf_token()]);
    }
}
