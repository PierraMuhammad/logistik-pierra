<?php

namespace App\Repositories;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageRepository
{
    public function getAllStorage()
    {
        return Storage::orderBy('storage_code')->get();
    }

    public function findStorageById(string $id)
    {
        return Storage::where('storage_id', $id)->firstOrFail();
    }

    public function LockStorageById(string $id)
    {
        return Storage::where('storage_id', $id)->lockForUpdate()->first();
    }

    public function createStorage(Request $request)
    {
        return Storage::create([
            'storage_id' => $request['id'],
            'storage_code' => $request['code'],
            'storage_location' => $request['name']
        ]);
    }

    public function updateStorage(Request $request, string $id)
    {
        return Storage::where('storage_id', $id)->update([
            'storage_location' => $request['name']
        ]);
    }

    public function deleteStorage(string $id)
    {
        return Storage::where('storage_id', $id)->delete();
    }
}
