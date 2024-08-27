<?php

namespace App\Http\Controllers\Api;

use App\Models\ServiceProject;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ServiceProjectController extends Controller
{
    public function index()
    {
        $data = ProjectResource::collection(ServiceProject::paginate(10));

        if ($data) {
            return response()->json([
                'status' => 1,
                'data' => $data,
                'pagination' => [
                    'total' => $data->total(),
                    'count' => $data->count(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'total_pages' => $data->lastPage(),
                ],
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Not found',
        ], 200);
    }

    public function homeitem()
    {
        $data = ProjectResource::collection(ServiceProject::get()->take(3));

        if ($data) {
            return response()->json([
                'status' => 1,
                'data' => $data,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Not found',
        ], 200);
    }
}
