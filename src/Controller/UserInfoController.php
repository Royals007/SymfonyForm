<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserInfoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserInfoController extends AbstractController
{
	/**
	 * @Route("/user/info", name="user_info")
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		$user = new User();

		#Erstellt das Formular und generieren eine URL, um die angegebenen Eingabewerte anzuzeigen
		$form = $this->createForm(UserInfoType::class, $user, [
			'action' => $this->generateUrl('user_info'),
			'method' => 'POST',

		]);

		#Response Handlung und Speichern die Datei in Mysql_DB
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			print_r($data); ## Drucken die eingabewerte als Array.
			$manager = $this->getDoctrine()->getManager();
			$manager->persist($data);
			$manager->flush();
			return new Response();
		}

		return $this->render('user_info/index.html.twig', [
			'controller_name' => 'UserInfoController',
			'form' => $form->createView(),
		]);

	}
}
