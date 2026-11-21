<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla clientes. */
final class Cliente
{
    public function __construct(
        public ?int $cliente_id = null,
        public string $nombre = '',
        public string $apellido = '',
        public string $licencia = '',
        public ?string $telefono = null,
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            cliente_id: (isset($d['cliente_id']) && $d['cliente_id'] !== '' ? (int) $d['cliente_id'] : null),
            nombre: (string) ($d['nombre'] ?? ''),
            apellido: (string) ($d['apellido'] ?? ''),
            licencia: (string) ($d['licencia'] ?? ''),
            telefono: (isset($d['telefono']) && $d['telefono'] !== '' ? (string) $d['telefono'] : null),
        );
    }

    public function toArray(): array
    {
        return [
            'cliente_id' => $this->cliente_id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'licencia' => $this->licencia,
            'telefono' => $this->telefono,
        ];
    }
}
