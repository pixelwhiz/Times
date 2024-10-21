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


namespace pixelwhiz\times\commands;

use pixelwhiz\times\math\DayRange;
use pixelwhiz\times\TimeManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\utils\TextFormat;

class TimesCommand extends Command implements PluginOwned {

    use PluginOwnedTrait;
    public Plugin $plugin;

    public function __construct(Plugin $plugin)
    {
        parent::__construct("times", "Change the day and time on each world", "Usage: /times help", []);
        $this->setPermission("times.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {

        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "This command can only be executed in-game.");
            return false;
        }

        if (!$this->testPermission($sender)) {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
            return false;
        }

        if (!isset($args[0])) {
            $sender->sendMessage($this->getUsage());
            return false;
        }

        switch ($args[0]) {
            case "days":
                $sender->sendMessage("Available Days: ");
                foreach (DayRange::DAYS as $day) {
                    $sender->sendMessage("- ". $day);
                }
                break;
            case "list":
                $sender->sendMessage("Available Times: ");
                foreach (DayRange::INCREMENT_TIME as $time => $value) {
                    $sender->sendMessage("- ". $time);
                }
                break;
            case "set":
                if (!isset($args[1]) || !isset($args[2])) {
                    $sender->sendMessage(TextFormat::RED . "Usage: /times set <time> <day>");
                    return false;
                }

                $day = $args[2];
                $time = $args[1];

                if (!array_key_exists($time, DayRange::INCREMENT_TIME)) {
                    $sender->sendMessage(TextFormat::RED . "Invalid time. Use /times list to see the available times.");
                    return false;
                }

                if (!in_array($day, DayRange::DAYS)) {
                    $sender->sendMessage(TextFormat::RED . "Invalid day. Use /times days to see the available days.");
                    return false;
                }

                $world = $sender->getWorld();
                $rangeOfDestinationDay = TimeManager::rangeOfDay($day)[0];

                $timeValue = DayRange::INCREMENT_TIME[$time];

                $newTime = ($rangeOfDestinationDay + $timeValue);
                $world->setTime($newTime);

                $sender->sendMessage(TextFormat::GREEN . "Time set to $time on $day.");
                break;
            case "help":
                $sender->sendMessage("Times Commands Help:");
                $sender->sendMessage("- /times help (Showing all commands.)");
                $sender->sendMessage("- /times days  (Showing all days.");
                $sender->sendMessage("- /times list  (Showing all times.");
                $sender->sendMessage("- /times set <time> <day> (Set the time and day on the world.)");
                break;
            default:
                $sender->sendMessage($this->getUsage());
                break;
        }

        return true;
    }

}
