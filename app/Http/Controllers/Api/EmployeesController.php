<?php

namespace App\Http\Controllers\Api;

use App\Models\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $filterByStatus = $request->input("status");
        $filterByKeyword = $request->input("search");
        $query = Employees::query();

        if ($filterByStatus) {
            $query->where("status", $filterByStatus);
        } else if ($filterByKeyword) {
            $query->where(function($q) use ($filterByKeyword) {
                $q->where('name', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('email', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('position', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('salary', $filterByKeyword);
            });
        }
            
        $employees = $query->get();

        if ($employees->isEmpty() == false) {
            $employees = $query->paginate(10);
            return response()->json([
                'success' => true,
                'message' => "Data pegawai ditemukan",
                'current_page'  => $employees->currentPage(),
                'total_pages'   => $employees->lastPage(),
                'total_items'   => $employees->total(),
                'data'          => $employees->items(),
                'links'         => [
                    'next_page_url' => $employees->nextPageUrl(),
                    'prev_page_url' => $employees->previousPageUrl()
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data pegawai tidak ditemukan"
            ], 404);
        }
        
    }

    public function show(string $id)
    {   
        try {
            $employee = Employees::findorFail($id);
            return response()->json([
                'success' => true,
                'message' => "Data pegawai ditemukan",
                'data' => $employee
            ], 200);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => "Data pegawai tidak ditemukan"
            ], 404);
         }
        
    }
}
