<?php

namespace TEST\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TESTUserBundle extends Bundle
{
	public function getParent() {
		return 'FOSUserBundle';
	}
}
