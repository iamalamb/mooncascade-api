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
        /*
         * First validate the request
         * to ensure that the required UUID
         * is present and potentially valid
         */
        $rules = [
            'uuid' => 'required|string|size:28'
        ];

        $this->validate($request, $rules);

        /*
         * If we made it this far then perist
         * the UUID to cache
         */
         $uuid = $request->get('uuid');

    }
}
