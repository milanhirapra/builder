<?php

namespace Builder\BlockBuilder\Facades;

class Builder
{
    protected array $blocks = [];

    public function register($block)
    {
        $this->blocks[$block->getName()] = $block;
    }

    public function renderBlock($name)
    {
        return $this->blocks[$name]?->render() ?? '';
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }
}
