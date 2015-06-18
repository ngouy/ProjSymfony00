<?php

namespace TEST\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TEST\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{

	public function load(ObjectManager $manager)
	{
		$listNames = array('Alexandre', 'Marine', 'Anna', 'Root');

		foreach ($listNames as $name) {
			$user = new User();
			$user->setPlainPassword($name);
			$user->setUsername($name);
			if ($name != 'Root')
				$user->setRoles(array('ROLE_USER'));
			else
				$user->setRoles(array('ROLE_ADMIN'));
			$user->setEnabled(true);
			$user->setEmail($name.'@mail.test');
			$manager->persist($user);
		}
		$manager->flush();
	}

}
