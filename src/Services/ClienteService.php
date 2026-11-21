<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Cliente;
use App\Repositories\ClienteRepositoryInterface;

final class ClienteService
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Cliente
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Cliente $e): array
    {
        $errors = [];

        if (trim((string) $e->nombre) === '') {
            $errors['nombre'] = 'Nombre es obligatorio.';
        }
        if (mb_strlen((string) $e->nombre) > 100) {
            $errors['nombre'] = 'Nombre admite maximo 100 caracteres.';
        }
        if (trim((string) $e->apellido) === '') {
            $errors['apellido'] = 'Apellido es obligatorio.';
        }
        if (mb_strlen((string) $e->apellido) > 100) {
            $errors['apellido'] = 'Apellido admite maximo 100 caracteres.';
        }
        if (trim((string) $e->licencia) === '') {
            $errors['licencia'] = 'Licencia es obligatorio.';
        }
        if (mb_strlen((string) $e->licencia) > 50) {
            $errors['licencia'] = 'Licencia admite maximo 50 caracteres.';
        }
        if (mb_strlen((string) $e->telefono) > 20) {
            $errors['telefono'] = 'Telefono admite maximo 20 caracteres.';
        }

        return $errors;
    }

    public function create(Cliente $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Cliente $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
