@extends('layouts.family')

@section('content')
    
    
   <div class="container mb-7">
<div class="card-header  flex justify-end items-center">
    
   <a class="btn py-2 px-3 bg-cyan-700 hover:bg-cyan-500 text-white " href="{{ route('family.head.show',  $familyHead->id) }}"><i class="fa fa-users"></i> View Family Members</a>

</div>
</div> 
    <div class="container flex gap-10">
        <!-- Family Head Details -->
        <div class="card w-4/12 mb-4">
            <div class="card-header">
                <h3 class="text-xl font-medium capitalize">{{ $familyHead->name }} {{ $familyHead->surname }}'s Details</h3>
            </div>
            <div class="card-body flex gap-2 flex-column">
                <div class="flex justify-start items-start mb-6">
                    <!-- Placeholder for family photo -->
                    @if ($familyHead->photo)
                        <img class="h-32 w-32 object-cover rounded-full" src="{{ asset('storage/' . $familyHead->photo) }}"
                            alt="Family Head Photo">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-white text-xl">No Image</span>
                        </div>
                    @endif
                </div>
                <p><strong>Name:</strong> {{ $familyHead->name }} {{ $familyHead->surname }}</p>
                
                <p><strong>Mobile No:</strong> {{ $familyHead->mobile_no }}</p>
                <p><strong>Address:</strong> {{ $familyHead->address }}, {{ $familyHead->city }}, {{ $familyHead->state }},
                    {{ $familyHead->pincode }}</p>
                <p><strong>Marital Status:</strong> {{ ucfirst($familyHead->marital_status) }}</p> 
                
            </div>
        </div>


        <div class="w-8/12">
            <h1 class="text-2xl font-extrabold mb-4">Add Family Member</h2>

                <form id="memberForm" action="{{ route('family.member.store', $familyHead->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Head of Family Name*</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control">
                            @if ($errors->has('name'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <!-- Birthdate -->

                        <div class="mb-3">
                            <label for="m_birth_date" class="form-label">Birth Date*</label>
                            <input type="date" id="m_birth_date" name="m_birth_date" value="{{ old('m_birth_date') }}"
                                class="form-control">
                            @if ($errors->has('m_birth_date'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('m_birth_date') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-lg-12 mb-3 font-bold">Marital Status*</label>
                            <label for="unmarried_id" class=" mr-4 p-2 border rounded-md hover:bg-slate-200"><input type="radio" id="unmarried_id"
                                name="marital_status" value="Unmarried" checked="checked"> Unmarried</label>
                            <label for="married_id" class="p-2 border rounded-md hover:bg-slate-200"> <input type="radio" id="married_id"
                                    name="marital_status" value="Married"> Married </label>
                          
                            @if ($errors->has('marital_status'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('marital_status') }}</div>
                            @endif
                        </div>
                         

                        <div id="wedding-date-section" class="mb-3" style="display: none">
                            <label for="wedding_date" class="form-label">Wedding Date</label>
                            <input type="date" id="wedding_date" name="wedding_date" class="form-control">
                            @if ($errors->has('wedding_date'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('wedding_date') }}</div>
                            @endif
                        </div>

                        <!-- Education -->
                        <div class="mb-3">
                            <label for="education" class="form-label">Education*</label>
                            <input type="text" class="form-control" id="education" name="education"
                                value="{{ old('education') }}">
                            @error('education')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class=" mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @error('photo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Family Member</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    


        <!-- JavaScript for Handling Marital Status Dependency -->
        <script>
            $("#memberForm").on("submit", function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });

            function validateForm() {
                let isValid = true;
                $(".error-message").remove(); // Clear previous errors

                $("#memberForm").find("input, select").each(function() {
                    const input = this;
                    if ($(input).is(":visible") && !input.value.trim() && $(input).attr('type') != 'file') {
                        isValid = false;
                        ts = $(input).siblings('label').text().trim();

                        const errorMessage =
                            `<div class="alert alert-sm alert-danger py-1 error-message col-lg-12">${ts} is</div>`;
                        if ($(input).attr('name') == 'hobbies[]') {
                            $(input).parents('.hobby-field').append(errorMessage);
                        } else {
                            $(input).after(errorMessage);
                        }

                    }
                });

                return isValid;
            }
        </script>
    @endsection
