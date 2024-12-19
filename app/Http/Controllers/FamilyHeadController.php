<?php
namespace App\Http\Controllers;
use App\Http\Requests\FamilyHeadRequest;
use App\Models\FamilyHead;
use App\Models\FamilyMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class FamilyHeadController extends Controller
{
     
      protected $statesAndCities = [
        'Maharashtra' => ['Aurangabad','Mumbai', 'Pune', 'Nagpur', 'Nashik'],
            'Madhya Pradesh' => ['Indore', 'Bhopal', 'Gwalior', 'Jabalpur'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot'],
            'Delhi' => ['New Delhi', 'Dwarka', 'Janakpuri', 'Rohini']
    ];

     // Display a list of all family heads with family member count
    public function index()
      { 
          $familyHeads = FamilyHead::withCount('familyMembers') ->orderBy('created_at', 'desc')->paginate(6);
          return view('family.index', compact('familyHeads'));
      }
    // Show the form to create a new family head
    public function create()
    {
        $statesAndCities = $this->statesAndCities;
        return view('family.create_head',compact('statesAndCities'));
    }
    // Store the new family head in the database
    public function store(FamilyHeadRequest $request)
    {        
         // Prepare hobbies as a JSON array
        $hobbies = $request->hobbies ? json_encode($request->hobbies) : null;
        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {      
            $photoPath = $request->file('photo')->store('photos', 'public');              
        } 
        // Store the family head data
        $familyHead = FamilyHead::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_date' => $request->birth_date,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'marital_status' => $request->marital_status,
            'wedding_date' => $request->wedding_date,
            'hobbies' => $hobbies,
            'photo' => $photoPath,
        ]);  
        return redirect()->route('family.head.create')->with('success', 'Family head added successfully.');
    }
  
    // Display family head details along with family members
    public function show($familyHeadId)
    { 
        $familyHead = FamilyHead::findOrFail($familyHeadId);

        // Paginate family members for the specific family head
         $familyMembers = $familyHead->familyMembers()->orderBy('created_at', 'desc')->paginate(5); // 5 members per page
        return view('family.show', compact('familyHead', 'familyMembers'));
    }

    public function edit($familyHeadId){
        $familyHead = FamilyHead::findOrFail($familyHeadId);
        $statesAndCities = $this->statesAndCities;
        return view('family.edit_head', compact('familyHead','statesAndCities'));
    }

    public function update(FamilyHeadRequest $request, $id)
{
    // Find the existing family head by ID
    $familyHead = FamilyHead::findOrFail($id);

    // Prepare hobbies as a JSON array
    $hobbies = $request->hobbies ? json_encode($request->hobbies) : null;

    // Handle the photo upload (only if a new photo is uploaded)
    $photoPath = $familyHead->photo; // Default to current photo
    if ($request->hasFile('photo')) {
        // Delete the old photo if it exists
        if ($familyHead->photo) {
            Storage::disk('public')->delete($familyHead->photo);
        }
        // Store the new photo
        $photoPath = $request->file('photo')->store('photos', 'public');
    }

    $weddingDate = null;
    if ( strtolower($request->marital_status) == 'married' && $request->wedding_date) {
        $weddingDate = $request->wedding_date;
    }
    // Update the family head data
 
    $familyHead->update([
        'name' => $request->name,
        'surname' => $request->surname,
        'birth_date' => $request->birth_date,
        'mobile_no' => $request->mobile_no,
        'address' => $request->address,
        'state' => $request->state,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'marital_status' => $request->marital_status,
        'wedding_date' => $weddingDate,
        'hobbies' => $hobbies,
        'photo' => $photoPath,
    ]);

        return redirect()->route('family.head.index')->with('success', 'Family head updated successfully.');
    }
 
    public function delete($id)
    {
        // Find the family head by ID
        $familyHead = FamilyHead::findOrFail($id);
    
        // Optional: Delete the photo if it exists
        if ($familyHead->photo) {
            Storage::disk('public')->delete($familyHead->photo);
        }
    
        // Delete the family head record, cascade will handle family members
        $familyHead->delete();
    
        // Redirect with a success message
        return redirect()->route('family.head.index')->with('success', 'Family head and associated members deleted successfully.');
    
}


    //// get cities by state
    public function getCities(Request $request)
    {
        $state = $request->input('state');
        $cities = $this->statesAndCities[$state] ?? [];
        return response()->json($cities);
    }
    
}
