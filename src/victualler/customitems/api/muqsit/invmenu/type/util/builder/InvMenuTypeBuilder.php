<?php

declare(strict_types=1);

namespace victualler\customitems\api\muqsit\invmenu\type\util\builder;

use victualler\customitems\api\muqsit\invmenu\type\InvMenuType;

interface InvMenuTypeBuilder{

	public function build() : InvMenuType;
}