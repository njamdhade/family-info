@extends('layouts.family')

@section('content') 

  
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Family Head Details -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="card mb-4 w-8/12">
        <div class="card-header flex justify-between items-center">
            <h3 class="text-xl font-medium capitalize">{{ $familyHead->name }} {{ $familyHead->surname }}'s Details</h3>
            <div>
                <a class="btn py-2 px-3 bg-lime-600 hover:bg-lime-800 text-white " href="{{ route('family.member.create',  $familyHead->id) }}"><i class="fa fa-users"></i> Add New Family Member</a>
                <a class="btn ms-2 py-2 px-3 bg-blue-600 hover:bg-blue-800 text-white " href="{{ route('family.head.index') }}"><i class="fa fa-home"></i> Home</a>
            </div>
        </div>
        <div class="card-body flex gap-2 flex-column">
            <div class="flex justify-start items-start mb-6">
                <!-- Placeholder for family photo -->
                @if ($familyHead->photo)
                    <img class="h-32 w-32 object-cover rounded-full" src="{{ asset('storage/' . $familyHead->photo) }}" onerror="this.onerror=null;this.src='{{ $familyHead->photo }}';"  alt="Family Head Photo">
                @else
                    <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-white text-xl">No Image</span>
                    </div>
                @endif
            </div>
            <p><strong>Name:</strong> {{ $familyHead->name }} {{ $familyHead->surname }}</p>
            <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($familyHead->birth_date)->format('d-m-Y') }}</p>
            <p><strong>Mobile No:</strong> {{ $familyHead->mobile_no }}</p>
            <p><strong>Address:</strong> {{ $familyHead->address }}, {{ $familyHead->city }}, {{ $familyHead->state }}, {{ $familyHead->pincode }}</p>
            <p><strong>Marital Status:</strong> {{ ucfirst($familyHead->marital_status) }}</p>
            @if($familyHead->wedding_date)
            <p><strong>Wedding Date:</strong> {{ ($familyHead->wedding_date)? (\Carbon\Carbon::parse($familyHead->wedding_date)->format('d-m-Y') ?? 'N/A'):'NA' }}</p>
            @endif
            <p><strong>Hobbies:</strong> {{ implode(', ', json_decode($familyHead->hobbies)) }}</p>
        </div>
    </div>

    <!-- Family Members Table -->
    <div class="card">
        <div class="card-header">
            <h4>Family Members</h4>
        </div>
        <div class="card-body">
            @if(count($familyMembers) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Marital Status</th>
                            <th>Wedding Date</th>
                            <th>Education</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($familyMembers as $member)
                        <tr style="vertical-align:middle;">
                            <td align="center">
                                @if($member->photo)
                                    <img class="rounded rounded-2xl" src="{{ asset('storage/' . $member->photo) }}" onerror="this.onerror=null;this.src='{{ $member->photo }}';" alt="Photo" width="75" height="75">
                                @else
                                <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-white text-md text-center">No Image</span>
                                </div>
                                @endif
                            </td>
                            <td> {{ $member->name }}</td>
                            <td> {{  \Carbon\Carbon::parse($member->m_birth_date)->format('d-m-Y') }} </td>
                            <td> {{ ucfirst($member->marital_status) }}</td>
                            <td> {{ ($member->wedding_date)? (\Carbon\Carbon::parse($member->wedding_date)->format('d-m-Y') ?? 'N/A'):'N/A' }}</td>
                            <td> {{ $member->education }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center pagination-div">
                    {{ $familyMembers->links() }}
                </div>
            @else
                <p> No family members added yet. </p>
            @endif
        </div>
    </div>
</div> 


@endsection
 