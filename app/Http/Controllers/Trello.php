<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unirest;
use Illuminate\Support\Facades\Redirect;
use App\Constant;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Session;
use Parsedown;
use App\Setting;
use Carbon\Carbon;

class Trello extends Controller
{   
    //   public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    protected $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function addBoard(Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'name' => $request->input('board'),
                'defaultLists' => 'false'
            );

            $response = Unirest\Request::post(
                'https://api.trello.com/1/boards/',
                $this->headers,
                $query
            );
            // dd($response);
            if($response->code == 200)
            {
                foreach (Constant::DEFAULT_LIST as $list) {
                    $this->addBoardList($response->body->id, $list);
                }
                return Redirect::to("board/view");
            }
        }
        return view('add-board');
    }

    public function addBugReport($isAdmin, Request $request)
    {
        $priority = Constant::PRIORITY;
        $projects = $this->getBoard();
        $listLabels = $this->listLabel($projects[0]->id);
        $priorityColor = [];
        foreach ($listLabels as $list) {
            if ($list->name == "" && $list->color == "green") {
                $priorityColor["Non Critical"] = $list->id;
            }
            else if ($list->name == "" && $list->color == "red") {
                $priorityColor["Critical"] = $list->id;
            }
            else if ($list->name == "" && $list->color == "yellow") {
                $priorityColor["Suggestions"] = $list->id;
            }
        }
        // dd($priorityColor);
        $labels = [];
        $bugType = [];
        foreach ($listLabels as $list) {
            if ($list->name == "" && $list->color != null) {
                array_push($labels, $list);
            }
            else {
                if ($list->color != null) {
                    array_push($bugType, $list);
                }
            }
        }
        if ($request->isMethod('post')) {
            request()->validate([
                'priority' => 'required',
                'reporter_name' => 'required',
            ]);
            $listId = $this->getList($request->input('project'));
            // $idLabels = implode(
            //     array_merge($request->input('label'), $request->input('bug_type'))
            // , ",");
            $description = sprintf(
'###Issue Number: %s
###Priority:
  %s
###Issue Description:
  %s
###Reported Date:
  %s
###Reporter Name:
  %s',
                $this->getIssueNumber(), $request->input('priority'), $request->input('description'), Carbon::now()->format('d-M-Y'), $request->input('reporter_name')
            );

            $client = new Client(['headers' => ['Content-Type' => 'application/x-www-form-urlencoded']]);
            $multipart = [
                [
                    'name' => 'key', 'contents' => env('TRELLO_KEY', '')
                ],
                [
                    'name' => 'token', 'contents' => env('TRELLO_TOKEN', '')
                ],
                [
                    'name' => 'idList', 'contents' => $listId[0]->id
                ],
                [
                    'name' => 'name', 'contents' => $request->input('name')
                ],
                [
                    'name' => 'idLabels', 'contents' => $priorityColor[$request->input('priority')]
                ],
                [
                    'name' => 'desc', 'contents' => $description
                ],
                /*[
                    'name' => 'due', 'contents' => $request->date
                ], */
                [
                    'name' => 'urlSource', 'contents' => $request->input('url')
                ]
            ];
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                array_push($multipart, [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'fileSource',
                    'contents' => file_get_contents($file),
                    'filename' => rand() . '.' . $file->getClientOriginalExtension(),
                ]);
            }
            $options = [
                'multipart' => $multipart
            ];
            try {
                $response = $client->post('https://api.trello.com/1/cards', $options);
                if ($response->getStatusCode() == "200") {
                    $cardDetail = json_decode($response->getBody()->getContents());
                    return Redirect::route("bug-report/view", ['user', $cardDetail->idList]);
                }
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                    $errorDetail = json_decode($response->getBody()->getContents());
                    Session::flash('message', $errorDetail->message);
                    return view('bug_report.add-bug-report', compact('projects', 'labels', 'bugType', 'priority'));
                }
            }
            return view('bug_report.add-bug-report', compact('projects', 'labels', 'bugType', 'priority'));
        }
        return view('bug_report.add-bug-report', compact('projects', 'labels', 'bugType', 'priority'));
    }

    public function getProjectLabel($projectId)
    {
        $listLabels = $this->listLabel($projectId);
        $html = '';
        foreach ($listLabels as $list) {
            if ($list->name == "" && $list->color != null) {
                $html .= sprintf('<option value="%1s">%2s</option>',$list->id, $list->color);
            }
        }
        return $html;
    }

    public function getBugType($projectId)
    {
        $html = '';
        $listLabels = $this->listLabel($projectId);
        foreach ($listLabels as $list) {
            if ($list->name != "" && $list->color != null) {
                $html .= sprintf('<option value="%1s">%2s</option>',$list->id, $list->name);
            }
        }
        return $html;
    }

    public function addCard($listId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'idList' => $listId,
                'name' => $request->input('card'),
                'desc' => $request->input('description'),
            );

            $response = Unirest\Request::post(
                'https://api.trello.com/1/cards',
                $this->headers,
                $query
            );
            if($response->code == 200)
            {
                return Redirect::route("card/view", [$listId]);
            }
        }
        return view('add-card', compact('listId'));
    }

    public function addCardDueDate($cardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'due' => $request->date
            );

            $response = Unirest\Request::put(
                'https://api.trello.com/1/cards/'.$cardId.'?'.http_build_query($query),
                $this->headers
            );

            // dd('asd');

            // dd($response);
            if($response->code == 200)
            {
                return Redirect::route("bug-report/view", ['admin', $request->input('list-id')]);
            }
        }
    }

    public function addCardAssignTo($cardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'idMembers' => $request->member
            );

            $response = Unirest\Request::put(
                'https://api.trello.com/1/cards/'.$cardId.'?'.http_build_query($query),
                $this->headers
            );

            // dd('asd');

         
            if($response->code == 200)
            {  
                return Redirect::route("bug-report/view", ['admin', $request->input('list-id')]);
            }
             // dd(123);
        }
    }

    public function addCardLabel($cardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'value' => $request->color
            );

            $response = Unirest\Request::post(
                'https://api.trello.com/1/cards/'.$cardId.'/idLabels',
                $this->headers,
                $query
            );

            // dd($response);
            if($response->code == 200)
            {
                return Redirect::route("card/view", [$request->input('list-id')]);
            }
        }
    }

    public function addList($boardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'name' => $request->input('list')
            );

            $response = Unirest\Request::post(
                'https://api.trello.com/1/boards/'.$boardId.'/lists',
                $this->headers,
                $query
            );
            if($response->code == 200)
            {
                return Redirect::route("list/view", [$boardId]);
            }
        }
        return view('add-list', compact('boardId'));
    }

    protected function addBoardList($boardId = null, $name = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', ''),
            'name' => $name
        );

        $response = Unirest\Request::post(
            'https://api.trello.com/1/boards/'.$boardId.'/lists',
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            return true;
        }
    }

    public function addLabel($boardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            // request()->validate([
            //     'name' => 'required'
            // ]);
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'name' => $request->name,
                'color' => $request->color
            );

            $response = Unirest\Request::post(
                'https://api.trello.com/1/boards/'.$boardId.'/labels',
                $this->headers,
                $query
            );

            // dd($response);
            if($response->code == 200)
            {
                return Redirect::route("label/view", [$boardId]);
            }
        }
        $colors = Constant::COLOR;
        return view('label/add-label', compact('boardId', 'colors'));
    }

    public function addMember($boardId = null, Request $request)
    {
        if ($request->isMethod('post')) {
            request()->validate([
                'email' => 'required|email'
            ]);
            $query = array(
                'key' => env('TRELLO_KEY', ''),
                'token' => env('TRELLO_TOKEN', ''),
                'email' => $request->email
            );

            $response = Unirest\Request::put(
                'https://api.trello.com/1/boards/'.$boardId.'/members?'.http_build_query($query),
                $this->headers
            );

            // dd($response);
            if($response->code == 200)
            {
                return Redirect::route("member/view", [$boardId]);
            }
        }
        return view('member/add-member', compact('boardId'));
    }

    protected function getIssueNumber()
    {
        if (Setting::where('key', 'issue_number')->exists()) {
            Setting::where('key', 'issue_number')->increment('value');
            return Setting::where('key', 'issue_number')->first()->value;
        }
        $issueNumber = Setting::create([
            'key' =>  'issue_number',
            'value' => '1',
            'status' => Constant::ACTIVE,
            'created_at' => Carbon::now()->timestamp,
            'created_by' => '0',
            'updated_at' => Carbon::now()->timestamp,
            'updated_by' => '0'
        ]);
        return $issueNumber->value;
    }

    protected function getBoard()
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/members/me/boards',
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    protected function listLabel($boardId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );

        $response = Unirest\Request::get(
            'https://api.trello.com/1/boards/'.$boardId.'/labels',
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    public function viewBoard(Request $request)
    {
        $boards = $this->getBoard();
        return view('view-board', compact('boards'));
    }

    public function viewBugReport($isAdmin, $listId = null)
    {
        $currentBoardId = Constant::getCurrentProjectID();
        $members = Constant::getMembers($currentBoardId);
        $membersMap = [];
        foreach ($members as $mem) {
            $membersMap[$mem->id] = $mem->fullName;
        }
        $currentListId = Constant::getList($currentBoardId)[0]->id;
        // dd($currentListId);
        $listId = $currentListId;
        // get all boards
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/lists/'.$listId.'/cards',
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            $boardLabels = null;
            $cards = $response->body;
            // dd($cards);
            if(!empty($cards))
            {
                $boardLabels = $this->listLabel($cards[0]->idBoard);
            }
            foreach ($cards as $key => &$card) {
                // if (!empty($card->desc)) {
                //     $parseDown = new Parsedown();
                //     $card->desc = $parseDown->text($card->desc);
                // }
                if(!empty($card->idAttachmentCover))
                {
                    $imageUrl = $this->getAttachment($card->id, $card->idAttachmentCover);
                    $card->cover_image_url = $imageUrl->url;
                }
            }
              // $str =$cards[0]->desc;
              // $str= strip_tags($str);
              // dd($str);
            $array = [];
            foreach ($cards as $key => $value) {
              $str =explode('###', $value->desc);
                $str=str_replace("\n","",$str);
                $temp = [];
                foreach ($str as $key => $value2) {
                    $secondIndex =(explode(':', $value2));
                    // var_dump($secondIndex);
                    if (isset($secondIndex[1])) {
                        // dd($secondIndex[1]);
                        array_push($temp, $secondIndex[1]);
                    }
                }
                array_push($temp, $value->idMembers);
                array_push($temp, $value->id);
                array_push($temp, $value->name);                
                array_push($array, $temp);
                $temp = [];


            }

            
            return view('bug_report.view-bug-report', compact('array','cards', 'listId', 'boardLabels', 'isAdmin', 'members', 'membersMap'));
        }
    }

    public function viewCard($listId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/lists/'.$listId.'/cards',
            $this->headers,
            $query
        );
        // dd($response);
        if($response->code == 200)
        {
            $boardLabels = null;
            $cards = $response->body;
            if(!empty($cards))
            {
                $boardLabels = $this->listLabel($cards[0]->idBoard);
            }
            foreach ($cards as $key => &$card) {
                // dd($card);
                if (!empty($card->desc)) {
                    $parseDown = new Parsedown();
                    $card->desc = $parseDown->text($card->desc);
                    // dd($card->desc);
                }
                if(!empty($card->idAttachmentCover))
                {
                    $imageUrl = $this->getAttachment($card->id, $card->idAttachmentCover);
                    $card->cover_image_url = $imageUrl->url;
                }
            }
            // dd($boardLabels);
            return view('view-card', compact('cards', 'listId', 'boardLabels'));
        }
    }

    public function viewList($boardId = null)
    {
        $lists = $this->getList($boardId);
        return view('view-list', compact('lists', 'boardId'));
    }

     protected function getAttachment($cardId = null, $idAttachmentCover = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );

        $response = Unirest\Request::get(
            'https://api.trello.com/1/cards/'.$cardId.'/attachments/'.$idAttachmentCover,
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    protected function getList($boardId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );
        $response = Unirest\Request::get(
            'https://api.trello.com/1/boards/'.$boardId.'/lists', // /members/me/boards
            $this->headers,
            $query
        );
        if($response->code == 200)
        {
            return $response->body;
        }
        return abort(404);
    }

    public function viewLabel($boardId = null)
    {
        $labels = $this->listLabel($boardId);
        return view('label/view-label', compact('labels', 'boardId'));
    }

    public function viewMember($boardId = null)
    {
        $query = array(
            'key' => env('TRELLO_KEY', ''),
            'token' => env('TRELLO_TOKEN', '')
        );

        $response = Unirest\Request::get(
            'https://api.trello.com/1/boards/'.$boardId.'/members',
            $this->headers,
            $query
        );
        // dd($response);

        if($response->code == 200)
        {
            $members = $response->body;
            return view('member/view-member', compact('members', 'boardId'));
        }
    }
}
