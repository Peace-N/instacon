<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * Class InstagramMediaList
 * @package App\Http\Controllers
 * Builds an Instagram Media List Tool, Authenticates to Instagram API uses OAUth 2
 * Get access_token in a hashed string, we then compute and decode the hash in JS
 * We use file_get_contents cause its a simple get request, could be refactured
 * to Guzzle HTTP or Curl
 * @author Peace Ngara - www.github.com/Peace-N
 * @email peacengara@aol.com
 */
class InstagramMediaList extends Controller
{
    /**
     * Set Instagram Hash Initial Response Property to false
     * @var bool
     */
    public $instaPhotos;
    protected $hash = false;
    protected $instagram_callback_url;
    protected $instagram_client_Id;
    protected $instagram_client_secret;
    private   $access_token;

    /**
     * Simply Return an Authorisation Access View
     * Return Hash with Access Token Status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = [
            "hash" => $this->hash
        ];
        return view('access', $data);
    }

    /**
     * Compute Access from token - URL Hash Resolver
     * Set Hash to True if Resolved on Response
     */
    public function resolve() {
        $this->hash = true;
        $data = [
            "hash" => $this->hash
        ];
        return view('access', $data);

    }

    /**
     * Return Gallery View of User Images
     * @param $access_token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery($access_token) {
        // get env keys
        $this->access_token = $access_token;
        $this->instagram_callback_url   = env('INSTAGRAM_CALLBACK_URL');
        $this->instagram_client_Id      = env('INSTAGRAM_CLIENT_ID');
        $this->instagram_client_secret  = env('INSTAGRAM_CLIENT_SECRET');

        $baseUri = "{$this->instagram_callback_url}";
        $vars = [
            'access_token' => $this->access_token,
            'count' => 10,
        ];

        try {
            $query_string = http_build_query($vars, null, '&');
            $jsonData = json_decode((file_get_contents($baseUri . '?' . $query_string)));

            $urls = [];
            foreach ($jsonData->data as $row) {
                array_push($urls, $row->images->standard_resolution->url);
            }

            $data = [
                'urls' => $urls
            ];

            return view('list', $data);

        } catch (\Exception $e) {
            // could be logged to logger
            dd($e->getMessage());

        }

    }
}
