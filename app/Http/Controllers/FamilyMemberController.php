<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyMemberRequest;
use App\Models\FamilyHead;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    // Show the form to create a new family member
    public function create( $familyHeadId)
    {
        $familyHead = FamilyHead::findOrFail($familyHeadId);
        return view('family.create_member', compact('familyHead'));
    }

    // Store the new family member in the database
    public function store(FamilyMemberRequest $request, $familyHeadId)
    {
        // Store the family member data
        $data = $request->validated();
       
        $familyHead = FamilyHead::findOrFail($familyHeadId);

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        // Create family member record
        // FamilyMember::create($data);
        $familyHead->familyMembers()->create($data);

        return redirect()->route('family.head.show', $familyHeadId)->with('success', 'Family member added successfully.');
    }
}
