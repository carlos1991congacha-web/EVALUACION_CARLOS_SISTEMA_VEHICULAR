<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Vehiculo;
use App\Repositories\VehiculoRepositoryInterface;

final class VehiculoService
{
    public function __construct(
        private VehiculoRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Vehiculo
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Vehiculo $e): array
    {
        $errors = [];

        if (trim((string) $e->marca) === '') {
            $errors['marca'] = 'Marca es obligatorio.';
        }
        if (mb_strlen((string) $e->marca) > 100) {
            $errors['marca'] = 'Marca admite maximo 100 caracteres.';
        }
        if (trim((string) $e->modelo) === '') {
            $errors['modelo'] = 'Modelo es obligatorio.';
        }
        if (mb_strlen((string) $e->modelo) > 100) {
            $errors['modelo'] = 'Modelo admite maximo 100 caracteres.';
        }

        return $errors;
    }

    public function create(Vehiculo $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Vehiculo $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
