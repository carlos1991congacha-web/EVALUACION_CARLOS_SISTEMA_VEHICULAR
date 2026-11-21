<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla vehiculos. */
final class Vehiculo
{
    public function __construct(
        public ?int $vehiculo_id = null,
        public string $marca = '',
        public string $modelo = '',
        public int $anio = 0,
        public bool $disponible = false,
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            vehiculo_id: (isset($d['vehiculo_id']) && $d['vehiculo_id'] !== '' ? (int) $d['vehiculo_id'] : null),
            marca: (string) ($d['marca'] ?? ''),
            modelo: (string) ($d['modelo'] ?? ''),
            anio: (int) ($d['anio'] ?? 0),
            disponible: in_array(strtolower((string) ($d['disponible'] ?? '')), ['1', 't', 'true', 'yes', 'on'], true),
        );
    }

    public function toArray(): array
    {
        return [
            'vehiculo_id' => $this->vehiculo_id,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'anio' => $this->anio,
            'disponible' => (int) $this->disponible,
        ];
    }
}
