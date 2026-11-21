<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla alquileres. */
final class Alquilere
{
    public function __construct(
        public ?int $alquiler_id = null,
        public int $cliente_id = 0,
        public int $vehiculo_id = 0,
        public string $fecha_inicio = '',
        public string $fecha_fin = '',
        public float $costo = 0.0,
        public ?string $estado = null,
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            alquiler_id: (isset($d['alquiler_id']) && $d['alquiler_id'] !== '' ? (int) $d['alquiler_id'] : null),
            cliente_id: (int) ($d['cliente_id'] ?? 0),
            vehiculo_id: (int) ($d['vehiculo_id'] ?? 0),
            fecha_inicio: (string) ($d['fecha_inicio'] ?? ''),
            fecha_fin: (string) ($d['fecha_fin'] ?? ''),
            costo: (float) ($d['costo'] ?? 0.0),
            estado: (isset($d['estado']) && $d['estado'] !== '' ? (string) $d['estado'] : null),
        );
    }

    public function toArray(): array
    {
        return [
            'alquiler_id' => $this->alquiler_id,
            'cliente_id' => $this->cliente_id,
            'vehiculo_id' => $this->vehiculo_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'costo' => $this->costo,
            'estado' => $this->estado,
        ];
    }
}
