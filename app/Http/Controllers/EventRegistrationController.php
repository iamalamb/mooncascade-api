<?php

namespace Mooncascade\Http\Controllers;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * @var Repository
     */
    protected $cache;

    /**
     * EventRegistrationController constructor.
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
         * to ensure that the required token
         * is present and potentially valid
         */
        $rules = [
            'token' => 'required|string'
        ];

        $this->validate($request, $rules);

        /*
         * If we made it this far then perist
         * the token to cache
         */
        $token = $request->get('token');

        /*
         * Check to see if we already have a
         * cache of tokens
         */
        $tokens = ($this->cache->has('tokens')) ? $this->cache->get('tokens') : [];

        if(array_search($token, $tokens) === FALSE) {
            $tokens[] = $token;
        }

        $this->cache->put('tokens', $tokens, 120);

        return response()->json([
            'status' => true
        ]);
    }
}
