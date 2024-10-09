<?php
/**
 * @author    Salvador Baqués <salva@email5.com>
 * @link      https://stage.work
 * @copyright 2024 Stage Framework
 * @package   https://github.com/playinteractive
 */

/*
╔══════════════════════════════════════════════════════════════════════
║  STAGE ~ PLUGINS ≡ plugin.php
╠══════════════════════════════════════════════════════════════════════
║
*/

namespace Stage;

use Stage\Tool;

class Plugin
{
    private $namespace;
    private $id;
    private $version;
    private $path;

    public function __construct($namespace, $id, $version)
    {
        $this->namespace = $namespace;
        $this->id = $id;
        $this->version = $version;
        $this->path = Tool::path([$_ENV['PLUGIN'], $namespace, $_ENV['INDEX']]);
    }

    public function __toString()
    {
        return $this->namespace;
    }

    public function id()
    {
        return $this->id;
    }

    public function version()
    {
        return $this->version;
    }

    public function execute()
    {
        if (!file_exists($this->path)) throw new \Exception("Plugin not found: {$this->namespace}");

        require $this->path;
    }

    public function include($relativePath)
    {
        $filePath = Tool::path([$_ENV['PLUGIN'], $this->namespace, $relativePath]);

        if (!file_exists($filePath)) throw new \Exception("File {$relativePath} not found in plugin {$this->namespace}");

        require $filePath;
    }
}
