<?php

declare(strict_types=1);

namespace victualler\customitems\api\muqsit\invmenu\session\network\handler;

use Closure;
use victualler\customitems\api\muqsit\invmenu\session\network\NetworkStackLatencyEntry;

interface PlayerNetworkHandler{

	public function createNetworkStackLatencyEntry(Closure $then) : NetworkStackLatencyEntry;
}