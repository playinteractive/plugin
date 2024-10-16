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

    public static function load($package)
    {
        $location = Tool::path([$_ENV['PLUGIN'], $package->namespace, $_ENV['INDEX']]);

        if (!file_exists($location)) throw new \Exception("Plugin not found: {$package->namespace}");

        return $location;
    }

    public function include($file)
    {
        $file = is_array($file) ? Tool::path(array_merge([$_ENV['PLUGIN'], $this->namespace], $file)) : Tool::path([$_ENV['PLUGIN'], $this->namespace, $file]);

        if (!file_exists($file)) throw new \Exception("File {$file} not found in plugin {$this->namespace}");

        require $file;
    }
}
