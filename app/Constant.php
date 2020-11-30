<?php

namespace App;
use Unirest;

class Constant {
    const HEADERS = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );
    const ACTIVE = 1;
    const INACTIVE = -1;
	const COLOR = [
        'blue',
        'green',
        'orange',
        'purple',
        'red',
        'yellow',
        'sky',
        'lime',
        'pink',
        'black'
    ];

    const DEFAULT_LIST = [
        'Completed',
        'In testing',
        'In progress',
        'New Issues'
    ];

    const PRIORITY = [
        'Critical',
        'Non Critical',
        'Suggestions'
    ];

    public static function getCurrentProjectID()
    {
        return Constant::getBoard()[0]->id;
    }

    protected static function getBoard()
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/members/me/boards',
            Constant::HEADERS,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    public static function getList($boardId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/boards/'.$boardId.'/lists', // /members/me/boards
            Constant::HEADERS,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    public static function getMembers($boardId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );

        $response = Unirest\Request::get(
            'https://api.trello.com/1/boards/'.$boardId.'/members',
            Constant::HEADERS,
            $query
        );
        // dd($response);

        if($response->code == 200)
        {
            return $response->body;
        }
    }
}