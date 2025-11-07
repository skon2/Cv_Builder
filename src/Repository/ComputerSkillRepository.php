<?php

namespace App\Repository;

use App\Entity\ComputerSkill;
use App\Entity\Cv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComputerSkill>
 *
 * @method ComputerSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComputerSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComputerSkill[]    findAll()
 * @method ComputerSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComputerSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComputerSkill::class);
    }

    /**
     * Save a computer skill entity
     */
    public function save(ComputerSkill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a computer skill entity
     */
    public function remove(ComputerSkill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find all computer skills for a specific CV
     *
     * @return ComputerSkill[]
     */
    public function findByCv(Cv $cv): array
    {
        return $this->createQueryBuilder('cs')
            ->andWhere('cs.cv = :cv')
            ->setParameter('cv', $cv)
            ->orderBy('cs.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find computer skills by level
     *
     * @return ComputerSkill[]
     */
    public function findByLevel(string $level): array
    {
        return $this->createQueryBuilder('cs')
            ->andWhere('cs.level = :level')
            ->setParameter('level', $level)
            ->orderBy('cs.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find computer skills by name (case insensitive)
     *
     * @return ComputerSkill[]
     */
    public function findByNameLike(string $name): array
    {
        return $this->createQueryBuilder('cs')
            ->andWhere('LOWER(cs.name) LIKE LOWER(:name)')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('cs.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find computer skills for a CV by level
     *
     * @return ComputerSkill[]
     */
    public function findByCvAndLevel(Cv $cv, string $level): array
    {
        return $this->createQueryBuilder('cs')
            ->andWhere('cs.cv = :cv')
            ->andWhere('cs.level = :level')
            ->setParameter('cv', $cv)
            ->setParameter('level', $level)
            ->orderBy('cs.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Count skills by level for a specific CV
     */
    public function countByLevelForCv(Cv $cv, string $level): int
    {
        return $this->createQueryBuilder('cs')
            ->select('COUNT(cs.id)')
            ->andWhere('cs.cv = :cv')
            ->andWhere('cs.level = :level')
            ->setParameter('cv', $cv)
            ->setParameter('level', $level)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get all unique skill levels
     *
     * @return string[]
     */
    public function findAllLevels(): array
    {
        $result = $this->createQueryBuilder('cs')
            ->select('DISTINCT cs.level')
            ->orderBy('cs.level', 'ASC')
            ->getQuery()
            ->getResult();

        return array_column($result, 'level');
    }

    /**
     * Find skills grouped by level for a specific CV
     *
     * @return array
     */
    public function findGroupedByLevelForCv(Cv $cv): array
    {
        $skills = $this->findByCv($cv);
        $grouped = [];

        foreach ($skills as $skill) {
            $level = $skill->getLevel();
            if (!isset($grouped[$level])) {
                $grouped[$level] = [];
            }
            $grouped[$level][] = $skill;
        }

        return $grouped;
    }
}