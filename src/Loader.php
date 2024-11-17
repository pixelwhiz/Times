<?php

declare(strict_types=1);

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


namespace pixelwhiz\times;

use pixelwhiz\times\commands\TimesCommand;
use pixelwhiz\times\handlers\EventHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase {

    private const CONFIG_VERSION = 2.0;

    public array $useClock = [];

    protected function onEnable(): void
    {
        Server::getInstance()->getPluginManager()->registerEvents(new EventHandler($this), $this);
        Server::getInstance()->getCommandMap()->register("times", new TimesCommand($this));
        $this->checkConfig();
    }

    public function checkConfig(): void {
        $this->saveDefaultConfig();

        $config = $this->getConfig();
        if (!$config->exists("config-version") and $config->get("config-version") !== self::CONFIG_VERSION) {
            $this->getLogger()->warning('An outdated config was provided, Please install new version at https://poggit.pmmp.io/ci/pixelwhiz/Times/');
            $configFile = $this->getDataFolder() . 'config.yml';
            $newConfigFile = $this->getDataFolder() . 'config.old.yml';

            if (!rename($configFile, $newConfigFile)) {
                $this->getLogger()->critical('An unknown error occurred while attempting to generate the new config');
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }

            $this->reloadConfig();
        }
    }

}
