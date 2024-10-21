<?php

declare(strict_types=1);

namespace pixelwhiz\times;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase {

    protected function onEnable(): void
    {
        $this->getScheduler()->scheduleRepeatingTask(new TaskHandler($this), 20);
    }

}
