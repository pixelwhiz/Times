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
            $sender->sendMessage(TextFormat::GRAY . "Usage: " . TextFormat::RED . $this->getUsage());
            return false;
        }

        switch ($args[0]) {
            case "days":
                $sender->sendMessage("Available Days: ");
                foreach (DayRange::DAYS as $day) {
                    $sender->sendMessage("- ". $day);
                }
                break;
            case "set":
                if (!isset($args[1]) || !isset($args[2])) {
                    $sender->sendMessage(TextFormat::RED . "Usage: /times set <time> <day>");
                    return false;
                }

                $timeFormat = $args[1];
                if (!preg_match("/^([01][0-9]|2[0-3]):[0-5][0-9]$/", $timeFormat)) {
                    throw new \InvalidArgumentException("Invalid time format. Please use HH:MM (24-hour format).");
                }
                
                $dayName = $args[2];
                $world = $sender->getWorld();
                TimeManager::setTime($world, $timeFormat, $dayName);
                $sender->sendMessage(TextFormat::GREEN . "Time set to $timeFormat on $dayName.");
                return true;

                break;
            case "help":
                $sender->sendMessage("Times Commands Help:");
                $sender->sendMessage("- /times help (Showing all commands.)");
                $sender->sendMessage("- /times days  (Showing all days.");
                $sender->sendMessage("- /times set <time> <day> (Set the time and day on the world.)");
                break;
            default:
                $sender->sendMessage($this->getUsage());
                break;
        }

        return true;
    }

}
