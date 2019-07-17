<?php

declare(strict_types=1);

namespace EHDev\FestivalBasicsBundle\EventListener;

use Doctrine\ORM\EntityManager;
use EHDev\FestivalBasicsBundle\Entity\Festival;
use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Translation\TranslatorInterface;

abstract class AbstractFestivalDetailViewListener
{
    /** @var RequestStack */
    protected $requestStack;

    /** @var TranslatorInterface */
    protected $translator;

    /** @var EntityManager */
    protected $entityManager;

    /**
     * AbstractFestivalDetailViewListener constructor.
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack     $requestStack
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param \Doctrine\ORM\EntityManager                        $entityManager
     */
    public function __construct(
        RequestStack $requestStack,
        TranslatorInterface $translator,
        EntityManager $entityManager
    ) {
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Festival
     */
    public function getFestival()
    {
        if (!($this->requestStack->getCurrentRequest() instanceof Request)) {
            throw new BadRequestHttpException('current request does not exist');
        }

        $festival = $this->requestStack->getCurrentRequest()->get('festival');
        if ($festival instanceof Festival) {
            return $festival;
        }

        throw new MissingMandatoryParametersException('Festival not found in current request');
    }

    abstract public function onView(BeforeListRenderEvent $event);
}
