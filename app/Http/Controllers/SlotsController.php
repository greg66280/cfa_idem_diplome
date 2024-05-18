<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Carbon
use Carbon\Carbon;

// Custom models
use App\Models\Slots;
use App\Models\User;

class SlotsController extends Controller
{
    protected function add_slot(Request $request) {
        $request->validate([
            "start" => "required",
            "end" => "required"
        ]);
        
        $datas = $request->all();

        $start = Carbon::parse($datas["start"])->setTimezone("Europe/Paris");
        $end = Carbon::parse($datas["end"])->setTimezone("Europe/Paris");

        try {
            Slots::create([
                "user_uid" => auth()->user()->id,
                "start" => $start,
                "end" => $end
            ]);

            return response()->json(["error" => false]);
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }
    }

    protected function remove_slot(Request $request) {
        $slot = Slots::find($request->id);

        try {
            $slot->delete();
            return response()->json(["error" => false]);
        } catch (\Exception $e) {
            return response()->json(["error" => true]);
        }
    }

    protected function take_slot(Request $request) {
        $slot = Slots::find($request->id);

        try {
            $slot->update([
                "taked_by" => auth()->user()->id
            ]);
            return response()->json(["error" => false]);
        } catch (\Exception $e) {
            return response()->json(["error" => true]);
        }
    }

    protected function allEvents() {
        if (auth()->user()->admin === 1) {
            $allEvents = Slots::all()->map(function($slot) {
                if ($slot->taked_by !== null) {
                    $slot->title = "Pris par " . User::find($slot->taked_by)->name;
                    $slot->backgroundColor = "#FF0000";
                }
                return $slot;
            });
        } else {
            $allEvents = Slots::where("taked_by", null)->map(function($slot) {
                if ($slot->taked_by !== null) {
                    $slot->title = "Pris par " . User::find($slot->taked_by)->name;
                    $slot->backgroundColor = "#FF0000";
                }
                return $slot;
            });
        }


        return response()->json($allEvents);
    }
}
