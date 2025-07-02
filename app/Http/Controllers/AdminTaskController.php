<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Resources;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\AccessLevel;
use App\Models\ManualPayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminTaskController extends Controller
{
   public function calendar()
   {
      $eventCollection = Event::all();
      $events = Event::all()->map(function ($event) {
         // Assign color based on type
         $type = strtolower($event->type);
         $color = '#6c757d';
         switch ($type) {
            case 'workshop':
               $color = '#6c757d';
               break;
            case 'exhibition':
               $color = '#495057';
               break;
            case 'convention':
               $color = '#343a40';
               break;
            case 'performance':
               $color = '#032639';
               break;
         }
         return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => Carbon::parse($event->start)->toIso8601String(),
            'end' => Carbon::parse($event->end)->toIso8601String(),
            'backgroundColor' => $color,
            'allDay' => false,
            'extendedProps' => [
               'eventType' => $event->type,
               'location' => $event->location,
               'description' => $event->description,
               'instructor' => $event->instructor,
            ]
         ];
      });
      return view("admin.manage-event", compact('events', 'eventCollection'));
   }



   public function createPost(Request $request)
   {
      $user = auth()->user();

      $discussion = new Discussion();
      $discussion->title = $request->title;
      $discussion->body = $request->body;
      $discussion->user_id = $user->id;
      if ($request->hasFile('image_path')) {
         $path = $request->file('image_path')->store('uploads/discussions', 'public');
         $discussion->image_path = $path;
      }

      // dd($discussion);

      $discussion->save();

      return redirect()->back()->with('success', 'Discussion created successfully.');

   }




   public function storeEvent(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'title' => 'required|string|max:255',
         'description' => 'required|string',
         'start' => 'required|date',
         'end' => 'required|date|after_or_equal:start',
         'start_time' => 'required|string',
         'start_ampm' => 'required|in:AM,PM',
         'duration' => 'required|integer|min:1',
         'location' => 'required|string|max:255',
         'reminder' => 'nullable|string|max:255',
         'type' => 'required|string|max:50',
         'image_path' => 'nullable|string|max:255',
      ]);

      if ($validator->fails()) {
         return back()
            ->withErrors($validator)
            ->withInput();
      }

      try {
         Event::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'start_time' => $request->start_time,
            'start_ampm' => $request->start_ampm,
            'duration' => $request->duration,
            'location' => $request->location,
            'reminder' => $request->reminder,
            'type' => $request->type,
            'image_path' => $request->image_path,
         ]);

         return redirect()->route('events.index')->with('success', 'Event created successfully.');
      } catch (\Exception $e) {
         return back()->with('error', 'Something went wrong. Please try again.')->withInput();
      }
   }

   // public function showEvent(){

   // }

   public function member()
   {
      $users = User::with('accessLevel')->get();
      return view('admin.user-management', compact('users'));
   }


   // public function dashboard()
   // {

   //    return view('admin.dashboard');
   // }


   public function user()
   {
      $payments = ManualPayment::with(['user', 'accessLevel'])->latest()->paginate(7);
      return view('admin.manage-user', compact('payments'));
   }

   public function resource()
   {
      $resources = Resources::paginate(5);

      return view('admin.resource-manangement', compact('resources'));
   }


   public function communityModerator()
   {


      $discussions = Discussion::with(['user', 'comments.user', 'comments.replies.user'])
         ->orderBy('created_at', 'DESC')
         ->get();

      return view("admin.forum", compact("discussions"));
   }

}

