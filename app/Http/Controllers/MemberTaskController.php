<?php

namespace App\Http\Controllers;

use App\Models\AccessLevel;
use App\Models\Education;
use App\Models\Experience;
use App\Models\ManualPayment;
use App\Models\Resources;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Discussion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class MemberTaskController extends Controller
{


    public function home()
    {
        $user = auth()->user();

        $auth_user = auth()->user()->load('experiences');
        $user_education = auth()->user()->load('education');
        $user_skill = auth()->user()->load('skill');

        $accessLevels = AccessLevel::all();
        $userPayments = ManualPayment::with('accessLevel', 'user')->latest()->get();

        return view("member.index", compact('user', 'auth_user', 'user_education', 'user_skill', 'accessLevels', 'userPayments'));

    }


    public function resources()
    {
        $resources = Resources::latest()->get();

        //  dd($resources);

        return view("member.resource", compact('resources'));
    }


    public function storeResources(Request $request)
    {

        // dd($request->all());


        try {
            $resourcePath = $request->file('file_path')->store('resources', 'public');
            Resources::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'category' => $request->category,
                'tags' => $request->tags,
                'file_path' => $resourcePath,

            ]);
            return redirect()->back()->with('success', 'Resource uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload. Please try again.');
        }




    }

    public function download($id)
    {
        $resource = Resources::findOrFail($id);
        return Storage::download($resource->file_path); // assumes 'file_path' is full storage path
    }



    // public function portfolio(){
    //     $user = auth()->user();

    //     $auth_user = auth()->user()->load('experiences');
    //     $user_education = auth()->user()->load('education');
    //     $user_skill = auth()->user()->load('skill');

    //     return view("member.portfolio", compact('user','auth_user','user_education','user_skill'));
    // }

    public function membership()
    {
        $accessLevels = AccessLevel::all();

        $userPayments = ManualPayment::with('accessLevel', 'user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('member.membership', compact('accessLevels', 'userPayments'));
    }

    public function portfolio()
    {
        $user = auth()->user();

        $auth_user = auth()->user()->load('experiences');
        $user_education = auth()->user()->load('education');
        $user_skill = auth()->user()->load('skill');

        $accessLevels = AccessLevel::all();
        $userPayments = ManualPayment::with('accessLevel', 'user')->latest()->get();


        return view("member.settings", compact('user', 'auth_user', 'user_education', 'user_skill', 'accessLevels', 'userPayments'));

    }


    public function storeExperience(Request $request)
    {
        $user = auth()->user();
        $experience = new Experience();
        $experience->title = $request->title;
        $experience->company = $request->company;
        $experience->start_date = $request->start_date . '-01'; // Convert 'YYYY-MM' to 'YYYY-MM-01'
        $experience->end_date = $request->end_date ? $request->end_date . '-01' : null;
        $experience->user_id = $user->id;

        $experience->save();

        return redirect()->back()->with('success', 'success');
    }

    public function educationExperience(Request $request)
    {
        $user = auth()->user();
        $education = new Education();
        $education->school = $request->school;
        $education->degree = $request->degree;
        $education->field_of_study = $request->field_of_study;
        $education->grade = $request->grade;
        $education->description = $request->description;
        $education->start_date = $request->start_date . '-01'; // Convert 'YYYY-MM' to 'YYYY-MM-01'
        $education->end_date = $request->end_date ? $request->end_date . '-01' : null;

        $education->user_id = $user->id;

        $education->save();

        return redirect()->back()->with('success', 'success');
    }

    public function storeSkill(Request $request)
    {
        Skill::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'success');
    }




    public function community()
    {

        $discussions = Discussion::with(['user', 'comments.user', 'comments.replies.user'])
            ->orderBy('created_at', 'DESC')
            ->get();


        return view("member.community", compact("discussions"));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Debug incoming request
        \Log::info('Avatar upload request:', [
            'hasFile' => $request->hasFile('avatar_url'),
            'allFiles' => $request->allFiles(),
            'allInput' => $request->all()
        ]);

        // Validation
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'contact' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'avatar_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
            'portfolio_url' => 'nullable|url|max:255',
        ]);

        // Fill basic info
        $user->fname = $validated['fname'];
        $user->lname = $validated['lname'];
        $user->username = $validated['username'];
        $user->contact = $validated['contact'];
        $user->email = $validated['email'];
        $user->portfolio_url = $validated['portfolio_url'] ?? null;

        // Password (optional update)
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Avatar upload (optional)
        if ($request->hasFile('avatar_url')) {
            try {
                $path = $request->file('avatar_url')->store('avatars', 'public');
                \Log::info('File stored at path: ' . $path);
                $user->avatar_url = $path;
            } catch (\Exception $e) {
                \Log::error('Error storing avatar: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error uploading avatar: ' . $e->getMessage());
            }
        }

        try {
            $user->save();
            \Log::info('User saved successfully', ['user_id' => $user->id, 'avatar_url' => $user->avatar_url]);
        } catch (\Exception $e) {
            \Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error saving profile: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function storeMembershipPayment(Request $request)
    {
        $validated = $request->validate([
            'access_level_id' => 'required|exists:access_levels,id',
            'reference_number' => 'nullable|string|max:255',
            'screenshot' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // dd($request->all());

        try {
            $screenshotPath = $request->file('screenshot')->store('manual_payments', 'public');
            ManualPayment::create([
                'user_id' => auth()->id(),
                'access_level_id' => $validated['access_level_id'],
                'reference_number' => $validated['reference_number'],
                'screenshot_path' => $screenshotPath,
                'status' => 'pending',
            ]);
            return redirect()->back()->with('success', 'Payment submitted for verification.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit payment. Please try again.');
        }
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        $user_education = $user->load(['experiences', 'education', 'skill']);

        return view('results.profile', compact('user', 'user_education'));
    }

}
