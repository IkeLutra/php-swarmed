<?php

namespace IkeLutra\Swarmed;

use Dotenv\Loader;

class Swarmed
{
    private $path;
    private $loader;

    public function __construct(string $path = "/run/secrets")
    {
        $this->path = $path;
        $this->loader = new Loader(null, true);
    }

    public function load()
    {
        if (is_dir($this->path)) {
            foreach (scandir($this->path) as $file) {
                if ($file !== '.' && $file !== '..') {
                    $contents = '"' . trim(file_get_contents("{$this->path}/{$file}")) . '"';
                    $name = strtoupper($file);
                    $this->loader->setEnvironmentVariable($name, $contents);
                }
            }
            return true;
        }
        return false;
    }

    public function overload()
    {
        $this->loader->setImmutable(false);
        $this->load();
    }
}
