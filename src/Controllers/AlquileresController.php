<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Alquilere;
use App\Repositories\AlquilereRepository;
use App\Services\AlquilereService;
use PDOException;

final class AlquileresController extends Controller
{
    private AlquilereService $service;

    public function __construct(?AlquilereService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new AlquilereService(
                new AlquilereRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'alquileres/index',
            ['items' => $this->service->list()],
            'Alquileres'
        );
    }

    public function create(): void
    {
        $this->form(new Alquilere(), [], 'alquileres/store', 'Nuevo Alquilere');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Alquilere::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'alquileres/store', 'Nuevo Alquilere');
            return;
        }

        $this->service->create($entity);

        $this->redirect('alquileres', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'alquileres/update/' . $entity->alquiler_id,
            'Editar Alquilere'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Alquilere::fromArray($this->request->allPost());
        $entity->alquiler_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'alquileres/update/' . $id,
                'Editar Alquilere'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('alquileres', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'alquileres',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('alquileres', 'Registro eliminado.');
    }

    private function form(
        Alquilere $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'alquileres/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
