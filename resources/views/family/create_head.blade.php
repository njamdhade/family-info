@extends('layouts.family')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
               
                    <div class="w-full flex justify-between my-3">
                        <h1 class="text-3xl font-semibold text-gray-900">Add New Family Head</h1>
                        <a class="bg-blue-500 rounded-md hover:bg-blue-700 text-white py-2 px-3" href="{{ route('family.head.index') }}"><i class="fa fa-home mr-"></i> Back to Home</a> 
                    </div>
                    <hr class="mb-6">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <form id="familyForm" action="{{ route('family.head.store') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4" onsubmit="return validate()">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Head of Family Name*</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control">
                        @if ($errors->has('name'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname*</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname') }}"
                            class="form-control">
                        @if ($errors->has('surname'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('surname') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Birthdate*</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                            class="form-control">
                        @if ($errors->has('birth_date'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('birth_date') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number*</label>
                        <input maxlength="10" type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}"
                            class="form-control">
                        @if ($errors->has('mobile_no'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('mobile_no') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address*</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="form-control">
                        @if ($errors->has('address'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="state" class="form-label">State*</label>
                        <select id="state" name="state" class="form-select">
                            <option value="">Select State</option>
                            @foreach($statesAndCities as $state => $cities)
                                <option value="{{ $state }}">{{ $state }}</option>
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
                        <input maxlength="6" type="text" id="pincode" name="pincode" value="{{ old('pincode') }}"
                            class="form-control">
                        @if ($errors->has('pincode'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('pincode') }}</div>
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

                    <div class="mb-3 hobby-field">
                        <label class="form-label">Hobbies*</label>
                        <input type="text" name="hobbies[]" class="form-control">
                        <button type="button" class="btn btn-primary mt-2 add-hobby-btn">Add Hobby</button>
                        @if ($errors->has('hobbies'))
                            <div class="alert alert-sm alert-danger">{{ $errors->first('hobbies') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Head of Family Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control">
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


    </script>
@endsection
