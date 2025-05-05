<?php
namespace Builder\BlockBuilder\Interfaces;

interface BlockInterface
{
    public function render(): string;
    public function settings(): array;
}
