<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Vehiculo;
use App\Repositories\VehiculoRepository;
use App\Services\VehiculoService;
use PDOException;

final class VehiculosController extends Controller
{
    private VehiculoService $service;

    public function __construct(?VehiculoService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new VehiculoService(
                new VehiculoRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'vehiculos/index',
            ['items' => $this->service->list()],
            'Vehiculos'
        );
    }

    public function create(): void
    {
        $this->form(new Vehiculo(), [], 'vehiculos/store', 'Nuevo Vehiculo');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Vehiculo::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'vehiculos/store', 'Nuevo Vehiculo');
            return;
        }

        $this->service->create($entity);

        $this->redirect('vehiculos', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'vehiculos/update/' . $entity->vehiculo_id,
            'Editar Vehiculo'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Vehiculo::fromArray($this->request->allPost());
        $entity->vehiculo_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'vehiculos/update/' . $id,
                'Editar Vehiculo'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('vehiculos', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'vehiculos',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('vehiculos', 'Registro eliminado.');
    }

    private function form(
        Vehiculo $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'vehiculos/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
