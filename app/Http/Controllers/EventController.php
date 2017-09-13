<?php

namespace Mooncascade\Http\Controllers;

use Artisan;
use Symfony\Component\Process\Process;

/**
 * Class EventController
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class EventController extends Controller
{

    /**
     * Intended to launch the application via
     * the browser rather than launching
     * from the console.
     */
    public function store()
    {
        $process = new Process('php /var/www/artisan mooncascade:event:execute');
        $process->run();

        return response()->json([
            'status' => true
        ]);
    }
}
