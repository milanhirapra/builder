<?php
namespace Builder\BlockBuilder;

use Illuminate\Support\ServiceProvider;
use File;

class PageBuilderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pagebuilder');
    }

    public function boot()
    {
        $this->registerBlocksFrom(__DIR__.'/Blocks');
        $this->registerBlocksFrom(app_path('Blocks'));
    }

    protected function registerBlocksFrom($dir)
    {
        if (!is_dir($dir)) return;

        foreach (glob($dir . '/*.php') as $file) {
            $class = $this->getClassFromFile($file);
            if (class_exists($class) && is_subclass_of($class, \Builder\BlockBuilder\Interfaces\BlockInterface::class)) {
                app('pagebuilder')->register(new $class);
            }
        }

    }

    protected function getClassFromFile($file)
    {
        $content = file_get_contents($file);
        preg_match('/namespace\s+(.+);/', $content, $namespace);
        preg_match('/class\s+(\w+)/', $content, $class);
        return $namespace[1] . '\\' . $class[1];
    }
}
