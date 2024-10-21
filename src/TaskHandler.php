<?php

namespace pixelwhiz\times;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\world\World;
use pixelwhiz\times\TimeManager;

class TaskHandler extends Task {

    public function onRun(): void
    {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $day = TimeManager::getCurrentDay($player->getWorld());
            $time = TimeManager::getCurrentTime($player->getWorld());
            if ($player->isSneaking()) {
                $player->sendMessage("Hari: ". $day);
            }
        }
    }


}