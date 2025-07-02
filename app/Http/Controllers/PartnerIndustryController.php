<?php

namespace App\Http\Controllers;

use App\Models\PartnerIndustry;
use Illuminate\Http\Request;

class PartnerIndustryController extends Controller
{
    public function index()
    {
        $members = PartnerIndustry::all();
        return view('member.membership', compact('members'));
    }
}
