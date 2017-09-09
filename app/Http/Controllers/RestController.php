<?php

namespace Mooncascade\Http\Controllers;

use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Serializers\JSONSerializer;

class RestController extends Controller
{
    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @var JSONSerializer
     */
    protected $serializer;

    /**
     * @var string
     */
    protected $indexGroup;

    /**
     * @var string
     */
    protected $showGroup;

    /**
     * RestController constructor.
     * @param ObjectRepository $repository
     * @param JSONSerializer $serializer
     */
    public function __construct(ObjectRepository $repository, JSONSerializer $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = $this->repository->find($id);

        // If we can't find the entity throw a 404
        abort_unless($entity, 404);

        return $this->serializer->serialize($entity, ['groups' => [$this->showGroup]]);
    }
}
