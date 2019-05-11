<?php
/**
 * Created by PhpStorm.
 * User: sweetjew
 * Date: 26.01.19
 * Time: 20:56
 */

namespace App\Modules\Authentication\Tasks;

use App\Ship\Parents\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class CallOAuthServerTask extends Task
{
    /**
     * @string
     */
    const AUTH_ROUTE = 'oauth/token';


    /**
     * @param array $data
     * @return mixed
     */
    public function run(array $data)
    {
        // Full url to the oauth token endpoint
        $authFullApiUrl = env('APP_URl') . '/' . self::AUTH_ROUTE;

        $headers = ['HTTP_ACCEPT' => 'application/json'];

        // Create and handle the oauth request
        $request = Request::create($authFullApiUrl, 'POST', $data, [], [], $headers);

        $response = App::handle($request);

        // response content as Array
        $content = \GuzzleHttp\json_decode($response->getContent(), true);

        // If the internal request to the oauth token endpoint was not successful we throw an exception

        if (!$response->isSuccessful()) {
            throw ValidationException::withMessages(['password' => $content['message']]);
        }

        return $content;
    }
}
