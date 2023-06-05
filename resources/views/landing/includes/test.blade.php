<div class="step_info">
    <div class="container" style="padding-left: 30px; padding-right: 30px">
        Erectile Dysfunction (ED) Treatment: Step <span class="step_num">1</span>
    </div>
</div>

<form action="/patient/order" method="POST">
    <input type="hidden" name="problem_type" value="ED">
    @csrf

    <div class="step-form container">

        @include('landing.layout.error_message')

        <div class="step active container" id="step-1">

            <div class="question-div">

                <span class="question">How often have you had trouble getting or keeping an erection during sex ?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-4 wrong-custom-button">
                    <input class="wrong-input custom-radio-circle" type="radio" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="Every time">
                    <label class="mouse-none">
                        Every time
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4" onclick="changeStep(1)">
                    <input onclick="event.stopPropagation();" type="radio" class="custom-radio-circle" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="None of the above">
                    <label class="mouse-none">
                        None of the above
                    </label>
                </label>

            </div>

        </div>


        <div class="step" id="step-2">

            <div class="question-div mt-4">

                <span class="question">Please let us know the name of the medication</span>

                <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_the_name_of_the_medication rounded" class="mt-4" required></textarea>

            </div>

            <div class="question-div mt-4"> 

                <div class="question-div mt-4">
                    <span class="question">Please let us know if you are allergic to any other medications</span>
                    <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_if_you_are_allergic_to_any_other_medications" class="mt-4" required></textarea>
                </div>

            </div>

        </div>

        <div class="step" id="step-3">

            <div class="question-div mt-4">

                <span class="question">Please let us know the name of the medication</span>

                <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_the_name_of_the_medication rounded" class="mt-4" required></textarea>

            </div>

            <div class="question-div mt-4"> 

                <div class="question-div mt-4">
                    <span class="question">Please let us know if you are allergic to any other medications</span>
                    <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_if_you_are_allergic_to_any_other_medications" class="mt-4" required></textarea>
                </div>

            </div>

        </div>


        <div class="step-buttons mt-4">
            <button class="button-custom" type="button" id="prevBtn" onclick="changeStep(-1)" disabled>Previous</button>
            <button type="button" class="button-custom d-none" id="nextBtn" onclick="changeStep(1)">Next</button>
            <button type="submit" class="button-custom d-none" id="submitBtn">Continue</button>
        </div>
    </div>


</form>




<script>
//valdiation function

    function validateStep(step) {
    const stepDiv = document.getElementById(`step-${step}`);
    const requiredFields = stepDiv.querySelectorAll("[required]");
    let isValid = true;

    for (let field of requiredFields) {
        if (!field.value.trim()) {
        isValid = false;
        field.style.borderColor = "red";
        } else {
        field.style.borderColor = ""; // Reset the border color when the field is filled
        }

        }

    return isValid;
    }

//ending valdiation function

    let currentStep = 1;
    const totalSteps = 3;

    function changeStep(n) {

        if (n === 1 && !validateStep(currentStep)) {
            
            Swal.fire({
            icon: 'error',
            title: 'All Fields Are Required',
            text: 'Please fill up the fields',
            confirmButtonText: 'Okay'
        }).then((result) => {
        
          //window.location.href = '/steps';

        });

            return;
        }

        const prevStep = document.getElementById(`step-${currentStep}`);
        currentStep += n;
        const nextStep = document.getElementById(`step-${currentStep}`);

        //checkValidation(currentStep);
        $('.step_num').html(currentStep);

        prevStep.classList.remove('active');
        nextStep.classList.add('active');

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (currentStep === 1) {
            prevBtn.setAttribute('disabled', 'disabled');
        } else {
            prevBtn.removeAttribute('disabled');
        }

        if (currentStep > 1) {

            $('#nextBtn').removeClass('d-none');
        }

        if (currentStep === totalSteps) {

            $('#submitBtn').removeClass('d-none');
            $('#nextBtn').addClass('d-none');
        } else {

            $('#nextBtn').removeClass('d-none');
            $('#submitBtn').addClass('d-none');
        }

        //$('#nextBtn').removeClass('d-none');
    }


</script>