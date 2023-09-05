<?php

declare(strict_types=1);

namespace victualler\customitems\api\muqsit\invmenu\session;

use victualler\customitems\api\muqsit\invmenu\InvMenu;
use victualler\customitems\api\muqsit\invmenu\type\graphic\InvMenuGraphic;

final class InvMenuInfo{

	public function __construct(
		readonly public InvMenu $menu,
		readonly public InvMenuGraphic $graphic,
		readonly public ?string $graphic_name
	){}
}