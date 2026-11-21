<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Alquilere;
use App\Repositories\AlquilereRepositoryInterface;

final class AlquilereService
{
    public function __construct(
        private AlquilereRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Alquilere
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Alquilere $e): array
    {
        $errors = [];

        if (trim((string) $e->fecha_inicio) === '') {
            $errors['fecha_inicio'] = 'Fecha inicio es obligatorio.';
        }
        if (trim((string) $e->fecha_fin) === '') {
            $errors['fecha_fin'] = 'Fecha fin es obligatorio.';
        }
        if (mb_strlen((string) $e->estado) > 20) {
            $errors['estado'] = 'Estado admite maximo 20 caracteres.';
        }

        return $errors;
    }

    public function create(Alquilere $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Alquilere $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
