<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Cliente;
use App\Repositories\ClienteRepository;
use App\Services\ClienteService;
use PDOException;

final class ClientesController extends Controller
{
    private ClienteService $service;

    public function __construct(?ClienteService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new ClienteService(
                new ClienteRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'clientes/index',
            ['items' => $this->service->list()],
            'Clientes'
        );
    }

    public function create(): void
    {
        $this->form(new Cliente(), [], 'clientes/store', 'Nuevo Cliente');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Cliente::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'clientes/store', 'Nuevo Cliente');
            return;
        }

        $this->service->create($entity);

        $this->redirect('clientes', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'clientes/update/' . $entity->cliente_id,
            'Editar Cliente'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Cliente::fromArray($this->request->allPost());
        $entity->cliente_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'clientes/update/' . $id,
                'Editar Cliente'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('clientes', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'clientes',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('clientes', 'Registro eliminado.');
    }

    private function form(
        Cliente $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'clientes/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
