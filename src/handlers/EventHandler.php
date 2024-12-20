<?php

/*
 *   _______ _
 *  |__   __(_)
 *     | |   _ _ __ ___   ___  ___
 *     | |  | | '_ ` _ \ / _ \/ __|
 *     | |  | | | | | | |  __/\__ \
 *     |_|  |_|_| |_| |_|\___||___/
 *
 * Copyright (C) 2024 pixelwhiz
 *
 * This software is distributed under "GNU General Public License v3.0".
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see <https://opensource.org/licenses/GPL-3.0>.
 */


namespace pixelwhiz\times\handlers;

use pixelwhiz\times\handlers\TaskHandler;
use pixelwhiz\times\Loader;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Clock;

class EventHandler implements Listener {
    private Loader $plugin;

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }

    public function onUse(PlayerItemUseEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item instanceof Clock) {
            if (!isset($this->plugin->useClock[$player->getName()])) {
                $this->plugin->getScheduler()->scheduleRepeatingTask(new TaskHandler($this->plugin, $player), 20);
                $this->plugin->useClock[$player->getName()] = true;
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        if ($this->plugin->getConfig()->get("auto-display-when-join") === true) {
            if (!isset($this->plugin->useClock[$player->getName()])) {
                $this->plugin->getScheduler()->scheduleRepeatingTask(new TaskHandler($this->plugin, $player), 20);
                $this->plugin->useClock[$player->getName()] = true;
            }
        }
    }

}