<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entity;

use App\Domain\ValueObjects\Address;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Phone;

final readonly class Company implements \JsonSerializable
{
    public function __construct(
        private string $name,
        private Address $address,
        private Phone $phone,
        private ?Email $email = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => (string)$this->phone,
        ];

        if ($this->email) {
            $data['email'] = (string)$this->email;
        }

        return $data;
    }
}
