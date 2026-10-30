<?php

namespace Morisawa\Serializer;

class DataArraySerializer extends ArraySerializer
{
    /**
     * {@inheritDoc}
     */
    public function collection(?string $resourceKey, array $data): array
    {
        return ['data' => $data];
    }

    /**
     * {@inheritDoc}
     */
    public function item(?string $resourceKey, array $data): array
    {
        return ['data' => $data];
    }

    /**
     * {@inheritDoc}
     */
    public function null(): ?array
    {
        return ['data' => []];
    }
}
