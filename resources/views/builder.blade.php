<!-- builder.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind & Alpine.js --}}
    @livewireStyles
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-1/4 bg-white p-4 border-r">
        <h2 class="text-xl font-bold mb-4">Blocks</h2>
        <ul class="space-y-2">
            @foreach (app('pagebuilder')->getBlocks() as $key => $block)
                <li>
                    <button
                            class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                            @click="builder.add('{{ $key }}')"
                    >
                        {{ $key }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Canvas -->
    <div class="w-3/4 p-6" x-data="pageBuilder()" x-init="init()">
        <h2 class="text-xl font-bold mb-4">Your Page</h2>
        <div class="space-y-4 border p-4 min-h-[300px] bg-white" id="builder-canvas">
            <template x-for="(block, index) in blocks" :key="index">
                <div class="relative border p-4 bg-gray-50 rounded shadow">
                    <button class="absolute top-1 right-1 text-red-500" @click="remove(index)">✕</button>
                    <div x-html="block.content"></div>
                </div>
            </template>
        </div>
    </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
<script>
    function pageBuilder() {
        return {
            blocks: [],
            async add(blockName) {
                const response = await fetch(`/api/builder/render/${blockName}`);
                const data = await response.text();
                this.blocks.push({ name: blockName, content: data });
            },
            remove(index) {
                this.blocks.splice(index, 1);
            },
            init() {
                // Load saved state if needed
            }
        }
    }
</script>
</body>
</html>
