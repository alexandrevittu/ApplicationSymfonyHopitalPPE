<?php
namespace gestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
      $authenticationUtils = $this->get('security.authentication_utils');

      $error = $authenticationUtils->getLastAuthenticationError();

      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('gestionBundle:Security:login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
  }
}
 ?>
