<?php

namespace pixelwhiz\times\handlers;

use pixelwhiz\times\TimeManager;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class TaskHandler extends Task {

    private Player $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function onRun(): void
    {
        $player = $this->player;
        if ($player->isOnline()) {
            $day = TimeManager::getCurrentDay($player->getWorld());
            $time = TimeManager::getCurrentTime($player->getWorld());
            $player->sendTip("Time: {$day}, {$time}");
        } else {
            $this->getHandler()->cancel();
        }
    }


}