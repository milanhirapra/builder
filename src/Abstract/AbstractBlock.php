<?php

namespace Builder\BlockBuilder\Abstract;

use Builder\BlockBuilder\Interfaces\BlockInterface;

abstract class AbstractBlock implements BlockInterface
{
    protected string $name;

    public function __construct()
    {
        $this->name = static::class;
    }

    abstract public function render(): string;

    public function settings(): array
    {
        return [];
    }

    public function getName(): string
    {
        return class_basename($this->name);
    }
}
