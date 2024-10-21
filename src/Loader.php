<?php

declare(strict_types=1);

namespace pixelwhiz\times;

use pixelwhiz\times\handlers\EventHandler;
use pixelwhiz\times\handlers\TaskHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase {

    protected function onEnable(): void
    {
        $this->getScheduler()->scheduleRepeatingTask(new TaskHandler(), 20);
        Server::getInstance()->getPluginManager()->registerEvents(new EventHandler(), $this);
    }

}
