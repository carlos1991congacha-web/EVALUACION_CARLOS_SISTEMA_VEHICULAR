<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Vehiculo;
use PDO;

final class VehiculoRepository implements VehiculoRepositoryInterface
{
    private const WRITABLE = ['marca', 'modelo', 'anio', 'disponible'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "vehiculos" ORDER BY "vehiculo_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Vehiculo::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Vehiculo
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "vehiculos" WHERE "vehiculo_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Vehiculo::fromArray($row) : null;
    }

    public function create(Vehiculo $entity): int
    {
        $sql = '
            INSERT INTO "vehiculos" ("marca", "modelo", "anio", "disponible")
            VALUES (:marca, :modelo, :anio, :disponible)
            RETURNING "vehiculo_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Vehiculo $entity): void
    {
        $sql = '
            UPDATE "vehiculos"
            SET "marca" = :marca, "modelo" = :modelo, "anio" = :anio, "disponible" = :disponible
            WHERE "vehiculo_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->vehiculo_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "vehiculos" WHERE "vehiculo_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Vehiculo $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
