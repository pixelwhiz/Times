<?php

declare(strict_types=1);

namespace pixelwhiz\times;

use pixelwhiz\times\commands\TimesCommand;
use pixelwhiz\times\handlers\EventHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase {

    protected function onEnable(): void
    {
        Server::getInstance()->getPluginManager()->registerEvents(new EventHandler($this), $this);
        Server::getInstance()->getCommandMap()->register("times", new TimesCommand());
    }
}
