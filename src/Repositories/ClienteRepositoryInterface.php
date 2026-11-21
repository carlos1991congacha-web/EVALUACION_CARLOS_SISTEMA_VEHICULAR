<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Cliente;

interface ClienteRepositoryInterface
{
    /** @return Cliente[] */
    public function all(): array;

    public function find(int $id): ?Cliente;

    public function create(Cliente $entity): int;

    public function update(Cliente $entity): void;

    public function delete(int $id): void;
}
