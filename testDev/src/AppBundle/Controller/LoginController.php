<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Login;
use AppBundle\Entity\Demande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class LoginController extends Controller
{
    /**
     * @Route("/", name="connexion")
     */
    public function connexionAction(Request $request)
    {
        // On crée un objet Login
		$login = new Login();

		// On crée le FormBuilder grâce au service form factory
		$form = $this->get('form.factory')->createBuilder(FormType::class, $login)
			->add('identifiant',     TextType::class)
			->add('mdp',   PasswordType::class)
			->add('save',      SubmitType::class)
			->getForm()
		;

		// Si le formulaire vient d'être soumis
		if ($request->isMethod('POST')) {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $login contient les valeurs entrées dans le formulaire par le visiteur
			$form->handleRequest($request);

			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On regarde si un enregistrement en base contient les 2 valeurs
				$repository = $this
					->getDoctrine()
					->getManager()
					->getRepository('AppBundle:Login')
				;
				$login_id = $repository->findOneBy(array('identifiant' => $login->getIdentifiant(), 'mdp' => $login->getMdp()));
				
				if($login_id != null){
					// On redirige vers la page de visualisation de l'annonce nouvellement créée
					return $this->redirectToRoute('formulaire');
				}
			}
		}
		
		// On passe la méthode createView() du formulaire à la vue
		// afin qu'elle puisse afficher le formulaire toute seule
		return $this->render('index.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	/**
     * @Route("/formulaire", name="formulaire")
     */
    public function formAction(Request $request)
    {
		//création de la nouvelle demande
		$demande = new Demande();
		// On crée le FormBuilder grâce au service form factory
		$form = $this->get('form.factory')->createBuilder(FormType::class, $demande)
			->add('nom',     TextType::class)
			->add('prenom',   TextType::class)
			->add('email',   EmailType::class)
			->add('telephone',   TextType::class)
			->add('message',   TextareaType::class)
			->add('save',      SubmitType::class)
			->getForm()
		;
		
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);
			/*ini_set('SMTP', 'smtp.free.fr');
			ini_set('smtp_port', '465');
			ini_set('sendmail_from', 'a.perrachon@free.fr');*/
			if ($form->isValid()) {
				// on envoie le contenu du form au template du mail
				/*$transport = \Swift_MailTransport::newInstance();
				$mailer = \Swift_Mailer::newInstance($transport);
				$email_envoye = \Swift_Message::newInstance()
				->setSubject('Votre mail depuis ma plateforme')
				->setFrom($form->get('email')->getData())
				->setTo($this->getParameter('mail_envoi'))
				->setBody(
					$this->renderView(
						'email.html.twig',
						array('nom' => $form->get('nom')->getData(),
							'prenom' => $form->get('prenom')->getData(),
							'email' => $form->get('email')->getData(),
							'telephone' => $form->get('telephone')->getData(),
							'message' => $form->get('message')->getData(),
						)
					),
					'text/html'
				);
				if ($mailer->send($email_envoye)){*/
					return $this->render('envoi_reussi.html.twig',
						array('nom' => $form->get('nom')->getData(),
							'prenom' => $form->get('prenom')->getData(),
							'email' => $form->get('email')->getData(),
							'telephone' => $form->get('telephone')->getData(),
							'message' => $form->get('message')->getData(),
						));
				/*}*/
			}
		}
		
		return $this->render('form.html.twig', array(
			'form' => $form->createView(),
		));
	}
}
