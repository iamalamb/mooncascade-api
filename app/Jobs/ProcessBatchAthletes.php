<?php

namespace Mooncascade\Jobs;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

class ProcessBatchAthletes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var BatchEntityCollectionHandler
     */
    protected $batchEntityCollectionHandler;

    /**
     * @var Collection
     */
    protected $entities;



    /**
     * ProcessBatchAthletes constructor.
     * @param BatchEntityCollectionHandler $batchEntityCollectionHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        BatchEntityCollectionHandler $batchEntityCollectionHandler,
        EntityManagerInterface $entityManager
    ) {
        $this->batchEntityCollectionHandler = $batchEntityCollectionHandler;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }

    /**
     * @param Collection $entities
     * @return ProcessBatchAthletes
     */
    public function setEntities(Collection $entities): ProcessBatchAthletes
    {
        $this->entities = $entities;

        return $this;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
