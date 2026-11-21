<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Alquilere;
use PDO;

final class AlquilereRepository implements AlquilereRepositoryInterface
{
    private const WRITABLE = ['cliente_id', 'vehiculo_id', 'fecha_inicio', 'fecha_fin', 'costo', 'estado'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "alquileres" ORDER BY "alquiler_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Alquilere::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Alquilere
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "alquileres" WHERE "alquiler_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Alquilere::fromArray($row) : null;
    }

    public function create(Alquilere $entity): int
    {
        $sql = '
            INSERT INTO "alquileres" ("cliente_id", "vehiculo_id", "fecha_inicio", "fecha_fin", "costo", "estado")
            VALUES (:cliente_id, :vehiculo_id, :fecha_inicio, :fecha_fin, :costo, :estado)
            RETURNING "alquiler_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Alquilere $entity): void
    {
        $sql = '
            UPDATE "alquileres"
            SET "cliente_id" = :cliente_id, "vehiculo_id" = :vehiculo_id, "fecha_inicio" = :fecha_inicio, "fecha_fin" = :fecha_fin, "costo" = :costo, "estado" = :estado
            WHERE "alquiler_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->alquiler_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "alquileres" WHERE "alquiler_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Alquilere $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
