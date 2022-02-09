<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    public function saveApiData()
    {
        try {
            $response = Http::get('https://api.instantwebtools.net/v1/passenger?page=0&size=410');
            $data = $response->object();
            $records = $data->data;
            $airlines = Airline::all();
            $users = User::all();
            if ($users->isEmpty() == true && $airlines->isEmpty() == true) {
                foreach ($records as $key => $value) {
                    $user = new User();
                    $user->uuid = $value->_id;
                    $user->name = $value->name;
                    $user->save();
                    foreach ($value->airline as $row) {
                        $airline = new Airline();
                        $airline->uuid = $value->_id;
                        $airline->name = $row->name;
                        $airline->country = $row->country;
                        $airline->logo = $row->logo;
                        $airline->save();
                    }
                }
            }
            return view('record', compact('records'));
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function edit($id)
    {
        $response = Http::get('https://api.instantwebtools.net/v1/passenger/' . $id);
        $passenger = $response->object();
        return view('edit', compact('passenger'));
    }

    public function update(Request $request)
    {

        dd('sir mene postman pe update ki api ko test kiya ha jo apne di thi lakin ye error aa rha ha  message: valid passenger data must submit. baki sab sai chal rhi thi to mene unpe kaam ker diya ha');
    }

    public function delete($id)
    {
        $response = Http::delete('https://api.instantwebtools.net/v1/passenger/' . $id);
        if ($response->status() == 200) {
            return redirect()->back()->with(['message' => 'Passenger data deleted successfully.']);
        }
    }
}
