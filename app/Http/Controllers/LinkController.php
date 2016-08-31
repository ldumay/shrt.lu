<?php

namespace App\Http\Controllers;

use App\Link;
use App\Stat;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

class LinkController extends Controller
{
    // Create a new url or return the short if already created
    public function create(Request $request) {
        // Validating url
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);

        // Verifying errors
        if ($validator->fails()){
            // If errors we redirect the user to the home route with the error message
            return redirect()->route('home')->withInput()->withErrors($validator);
        } else {
            // We prepare the datas
            $url = $request->get('url');
            $slug = null;

            // Check if the url is already registrated
            $exists = Link::where('url', '=', $url);

            if ($exists->count() === 1) {
                // Get the slug if the url is find in database
                $slug = $exists->first()->slug;
            } else {
                // Insert the url in the database
                $created = Link::create([
                    'url' => $url
                ]);

                // Check if the link has been inserted
                if ($created) {
                    // Generate a new slug from the record id
                    $slug = $this->randomString();

                    // Check if slug already exist
                    $slugexists = Link::where('slug', '=', $slug);

                    while ($slugexists->count() === 1) {
                        $slug = $this->randomString();
                        $slugexists = Link::where('slug', '=', $slug);
                    }

                    // Update the record with the slug that has been generated
                    Link::where('id', '=', $created->id)->update([
                        'slug' => $slug
                    ]);
                }
            }

            if ($slug) {
                // Send the new shortened link to the user
                $data = [
                    'slug' => $slug,
                    'success' => 'Good Job! Let\'s paste your URL everywhere!'
                ];
                return redirect()->route('home')->with('success', $data['success'])->with('slug', $data['slug']);
            }
        }
        // Inform the user that something went wrong
        return redirect()->route('home')->white('warning', 'Something went wrong, try again.');
    }

    // Generate a stat element and redirect the user to the final link
    public function get($slug, Request $request){

        $clientIP = $request->ip();
        $country = Location::get($clientIP);
        $referer = parse_url($request->server('HTTP_REFERER'), PHP_URL_HOST);

        $link = Link::where('slug', '=', $slug);

        if ($link->count() === 1) {
            $stat = Stat::create([
                'slug' => $slug,
                'ip' => $clientIP,
                'country' => $country->countryCode,
                'referer' => $referer
            ]);
            return redirect($link->first()->url);
        }
        return redirect()->route('home');
    }

    // Generate a random string between 4 and 10
    public function randomString() {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $length = mt_rand(4, 10);
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        return $randomString;
    }
}
