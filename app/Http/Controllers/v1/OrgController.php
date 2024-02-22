<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Org;
use Illuminate\Http\Request;

class OrgController extends Controller
{

    public function index()
    {
        $response = Org::all();
        return response()->json($response);
    }


    public function create()
    {
        //
    }


    public function update(Request $request, Org $org)
    {
        //
    }

    public function destroy(Org $org)
    {
        //
    }
}
