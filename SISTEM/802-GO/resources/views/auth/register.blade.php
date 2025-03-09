<title>802-GO: Register</title>
<link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

<style>
    .required-label::after {
        content: " *";
        color: red;
    }

    /* Modal Styles */
    .modal {
    display: none; /* Ensure the modal is hidden on page load */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content {
    background: white; /* ✅ Set modal background to white */
    padding: 20px;
    border-radius: 8px; /* ✅ Rounded corners */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* ✅ Subtle shadow */
    width: 90%;
    max-width: 400px; /* ✅ Restrict max width */
    text-align: center;
}

/* Modal Buttons */
.modal-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

#cancelButton, #proceedButton {
    flex: 1;
    margin: 5px;
    padding: 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

#cancelButton {
    background-color: #6b7280; /* ✅ Gray */
    color: white;
}

#proceedButton {
    background-color: #10b981; /* ✅ Green */
    color: white;
}

</style>

<div style="background-color:#f3f4f6">
    <p style="opacity:0%">Fill out the form to create a new account</p>
</div>

<div style="background-color:#f3f4f6">
    <p style="opacity:0%">Fill out the form to create a new account</p>
</div>

<x-guest-layout>
    <div class="my-8">
        <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> 
            @csrf


            <!-- Login Heading -->
            <div class="mt-6 mb-4 text-center text-lg font-semibold text-gray-700 dark:text-gray-300">
                {{ __('Register to your account') }}
            </div>

            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')" class="required-label"/>
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Middle Name -->
            <div class="mt-4">
                <x-input-label for="middle_name" :value="__('Middle Name')"/>
                <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autocomplete="middle_name" />
                <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-input-label for="last_name" :value="__('Last Name')" class="required-label"/>
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" class="required-label"/>
                <select id="gender" name="gender" class="block mt-1 w-full" required>
                    <option value="">{{ __('Select Gender') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="other">{{ __('Other') }}</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Age -->
            <div class="mt-4">
                <x-input-label for="age" :value="__('Age')" class="required-label"/>
                <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required />
                <x-input-error :messages="$errors->get('age')" class="mt-2" />
            </div>

            <!-- Birthdate -->
            <div class="mt-4">
                <x-input-label for="birthdate" :value="__('Birthdate')" class="required-label"/>
                <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <!-- Permanent Address -->
            <div class="mt-4">
                <x-input-label for="block_street" :value="__('Block/Street')" class="required-label"/>
                <x-text-input id="block_street" class="block mt-1 w-full" type="text" name="block_street" :value="old('block_street')" required />
                <x-input-error :messages="$errors->get('block_street')" class="mt-2" />
            </div>

            <!-- Barangay -->
<div class="mt-4">
    <x-input-label for="barangay" :value="__('Barangay')" class="required-label"/>
    <select id="barangay" name="barangay" class="block mt-1 w-full" required>
        <option value="Barangay 802" selected>Barangay 802</option>
    </select>
    <x-input-error :messages="$errors->get('barangay')" class="mt-2" />
</div>

<!-- District -->
<div class="mt-4">
    <x-input-label for="district" :value="__('District')" class="required-label"/>
    <select id="district" name="district" class="block mt-1 w-full" required>
        <option value="Sta Ana" selected>Sta Ana</option>
    </select>
    <x-input-error :messages="$errors->get('district')" class="mt-2" />
</div>

<!-- City -->
<div class="mt-4">
    <x-input-label for="city" :value="__('City')" class="required-label"/>
    <select id="city" name="city" class="block mt-1 w-full" required>
        <option value="Manila" selected>Manila</option>
    </select>
    <x-input-error :messages="$errors->get('city')" class="mt-2" />
</div>


            <!-- Civil Status -->
            <div class="mt-4">
                <x-input-label for="civil_status" :value="__('Civil Status')" class="required-label"/>
                <select id="civil_status" name="civil_status" class="block mt-1 w-full" required>
                    <option value="">{{ __('Select Status') }}</option>
                    <option value="single">{{ __('Single') }}</option>
                    <option value="married">{{ __('Married') }}</option>
                    <option value="widowed">{{ __('Widowed') }}</option>
                    <option value="divorced">{{ __('Divorced') }}</option>
                </select>
                <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />
            </div>

            <!-- Religion -->
            <div class="mt-4">
                <x-input-label for="religion" :value="__('Religion')" class="required-label"/>
                <x-text-input id="religion" class="block mt-1 w-full" type="text" name="religion" :value="old('religion')" />
                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
            </div>

            <!-- Valid ID Attachment with Preview -->
            <div class="mt-4">
                <x-input-label for="valid_id" :value="__('Valid ID (jpg or png)')" class="required-label"/>
                <x-text-input id="valid_id" class="block mt-1 w-full" type="file" name="valid_id" accept=".jpg, .jpeg, .png" required />
                <x-input-error :messages="$errors->get('valid_id')" class="mt-2" />

                <!-- Image Preview -->
                <img id="id_preview" class="mt-4 max-w-xs rounded-lg" src="#" alt="ID preview" style="display: none;" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email Address')" class="required-label"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="required-label"/>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="required-label"/>
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->
            <div class="flex justify-between mt-6">
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Already registered?') }}
                    </a>
                </div>
                <div>
                <x-primary-button id="registerButton">
                    {{ __('Register') }}
                </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

<div style="background-color:#f3f4f6">
    <p style="opacity:0%">Fill out the form to create a new account</p>
</div>

<div style="background-color:#f3f4f6">
    <p style="opacity:0%">Fill out the form to create a new account</p>
</div>

<!-- Privacy Policy Modal -->
<div id="privacyModal" class="modal">
<div class="modal-content">
        <h2 style="font-size: 1.5rem; font-weight: bold; text-align: center;">Data Privacy Policy</h2>
        <p style="text-align: justify; margin-top: 10px;">
            By proceeding with registration, you acknowledge and agree to the following terms regarding the collection and use of your personal data:
        </p>
        
        <ul style="text-align: justify; margin-top: 10px; padding-left: 20px; list-style-type: disc;">
            <li>Your data will be used solely for registration and identification.</li>
            <li>We do not share your personal data without your consent.</li>
            <li>You can request access or deletion of your data at any time.</li>
        </ul>


        <!-- Checkbox for agreement -->
        <div class="modal-buttons" style="margin-top: 15px; display: flex; justify-content: center; align-items: center;">
            <input type="checkbox" id="agreeCheckbox" style="margin-right: 6px; width: 16px; height: 16px;">
            <label for="agreeCheckbox" style="font-size: 0.9rem;"><b>I have read and agree to the Data Privacy Policy</b></label>
        </div>




        <div class="modal-buttons">
            <button id="cancelButton" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            <button id="proceedButton" class="px-4 py-2 text-white rounded" style="background-color: #6b7280;" disabled>Proceed</button>
        </div>
    </div>
</div>

<script>
    // Get elements
    const registerButton = document.getElementById("registerButton");
    const privacyModal = document.getElementById("privacyModal");
    const cancelButton = document.getElementById("cancelButton");
    const proceedButton = document.getElementById("proceedButton");
    const registerForm = document.getElementById("registerForm");
    const agreeCheckbox = document.getElementById("agreeCheckbox");

    // Ensure modal is hidden on page load
    document.addEventListener("DOMContentLoaded", function() {
        privacyModal.style.display = "none"; 
    });

    // Show modal when Register button is clicked
    registerButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form from submitting immediately
        privacyModal.style.display = "flex"; 
    });

    // Close modal on Cancel
    cancelButton.addEventListener("click", function() {
        privacyModal.style.display = "none";
    });

    // Enable Proceed button when checkbox is checked
    agreeCheckbox.addEventListener("change", function() {
        if (this.checked) {
            proceedButton.style.backgroundColor = "#11468F"; // Change to blue
            proceedButton.disabled = false;
        } else {
            proceedButton.style.backgroundColor = "#6b7280"; // Keep it gray
            proceedButton.disabled = true;
        }
    });

    // Proceed with form submission
    proceedButton.addEventListener("click", function() {
        registerForm.submit(); // Submit the form after accepting privacy policy
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target === privacyModal) {
            privacyModal.style.display = "none";
        }
    });
