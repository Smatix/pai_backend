<?php

namespace App\User\Infrastructure;

use App\Shared\Infrastructure\Repository\MysqlRepository;
use App\User\Domain\User;
use App\User\Domain\UserStoreRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserStoreRepository extends MysqlRepository implements UserStoreRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, User::class);
    }

    public function findByEmail(string $email)
    {
        return $this->repository->createQueryBuilder('u')
            ->select('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function save(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }


}