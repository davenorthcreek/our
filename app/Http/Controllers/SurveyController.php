<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respondent;
use App\Notifications\NewRespondentGiven;

class SurveyController extends Controller
{
    public function result(Request $request)
    {
        $respondent = Respondent::create([
            'name'  => $request->name,
            'email' => $request->email,
            'isp'   => $request->isp,
            'satisfaction' => $request->satisfaction,
            'lat'   => $request->lat,
            'long'  => $request->long
        ]);

        $this->notify('Dave Block', 'dave@northcreek.ca', $respondent);
        $data['resp'] = $respondent;
        return view('about')->with($data);
    }

    public function viewResponse($id)
    {
        $respondent = Respondent::find($id);
        $data['resp'] = $respondent;
        return view('response')->with($data);
    }

    public function viewAllResponses()
    {
        $data['responses'] = Respondent::all();
        $data['lastResponse'] = Respondent::orderBy('created_at', 'desc')->first();
        return view('all')->with($data);
    }

    public function survey()
    {
        $data['responses'] = Respondent::all();
        return view('survey')->with($data);
    }

    public function about()
    {
        $data['responses'] = Respondent::all();
        return view('about')->with($data);
    }

    public function notify($name, $email, $respondent)
    {
        $user = new \App\User([
            'name' => $name,
            'email' => $email
        ]);
        $user->notify(new NewRespondentGiven($respondent));
    }
}
