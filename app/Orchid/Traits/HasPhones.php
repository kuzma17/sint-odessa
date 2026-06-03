<?php

namespace App\Orchid\Traits;

Trait HasPhones
{
    protected function normalizePhones(array $phones): array
    {
        return collect($phones)
            ->map(fn($phone) => $this->normalizePhone($phone))
            ->filter()
            ->values()
            ->toArray();
    }

    protected function normalizePhone(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $phone);

        if (strlen($phone) === 9) {
            return '380' . $phone;
        }

        if (
            strlen($phone) === 10 &&
            str_starts_with($phone, '0')
        ) {
            return '38' . $phone;
        }

        return $phone ?: null;
    }

    protected function formatPhone(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $phone = $this->normalizePhone($phone);

        if (strlen($phone) !== 12) {
            return $phone;
        }

        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{2})(\d{2})/',
            '+$1 ($2) $3-$4-$5',
            $phone
        );
    }

}