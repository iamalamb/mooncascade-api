<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\Team;
use Illuminate\Contracts\Config\Repository as Config;
use Doctrine\ORM\EntityManagerInterface;

class TeamsTableSeeder extends Seeder
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
     * TeamsTableSeeder constructor.
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
        $total = ($this->config->has('mooncascade.total_teams'))
            ? $this->config->get('mooncascade.total_teams')
            : 5;

        entity(Team::class)->times($total)->create();
    }
}
