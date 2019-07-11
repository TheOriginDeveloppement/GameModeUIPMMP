<?php

namespace Cmd;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "On");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "Off");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "gm":
                if ($sender->hasPermission("gm.cmd")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->setGameMode(0);
            $sender->sendMessage("§aGameMode changed to §9Survival");
                break;
                    
                case 1:
                $sender->setGameMode(1);
                $sender->sendMessage("§aGameMode changed to §9Creative");
                break;
                case 2:
                $sender->setGameMode(2);
                $sender->sendMessage("§aGameMode changed to §9Adventure");
                break;
                case 3:
                $sender->setGameMode(3);
                $sender->sendMessage("§aGameMode changed to §9Spectator");
                break;
            }
            
            
            });
            $form->setTitle("§9GameMode");
            $form->addButton("Survival");
            $form->addButton("Creative");
            $form->addButton("Adventure");
            $form->addButton("Spectator");
            $form->addButton("Back");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}