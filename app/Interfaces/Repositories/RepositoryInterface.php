<?php

namespace App\Interfaces\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @return Builder
     */
    public function getQuery(): Builder;

    /**
     * @param array $conditions
     * @param array $updates
     * @return void
     */
    public function updateBy(array $conditions, array $updates): void;

    /**
     * @param int $id
     * @param array $values
     * @return Model
     */
    public function updateById(int $id, array $values): Model;

    /**
     * @param array $conditions
     * @param array $data
     * @return Model|null
     */
    public function updateOrCreate(array $conditions, array $data): ?Model;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param array $inserts
     * @return void
     */
    public function insert(array $inserts): void;

    /**
     * @param array $data
     * @param array $uniqueBy
     * @param array|null $update
     * @return void
     */
    public function upsert(array $data, array $uniqueBy, ?array $update = null): void;

    /**
     * @param array $inserts
     * @return int
     */
    public function insertGetId(array $inserts): int;

    /**
     * @param int $id
     * @param array|null $with
     * @param array|null $select
     * @return Model
     */
    public function getById(int $id, ?array $with = [], ?array $select = ['*']): Model;

    /**
     * @param int $id
     * @param array $where
     * @param array $select
     * @return Model
     */
    public function getByIdWithoutRelations(int $id, array $where = [], array $select = ['*']): Model;

    /**
     * @param array $ids
     * @param array|null $with
     * @param array|null $select
     * @return Collection
     */
    public function getByIds(array $ids, ?array $with = [], ?array $select = ['*']): Collection;

    /**
     * @param array $conditions
     * @param string $orderBy
     * @param bool $orderAsc
     * @param array|null $with
     * @param array|null $select
     * @return Model|null
     */
    public function findBy(
        array $conditions,
        string $orderBy = 'created_at',
        bool $orderAsc = true,
        ?array $with = null,
        ?array $select = ['*']
    ): ?Model;

    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions): bool;

    /**
     * @param array|null $select
     * @param array|null $with
     * @param array|null $where
     * @return Collection
     */
    public function getAll(?array $select = ['*'], ?array $with = [], ?array $where = []): Collection;

    /**
     * @param array $ids
     * @return void
     */
    public function delete(array $ids): void;

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void;

    /**
     * @param array $conditions
     * @return void
     */
    public function deleteBy(array $conditions): void;

    /**
     * @param int|null $page
     * @param int|null $perPage
     * @param array $with
     * @param array $select
     * @return LengthAwarePaginator
     */
    public function paginateAll(
        ?int $page,
        ?int $perPage,
        array $with = [],
        array $select = ['*']
    ): LengthAwarePaginator;

    /**
     * @param Model $model
     * @param string $relationName
     * @return void
     */
    public function deleteRelation(Model $model, string $relationName): void;

    /**
     * @param Model $model
     * @param string $relationName
     * @param array $conditions
     * @param array $data
     * @return Model
     */
    public function updateOrCreateRelation(
        Model $model,
        string $relationName,
        array $conditions,
        array $data
    ): Model;

    /**
     * @param Model $model
     * @param string $relationName
     * @param array $data
     * @return Model
     */
    public function createRelation(Model $model, string $relationName, array $data): Model;

    /**
     * @param Model $model
     * @param string $relationName
     * @param array $conditions
     * @param array $data
     * @return int
     */
    public function updateRelation(Model $model, string $relationName, array $conditions, array $data): int;

    /**
     * @param Model $model
     * @param string $relationName
     * @param array $ids
     * @return void
     */
    public function deleteNotExistingRelations(
        Model $model,
        string $relationName,
        array $ids
    ): void;

    /**
     * @param Model $model
     * @param string $relationName
     * @param array $data
     * @return void
     */
    public function syncRelation(Model $model, string $relationName, array $data): void;
}
