<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Vehiculo;

interface VehiculoRepositoryInterface
{
    /** @return Vehiculo[] */
    public function all(): array;

    public function find(int $id): ?Vehiculo;

    public function create(Vehiculo $entity): int;

    public function update(Vehiculo $entity): void;

    public function delete(int $id): void;
}
