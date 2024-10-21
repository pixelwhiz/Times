<?php

namespace pixelwhiz\times\commands;

use pixelwhiz\times\math\DayRange;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class TimesCommand extends Command {

    public function __construct()
    {
        parent::__construct("times", "Set the world day and time", "Usage: /times help", []);
        $this->setPermission("times.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            switch ($args[0]) {
                case "help":
                    break;
                case "days":
                    $sender->sendMessage("Available Days: ");
                    foreach (DayRange::DAYS as $day) {
                        $sender->sendMessage("- ". $day);
                    }
                    break;
                default:
                    $sender->sendMessage($this->getUsage());
                    break;
            }
        }
    }

}