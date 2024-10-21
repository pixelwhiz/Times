<?php

namespace pixelwhiz\times;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Clock;

class EventHandler implements Listener {

    public function onHeld(PlayerItemHeldEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item instanceof Clock) {
            $day = TimeManager::getCurrentDay($player->getWorld());
            $time = TimeManager::getCurrentTime($player->getWorld());
            $item->setCustomName("Time: {$day}, {$time}");
            $player->getInventory()->setItemInHand($item);
        }
    }

}