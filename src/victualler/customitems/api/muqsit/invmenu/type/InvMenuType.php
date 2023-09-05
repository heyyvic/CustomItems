<?php

declare(strict_types=1);

namespace victualler\customitems\api\muqsit\invmenu\type;

use victualler\customitems\api\muqsit\invmenu\InvMenu;
use victualler\customitems\api\muqsit\invmenu\type\graphic\InvMenuGraphic;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

interface InvMenuType{

	public function createGraphic(InvMenu $menu, Player $player) : ?InvMenuGraphic;

	public function createInventory() : Inventory;
}