<?php

namespace pixelwhiz\times\handlers;

use pixelwhiz\times\TimeManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Clock;

class EventHandler implements Listener {

    public function onHeld(PlayerItemUseEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item instanceof Clock) {
            $day = TimeManager::getCurrentDay($player->getWorld());
            $time = TimeManager::getCurrentTime($player->getWorld());
            $player->sendMessage("Time: {$day}, {$time}");
        }
    }

}