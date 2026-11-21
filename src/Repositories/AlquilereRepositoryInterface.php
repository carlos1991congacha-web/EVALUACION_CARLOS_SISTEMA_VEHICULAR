<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Alquilere;

interface AlquilereRepositoryInterface
{
    /** @return Alquilere[] */
    public function all(): array;

    public function find(int $id): ?Alquilere;

    public function create(Alquilere $entity): int;

    public function update(Alquilere $entity): void;

    public function delete(int $id): void;
}
