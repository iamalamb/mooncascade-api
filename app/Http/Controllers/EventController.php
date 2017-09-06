<?php

namespace Mooncascade\Http\Controllers;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @var Repository
     */
    protected $cache;

    /**
     * EventController constructor.
     * @param Repository $cache
     */
    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
}
