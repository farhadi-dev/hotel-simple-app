<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->newQuery()->get();
    }

    /**
     * @throws RepositoryException
     */
    public function getById(int $id): Model
    {
        try {
            return $this->model->newQuery()->findOrFail($id);

        } catch (ModelNotFoundException $e) {
            throw new RepositoryException(
                class_basename($this->model) . "with {$id} not found}", 404
            );
        } catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), 500);
        }
    }

    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @throws RepositoryException
     */
    public function update(int $id, array $data): Model
    {
        try {
            $record = $this->model->newQuery()->findOrFail($id);
            $record->update($data);
            return $record;
        }catch (ModelNotFoundException $e) {
            throw new RepositoryException(
                class_basename($this->model) . "with {$id} not found", 404
            );
        }catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), 500);
        }
    }

    /**
     * @throws RepositoryException
     */
    public function delete(int $id): Model
    {
        try {
            $record = $this->model->newQuery()->findOrFail($id);
            $record->delete();
            return $record;
        }catch (ModelNotFoundException $e) {
            throw new RepositoryException(
                class_basename($this->model) . "with {$id} not found", 404
            );
        }catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), 500);
        }
    }

}
