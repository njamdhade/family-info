@extends('layouts.family')

@section('content') 

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    <div class="w-full flex justify-between my-3">
        <h1 class="text-3xl font-semibold text-gray-900">Family Heads</h1>
        <a class="bg-orange-500 rounded-md hover:bg-orange-700 text-white py-2 px-3" href="{{ route('family.head.create') }}"><i class="fa fa-user-plus"></i> Add New Family Head</a> 
    </div>
    <hr class="mb-6">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
    <!-- List of Family Heads -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(count($familyHeads) > 0)
        @foreach ($familyHeads as $familyHead)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 relative">
                <div class="flex justify-center items-center bg-gray-100 h-40">
                    <a href="{{ route('family.head.edit', $familyHead->id) }}"><i class="fa fa-pencil absolute top-0 right-0 h-10 w-12 p-2 me-3"></i></a>
                    <form action="{{ route('family.head.delete', $familyHead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this family head and its members?')">
                        @csrf
                        @method('delete')
                        <button type="submit" >
                            <i class="text-danger fa fa-multiply absolute top-0 right-0 h-10 w-8 p-2"></i>
                        </button>
                    </form>
                    <!-- Placeholder for family photo -->
                    @if ($familyHead->photo)
                        <img class="h-32 w-32 object-cover rounded-full" src="{{ asset('storage/' . $familyHead->photo) }}" onerror="this.onerror=null;this.src='{{ $familyHead->photo }}';"  alt="Family Head Photo">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-white text-xl">No Image</span>
                        </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <h3 class="text-xl font-medium text-gray-800">{{ $familyHead->name }} {{ $familyHead->surname }}</h3>
                    <p class="text-gray-600 text-sm">{{ $familyHead->mobile_no }}</p>
                    <p class="text-gray-600 text-sm">{{ $familyHead->address }}</p>
                    <p class="text-gray-600 text-sm">{{ $familyHead->state }}, {{ $familyHead->city }} - {{ $familyHead->pincode }}</p>
                    
                    <!-- Display Member Count -->
                    <div class="mt-4">
                        <a href="{{ route('family.head.show', $familyHead->id) }}" class=" px-2">Total Members:  <span class="px-2 py-1 font-semibold  text-white hover:text-blue-100 font-medium text-md bg-slate-800 hover:bg-red-800 rounded-full"> {{ $familyHead->family_members_count }}</span></a>
                    </div>
                  
                </div>
            </div>
        @endforeach
@else
<h2>NO DATA FOUND</h2>
@endif
    </div>
    <div class="d-flex justify-content-center mt-5 pagination-div">
        {{ $familyHeads->links() }}
    </div>
</div>

@endsection
