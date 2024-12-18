<?php
namespace App\Http\Controllers;
use App\Http\Requests\FamilyHeadRequest;
use App\Models\FamilyHead;
use App\Models\FamilyMember;
use Exception;
use Illuminate\Http\Request;
 
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
          $familyHeads = FamilyHead::withCount('familyMembers')->paginate(6);
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
         $familyMembers = $familyHead->familyMembers()->paginate(5); // 5 members per page
        return view('family.show', compact('familyHead', 'familyMembers'));
    }

    //// get cities by state
    public function getCities(Request $request)
    {
        $state = $request->input('state');
        $cities = $this->statesAndCities[$state] ?? [];
        return response()->json($cities);
    }
}
