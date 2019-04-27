<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/26/19
 * Time: 9:47 AM
 */

namespace App\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityManager
{
    private $em;
    private $container;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    /**
     * @param $_entity_object
     * @param $_action
     * @return bool
     */
    public function save($_entity_object, $_action)
    {
        try {
            if ($_action === 'new') {
                $this->em->persist($_entity_object);
            }
        } finally {
            $this->em->flush();
        }

        return true;
    }
}