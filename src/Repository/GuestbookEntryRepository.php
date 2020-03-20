<?php

namespace App\Repository;

use App\Entity\GuestbookEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GuestbookEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method GuestbookEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method GuestbookEntry[]    findAll()
 * @method GuestbookEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestbookEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GuestbookEntry::class);
    }

}
