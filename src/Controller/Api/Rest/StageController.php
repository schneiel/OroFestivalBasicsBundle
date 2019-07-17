<?php

declare(strict_types=1);

namespace EHDev\FestivalBasicsBundle\Controller\Api\Rest;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SecurityBundle\Annotation\Acl;

/**
 * @RouteResource("stage")
 * @NamePrefix("oro_api_")
 */
class StageController extends RestController implements ClassResourceInterface
{
    /**
     * REST DELETE.
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Stage",
     *      resource=true
     * )
     * @Acl(
     *      id="ehdev_festival_stage_delete",
     *      type="entity",
     *      permission="DELETE",
     *      class="EHDevFestivalBasicsBundle:Stage"
     * )
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    public function getManager(): ApiEntityManager
    {
        $service = $this->get('ehdev.festival.stage.manager');

        if ($service instanceof ApiEntityManager) {
            return $service;
        }

        throw new ServiceNotFoundException('ehdev.festival.stage.manager');
    }

    public function getForm()
    {
        throw new \BadMethodCallException('Form is not available.');
    }

    public function getFormHandler()
    {
        throw new \BadMethodCallException('FormHandler is not available.');
    }
}
