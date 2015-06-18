<?php
// src/OC/PhotoBundle/DataFixtures/ORM/LoadUser.php

namespace TEST\PhotoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TEST\PlateformBundle\Entity\Photo;

class LoadPhoto implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$listNames = array(
		'Allison',
		'Arthur',
		'Ana',
		'Alex',
		'Arlene',
		'Alberto',
		'Barry',
		'Bertha',
		'Bill',
		'Bonnie',
		'Bret',
		'Beryl',
		'Chantal',
		'Cristobal',
		'Claudette',
		'Charley',
		'Cindy',
		'Chris',
		'Dean',
		'Dolly',
		'Danny',
		'Danielle',
		'Dennis',
		'Debby',
		'Erin',
		'Edouard',
		'Erika',
		'Earl',
		'Emily',
		'Ernesto',
		'Felix',
		'Fay',
		'Fabian',
		'Frances',
		'Franklin',
		'Florence',
		'Gabielle',
		'Gustav',
		'Grace',
		'Gaston',
		'Gert',
		'Gordon',
		'Humberto',
		'Hanna',
		'Henri',
		'Hermine',
		'Harvey',
		'Helene',
		'Iris',
		'Jean',
		'Seb',
		'Lorraine');

		$listTitle = array (
		'Playful Ice',
		'The Hot Voyager',
		'Shores of Women',
		'The Dream\'s Slaves',
		'Door in the Prophecy',
		'Ravaged Winter',
		'The Burning Rainbow',
		'Rings of Servant',
		'The Slaves\'s Snake',
		'The Person of the Husband',
		'Eye in the Fire',
		'Sharp Scent',
		'The Delicious Snake',
		'Gift of Girl',
		'The Wizard\'s Servants',
		'The Emperor of the Spirit',
		'Sorcerer in the Moons',
		'The Haunted World',
		'Interstellar Castle',
		'Mortal Astronaut',
		'Dragon Woman',
		'Altered Trial',
		'Interstellar Prince',
		'Six Fear',
		'Darkness of the Plan',
		'Liquid Lover',
		'Green Money',
		'The 51st Begins',
		'The Boxer and the Circle',
		'Dark Attack',
		'phonograph',
		'mouth',
		'condemned',
		'feet',
		'homesick',
		'guilthuman',
		'like',
		'observer',
		'capture',
		'hair',
		'less',
		'energy',
		'dismemberment',
		'absolution',
		'phenomenal',
		'barbershop',
		'drifter',
		'one',
		'compulsive');

		shuffle($listTitle);

		for ( $i= 1; $i <= 48; $i++) {
			$photo= new Photo;
			$photo->setOwner($listNames[array_rand($listNames, 1)]);
			$photo->setTitle(array_pop($listTitle));
			$soc;
			if ($i >= 42)
				$soc='SCNF';
			else if ($i >= 34)
				$soc='Roland Garros STAFF';
			else if ($i >= 24)
				$soc='Evasion';
			else if ($i >= 16)
				$soc='Interflora';
			else if ($i >= 9)
				$soc='Crescendo';
			else
				$soc='24H STAFF';
			$photo->setSocietyOfOwner($soc);
			$photo->setImage('images/'.$i.'.jpg');
			$manager->persist($photo);
		}
		$manager->flush();
	}
}
