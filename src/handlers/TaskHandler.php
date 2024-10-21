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