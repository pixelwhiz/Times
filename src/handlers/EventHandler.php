<?php

namespace pixelwhiz\times\handlers;

use pixelwhiz\times\Loader;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Clock;

class EventHandler implements Listener {

    public array $useClock = [];

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }

    public function onHeld(PlayerItemUseEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item instanceof Clock) {
            if (!isset($this->useClock[$player->getName()])) {
                $this->task = $this->plugin->getScheduler()->scheduleRepeatingTask(new TaskHandler($player), 20);
                $this->useClock[$player->getName()] = true;
            } else {
                $this->task->cancel();
                unset($this->useClock[$player->getName()]);
            }
        }
    }

}