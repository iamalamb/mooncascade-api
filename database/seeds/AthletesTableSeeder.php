<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\Athlete;
use Mooncascade\Entities\Gender;
use Mooncascade\Entities\Team;
use Illuminate\Contracts\Config\Repository as Config;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UsersTableSeeder
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthletesTableSeeder extends Seeder
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * Entity manager to be injected for persistance
     *
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AthletesTableSeeder constructor.
     * @param Config $config
     * @param EntityManagerInterface $em
     */
    public function __construct(Config $config, EntityManagerInterface $em)
    {
        $this->config = $config;
        $this->em = $em;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = ($this->config->has('mooncascade.athlete.total'))
            ? $this->config->get('mooncascade.athlete.total')
            : 25;

        $maxAge = ($this->config->has('mooncascade.athlete.age.max'))
            ? $this->config->get('mooncascade.athlete.age.max')
            : 75;

        $minAge = ($this->config->has('mooncascade.athlete.age.min'))
            ? $this->config->get('mooncascade.athlete.age.min')
            : 18;

        $entities = entity(Athlete::class)
            ->times($total)
            ->make(
                [
                    'max_age' => $maxAge,
                    'min_age' => $minAge,
                ]
            );

        $entities->each(
            function ($item, $index) {

                $gender = $this->em->getRepository(Gender::class)->findOneByRandom();
                $team = $this->em->getRepository(Team::class)->findOneByRandom();

                $item
                    ->setStartNumber($index + 1)
                    ->setGender($gender)
                    ->setTeam($team);

                $this->em->persist($item);
            }
        );

        $this->em->flush();
    }
}
