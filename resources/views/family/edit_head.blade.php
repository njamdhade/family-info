@extends('layouts.family')
 
@section('content')
    <div class="container">
        <div class="row max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="col-lg-7">
               
                    <div class="w-full flex justify-between my-3">
                        <h1 class="text-3xl font-semibold text-gray-900">Edit: {{ $familyHead->name .' '. $familyHead->surname  }}</h1>
                        <a class="bg-blue-500 rounded-md hover:bg-blue-700 text-white py-2 px-3" href="{{ route('family.head.index') }}"><i class="fa fa-home mr-"></i> Back to Home</a> 
                    </div>
                    <hr class="mb-6">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <form id="familyForm" action="{{ route('family.head.update', $familyHead->id) }}" method="POST" enctype="multipart/form-data"
                    class="mt-4" onsubmit="return validate()">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Head of Family Name*</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $familyHead->name) }}"
                            class="form-control">
                        @if ($errors->has('name'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname*</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname', $familyHead->surname) }}"
                            class="form-control">
                        @if ($errors->has('surname'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('surname') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Birthdate*</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $familyHead->birth_date) }}"
                            class="form-control">
                        @if ($errors->has('birth_date'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('birth_date') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number*</label>
                        <input maxlength="10" type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $familyHead->mobile_no) }}"
                            class="form-control">
                        @if ($errors->has('mobile_no'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('mobile_no') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address*</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $familyHead->address) }}"
                            class="form-control">
                        @if ($errors->has('address'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="state_edit" class="form-label">State*</label>
                        <select id="state_edit" name="state" class="form-select">
                            <option value="">Select State</option>
                            @foreach($statesAndCities as $state => $cities)
                                <option value="{{ $state }}"  {{ old('state', $familyHead->state) == $state ? 'selected' : '' }}>{{ $state }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('state'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('state') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City*</label> 
                        <select id="city" name="city" class="form-select">                            
                        </select>
                        @if ($errors->has('city'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('city') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="pincode" class="form-label">Pincode*</label>
                        <input maxlength="6" type="text" id="pincode" name="pincode" value="{{ old('pincode', $familyHead->pincode) }}"
                            class="form-control">
                        @if ($errors->has('pincode'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('pincode') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-lg-12 mb-3 font-bold">Marital Status*</label>
                        <label for="unmarried_id" class=" mr-4 p-2 border rounded-md hover:bg-slate-200">
                            <input type="radio" id="unmarried_id"
                            name="marital_status" value="Unmarried"   {{ old('marital_status', $familyHead->marital_status) == 'unmarried' ? 'checked' : '' }}> Unmarried</label>
                        <label for="married_id" class="p-2 border rounded-md hover:bg-slate-200">
                             <input type="radio" id="married_id" {{ old('marital_status', $familyHead->marital_status) == 'married' ? 'checked' : '' }}
                                name="marital_status" value="Married"> Married </label>
                      
                        @if ($errors->has('marital_status'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('marital_status') }}</div>
                        @endif
                    </div>

                    <div id="wedding-date-section" class="mb-3" style="display: none">
                        <label for="wedding_date" class="form-label">Wedding Date</label>
                        <input type="date" id="wedding_date" name="wedding_date" class="form-control" value="{{ old('wedding_date', $familyHead->wedding_date) }}"> 
                        @if ($errors->has('wedding_date'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('wedding_date') }}</div>
                        @endif
                    </div>

                        {{-- <div class="mb-3 hobby-field">
                            <label class="form-label">Hobbies*</label>
                            <input type="text" name="hobbies[]" class="form-control">
                            <button type="button" class="btn btn-primary mt-2 add-hobby-btn">+ more</button>
                            @if ($errors->has('hobbies'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('hobbies') }}</div>
                            @endif
                        </div> --}}


                        <div class="mb-3 hobby-container">
                            <label class="form-label">Hobbies<span class="text-danger">*</span></label>
                            <?php $hobbies =  $familyHead->hobbies; ?>
                            @if(!empty(old('hobbies', json_decode($hobbies, true))))
                                @foreach(old('hobbies', json_decode($hobbies, true)) as $index => $hobby)
                                    <div class="mb-3 hobby-field">
                                        <input 
                                            type="text" 
                                            name="hobbies[]" 
                                            class="form-control mt-2 w-100" 
                                            placeholder="Enter hobby" 
                                            value="{{ $hobby }}"
                                        >
                                        @if($loop->last) 
                                            <!-- If it's the last field, show the '+ more' button -->
                                            <button type="button" class="btn btn-primary mt-2 add-hobby-btn">+ more</button>
                                        @else
                                            <!-- Else show the 'Remove' button -->
                                            <button type="button" class="btn btn-danger mt-2 remove-hobby">Remove</button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-3 hobby-field">
                                    <input 
                                        type="text" 
                                        name="hobbies[]" 
                                        class="form-control mt-2 w-100" 
                                        placeholder="Enter hobby"
                                    >
                                    <button type="button" class="btn btn-primary mt-2 add-hobby-btn">+ more</button>
                                </div>
                            @endif
                        
                            @if ($errors->has('hobbies'))
                                <div class="alert alert-sm alert-danger">{{ $errors->first('hobbies') }}</div>
                            @endif
                        </div>
                        

                    <div class="mb-3">
                        <label for="photo" class="form-label">Head of Family Photo</label>
                        <div class="flex gap-5 items-center">
                            @if ($familyHead->photo)
                            <img class="h-32 w-32 object-cover rounded-full" src="{{ asset('storage/' . $familyHead->photo) }}" onerror="this.onerror=null;this.src='{{ $familyHead->photo }}';"  alt="Family Head Photo">
                        @else
                            <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-white text-xl">No Image</span>
                            </div>
                        @endif
                        <input type="file" id="photo" name="photo" class="form-control">
                    </div>
                        @if ($errors->has('photo'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('photo') }}</div>
                        @endif
                    </div>

                    <!-- Family Members Section -->
                    <div id="members-section">
                        <!-- Dynamic Family Members will be added here -->
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>
 <script>
      $("#familyForm").on("submit", function (e) {
        if (!validateForm()) {
             e.preventDefault();
        }
     }); 
function validateForm() {
    let isValid = true;
    $(".error-message").remove(); // Clear previous errors
    
    $("#familyForm").find("input, select").each(function () {
    const input = this;
    if ($(input).is(":visible") && !input.value.trim() && $(input).attr('type')!='file') {
        isValid = false;
        ts = $(input).siblings('label').text().trim();
        
        const errorMessage = `<div class="alert alert-sm alert-danger py-1 error-message col-lg-12">${ts} is required</div>`;
        if($(input).attr('name') == 'hobbies[]'){
            $(input).parents('.hobby-field').append(errorMessage);
        }else{
            $(input).after(errorMessage);
        }
    
    }
    });
    
    return isValid;
    }
    setTimeout(() => {
        $('#state_edit').trigger("change"); 
        setTimeout(() => {        
            $('#city').val("<?=$familyHead->city?>");
            $("input[name='marital_status'][value='<?=ucwords($familyHead->marital_status)?>']").prop('checked', true).trigger('change');
    
        }, 250);
    }, 100);
    

    $('#state_edit').on('change', function() {
        var state = $(this).val(); 
        if (state) {
            $.getJSON('/family/getcities', { state: state }, function(cities) {
                $('#city').empty(); // Clear previous cities
                $('#city').append('<option value="">Select City</option>'); // Add default option

                // Populate cities dropdown
                 const isSelected = city === `<?=$familyHead->city?>` ? 'selected' : ''
                
                $.each(cities, function(index, city) {
                    $('#city').append('<option value="' + city + '" ' + isSelected + '>' + city + '</option>');
                });
            });
        } else {
            $('#city').empty().append('<option value="">Select City</option>'); // Clear cities if no state is selected
        }
        
    });

    </script>
@endsection
