<?php

namespace Pie;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."banned-players.txt", Config::ENUM, array());
		$this->config->save();
		$this->getServer()->getLogger()->info("[SecureBan]Loaded!");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
	$cfg = $this->config;
 	if(strtolower($cmd->getName()) === "uuidban"){
            if(isset($args[0])){
                $name = $args[0];
                $target = $this->getServer()->getPlayer($name);
                if($sender instanceof Player){
                if($args[0] === null){
                $sender->sendMessage("Please do /uuidban (player name)");
                return false;
                
                }
                
                if($target === null){
                	$sender->sendMessage("That player is not online!");
                	return false;
                	
                }
                
                $cfg->set($target->getName(),$target->getClientSecret());
                $sender->sendMessage($target->getName()." Has been client banned!");
                $target->close("","You have been client banned!");
                $cfg->save();
                return true;
                
                }
                
                }
                }
                
                }
                
                public function onJoin(PlayerJoinEvent $ev){
                $p = $ev->getPlayer();
                $cfg = $this->config;
                if($cfg->exists($p->getClientSecret())){
                $p->close("","You have been client banned!");
                
                }
                }
}
