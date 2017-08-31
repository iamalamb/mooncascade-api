<?php

namespace Mooncascade\Console\Commands;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;

class SetupEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mooncascade:event:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the database for the race event';

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handlePurgeDatabase();
        $this->handleSeeding();
    }

    public function handlePurgeDatabase()
    {
        $this->info('Truncating all database tables');

        $excluded = ['migrations'];

        $connection = $this->entityManager->getConnection();
        $schemaManager = $connection->getSchemaManager();

        $tables = $schemaManager->listTables();

        $query = '';

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {

            $name = $table->getName();

            if (array_search($name, $excluded) === false) {
                $query .= 'TRUNCATE '.$name.';';
            }

        }

        $connection->executeQuery($query);
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function handleSeeding()
    {
        $this->info('Going to seed the database');

        $this->call('db:seed', [
            '--force' => true
        ]);
    }
}
