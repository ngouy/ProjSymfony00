<?php

namespace TEST\PlateformBundle\Controller;

use TEST\PlateformBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFOundation\Request;
use Symfony\Component\HttpFOundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class PhotoController extends Controller
{
	public function viewAction()
	{
		$db = $this
			->getDoctrine()
			->getManager()
			->getRepository('TESTPlateformBundle:Photo')
		;
		$ph_tab = $db->findAll();
		$all_photos=array();
		foreach ($ph_tab as $photo) {
			if (!array_key_exists($photo->getSocietyOfOwner(), $all_photos))
				$all_photos[$photo->getSocietyOfOwner()] = array();
			array_push($all_photos[$photo->getSocietyOfOwner()], $photo);
			}
		$contenu = $this
			->render('TESTPlateformBundle:Photo:index.html.twig', array(
			'all_photos' => $all_photos)
			);
		return $contenu;
	}

	/**
	 * @Security("has_role('ROLE_ADMIN')")
	 */
	public function add_photo_formularAction(Request $request)
	{
		$photo = new Photo;
		$formBuilder = $this
			->get('form.factory')
			->createBuilder('form', $photo)
		;

		$formBuilder
			->add('owner',			'text')
			->add('title',			'text')
			->add('societyOfOwner',	'text')
			->add('image',			'file')
			->add('save',			'submit')
		;

		$photo->setDateAdded();
		$form = $formBuilder->getForm();

		$form->handleRequest($request);

		if ($form->isValid()) {
			$ext = $form['image']
				->getData()
				->guessExtension()
			;
			$size = $form['image']
				->getData()
				->getSize()
			;
			if (($ext != 'pdf' && $ext != 'png') || $size > 1048576) {
				$this
					->get('session')
					->getFlashBag()
					->add('notice',
						  'wrong extension('.$ext.
						  ') or file too much heavy('.$size.
						  'ko, max(1Mo)).')
				;
			}
			else {
				do {
					$name = rand(1, 99999).'.'.$ext; }
				while (file_exists(getcwd().'/images/'.$name));
				$photo->setImage('/images/'.$name);
				$form['image']
					->getData()
					->move(getcwd().'/images/', $name)
				;
				$em = $this
					->getDoctrine()
					->getManager()
				;
				$em->persist($photo);
				$em->flush();
				$request
					->getSession()
					->getFlashBag()
					->add('info', 'Photo uploaded')
				;
				return $this->redirect(
				$this
				->generateUrl('test_plateform_view_one', array(
				'society_name'	=> $photo->getSocietyOfOwner(),
				'title'			=> $photo->getTitle(),
				'ext'			=> 'pdf',
				'id'			=> $photo->getId())
				));
			}
		}
	//if we are here, the data isn't valid or its the user just arrived on the formular
	return $this->render('TESTPlateformBundle:Photo:add_photo_formular.html.twig', array(
		'form' => $form->createView())
		);
	}

	public function view_one_photoAction()
	{
		$id = $_GET['id'];
		$db = $this
			->getDoctrine()
			->getManager()
			->getRepository('TESTPlateformBundle:Photo')
		;
		$photo = $db->find($id);
		$content = $this->render('TESTPlateformBundle:Photo:view_one_photo.html.twig', array('photo' => $photo));
		return $content;
	}
}
