<?php

namespace AdminBundle\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use AdminBundle\Entity\SystemEvent;

class AuthenticationSuccessHandler
{
    private $security;
    private $systemEventRepository;

    public function __construct(SecurityContextInterface $security, EntityRepository $systemEventRepository)
    {
        $this->security = $security;
        $this->systemEventRepository = $systemEventRepository;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $this->security->getToken()->getUser();
        $systemEvent = new SystemEvent();
        $systemEvent->setUser($user);
        $systemEvent->setName(SystemEvent::USER_LOGGED_IN_TYPE);
        $this->systemEventRepository->save($systemEvent);

        return $event;
    }

}