<?php

namespace App\Services;

use App\Repositories\StorageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class StorageService
{
    public function __construct(
        protected StorageRepository $storageRepository,
    ) {}

    public function getAllStorage()
    {
        try {
            $storages = $this->storageRepository->getAllStorage();

            if ($storages->isEmpty()) {
                throw new Exception('There is no Storage');
            }

            return $storages;
        } catch (Exception $e) {
            throw new Exception('Error get storage: ' . $e->getMessage());
        }
    }

    public function findStorageById(string $id)
    {
        try {
            $storage = $this->storageRepository->findStorageById($id);

            if (!$storage) {
                throw new Exception('Storage not found');
            }

            return $storage;
        } catch (Exception $e) {
            throw new Exception('Error find storage: ' . $e->getMessage());
        }
    }

    public function createStorage(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['id'] = Str::random(32);
            $storage = $this->storageRepository->createStorage($request);

            DB::commit();
            return $storage;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error create storage: ' . $e->getMessage());
        }
    }

    public function updateStorage(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $storage = $this->storageRepository->LockStorageById($id);
            if ($storage) {
                $storage = $this->storageRepository->updateStorage($request, $id);

                DB::commit();
            }

            return $storage;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error update storage: ' . $e->getMessage());
        }
    }

    public function deleteStorage(string $id)
    {
        DB::beginTransaction();
        try {
            $storage = $this->storageRepository->LockStorageById($id);
            if ($storage) {
                $this->storageRepository->deleteStorage($id);

                DB::commit();
                return true;
            }

            return false;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error delete storage: ' . $e->getMessage());
        }
    }
}
