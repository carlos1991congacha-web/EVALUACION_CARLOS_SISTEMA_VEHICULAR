<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Cliente;
use PDO;

final class ClienteRepository implements ClienteRepositoryInterface
{
    private const WRITABLE = ['nombre', 'apellido', 'licencia', 'telefono'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "clientes" ORDER BY "cliente_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Cliente::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Cliente
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "clientes" WHERE "cliente_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Cliente::fromArray($row) : null;
    }

    public function create(Cliente $entity): int
    {
        $sql = '
            INSERT INTO "clientes" ("nombre", "apellido", "licencia", "telefono")
            VALUES (:nombre, :apellido, :licencia, :telefono)
            RETURNING "cliente_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Cliente $entity): void
    {
        $sql = '
            UPDATE "clientes"
            SET "nombre" = :nombre, "apellido" = :apellido, "licencia" = :licencia, "telefono" = :telefono
            WHERE "cliente_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->cliente_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "clientes" WHERE "cliente_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Cliente $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
