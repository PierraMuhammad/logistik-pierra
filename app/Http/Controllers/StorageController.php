<?php

namespace App\Http\Controllers;

use App\Services\StorageService;
use Exception;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct(
        protected StorageService $storageService
    ) {}

    public function table()
    {
        return view('content.storage.table');
    }

    public function form()
    {
        return view('content.storage.form');
    }

    public function get()
    {
        try {
            $storages = $this->storageService->getAllStorage();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $storages,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function findById(string $id)
    {
        try {
            $storage = $this->storageService->findStorageById($id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $storage,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $storage = $this->storageService->createStorage($request);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $storage,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $storage = $this->storageService->updateStorage($request, $id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $storage,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete(string $id)
    {
        try {
            $storage = $this->storageService->deleteStorage($id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $storage,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
