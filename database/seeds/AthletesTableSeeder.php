<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\Athlete;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UsersTableSeeder
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthletesTableSeeder extends Seeder
{
    /**
     * Entity manager to be injected for persistance
     *
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AthletesTableSeeder constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entities = entity(Athlete::class)
            ->times(25)
            ->make();

        $entities->each(function ($item, $index) {

            $item->setStartNumber($index + 1);

            $this->em->persist($item);

        });

        $this->em->flush();
    }
}
