<?php

namespace upReal\UserBundle\Entity;

/**
 * ListRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ListsRepository extends \Doctrine\ORM\EntityRepository
{
	public function findMine($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p 
                FROM URUserBundle:Lists p
                WHERE p.idUser = '. $id . '')
            ->getResult();
    }

    // Get lists of products for current User 
	public function findMineMin($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id, p.name, p.public 
                FROM URUserBundle:Lists p
                WHERE p.idUser = '. $id . ' AND (p.type = 1 OR (p.type IS NULL AND p.nbItems = 0))
                AND p.public != 2')
            ->getResult();
    }

    public function findByTypeUser($type, $id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p 
                FROM URUserBundle:Lists p
                WHERE p.idUser = '. $id . '
                AND p.type = '. $type . '')
            ->getResult();
    } 

}