</script>

<script>
    // Get elements
    const registerButton = document.getElementById("registerButton");
    const privacyModal = document.getElementById("privacyModal");
    const cancelButton = document.getElementById("cancelButton");
    const proceedButton = document.getElementById("proceedButton");
    const registerForm = document.getElementById("registerForm");
    const agreeCheckbox = document.getElementById("agreeCheckbox");

    // Show modal when Register button is clicked
    registerButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form from submitting immediately
        privacyModal.style.display = "flex"; 
    });

    // Close modal and reset on Cancel
    cancelButton.addEventListener("click", function() {
        privacyModal.style.display = "none";
        agreeCheckbox.checked = false;
        proceedButton.disabled = true;
        proceedButton.style.backgroundColor = "#6b7280";
    });

    // Enable/disable Proceed button based on checkbox
    agreeCheckbox.addEventListener("change", function() {
        proceedButton.disabled = !this.checked;
        proceedButton.style.backgroundColor = this.checked ? "#11468F" : "#6b7280";
    });

    // Submit form when Proceed is clicked
    proceedButton.addEventListener("click", function() {
        privacyModal.style.display = "none";
        registerForm.submit();
    });

    // Close modal when clicking outside
    window.addEventListener("click", function(event) {
        if (event.target === privacyModal) {
            privacyModal.style.display = "none";
            agreeCheckbox.checked = false;
            proceedButton.disabled = true;
            proceedButton.style.backgroundColor = "#6b7280";
        }
    });
</script>

<script>
    // JavaScript to handle image preview
    document.getElementById('valid_id').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('id_preview');
        
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = "#"; // Reset the source if file is not valid
        }
    });
</script>