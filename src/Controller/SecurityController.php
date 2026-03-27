<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends BaseController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils  $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \Exception('logout() should never be reached');
    }

    #[Route('/authentication/2fa/enable', name:'app_2fa_enable')]
    #[IsGranted("ROLE_USER")]
    public function enable2fa(TotpAuthenticatorInterface $totpAuthenticator, EntityManagerInterface $entityManager)
    {
        $user= $this->getUser();
        if (!$user->isTotpAuthenticationEnabled()){
            $user->setTotpSecret($totpAuthenticator->generateSecret());
            $entityManager->flush();
        }
        return $this->render('security/enable2fa.html.twig');
        }

        #[Route('/authentication/2fa/qr-code', name: 'app_qr_code')]
        #[IsGranted("ROLE_USER")]
        public function displayGoogleAuthenticatorQrCode(TotpAuthenticatorInterface $totpAuthenticator): Response
        {
            $qrCodeContent = $totpAuthenticator->getQRContent($this->getUser());
            $writer = new PngWriter();
            $qrCode = new QrCode($qrCodeContent);
            $result = $writer->write($qrCode);

            return new QrCodeResponse($result);
        }
}

