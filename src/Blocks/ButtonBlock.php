<?php
namespace Builder\BlockBuilder\Blocks;

use Builder\BlockBuilder\Abstract\AbstractBlock;

class ButtonBlock extends AbstractBlock
{
    public function render(): string
    {
        return view('pagebuilder::blocks.button', $this->settings())->render();
    }

    public function settings(): array
    {
        return [
            'text' => 'Click Me',
            'link' => '#',
            'target' => '_blank',
            'bg_color' => 'bg-blue-500',
            'text_color' => 'text-white',
            'hover_bg_color' => 'hover:bg-blue-700',
            'hover_text_color' => 'hover:text-gray-100',
            'style' => 'rounded px-4 py-2',
        ];
    }
}
