<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\Athlete;
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

        $entities = entity(Athlete::class)
            ->times($total)
            ->make();

        $entities->each(
            function ($item, $index) {

                $item->setStartNumber($index + 1);

                $this->em->persist($item);
            }
        );

        $this->em->flush();
    }
}
