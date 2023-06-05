<div class="step_info">
    <div class="container" style="padding-left: 30px;">
    Hangover Questionnaire: Step <span class="step_num">1</span>
    </div>
    <div class="container text-dark mt-1" style="padding-left: 30px; padding-right: 30px;font-size:13px;">
    <p class="mb-0">Hangover care kit contains Ondansetron Oral dissolvable tabs x 10, Famotidine x 10 tabs and Liquid IV x 6 packets.</p>
    </div>
</div>

<form action="/patient/order" method="POST">
    @csrf
    <input type="hidden" name="problem_type" value="HANGOVER">

    <div class="step-form container">

        @include('landing.layout.error_message')


        <div class="step active" id="step-1">

            <div class="question-div">

                <span class="question">Do you have any of the following symptoms now or do you get these symptoms from staying up late, alcohol use or spicy foods?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-4 symptoms-hang-section">
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle symptoms-hang-input" name="Do_you_have_any_of_the_following_symptoms_now_or_do_you_get_these_symptoms_from_staying_up_late,_alcohol_use_or_spicy_foods_?[]" value="Nausea" required>
                    <label class="mouse-none">
                    Nausea 
                    </label>    
                </label>

                <label class="button-container custom-radio w-100 mb-4 symptoms-hang-section">
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle symptoms-hang-input" name="Do_you_have_any_of_the_following_symptoms_now_or_do_you_get_these_symptoms_from_staying_up_late,_alcohol_use_or_spicy_foods_?[]" value="Vomiting"  required>
                    <label class="mouse-none">
                    Vomiting 
                    </label>    
                </label>

                <label class="button-container custom-radio w-100 mb-4 symptoms-hang-section" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle symptoms-hang-input" name="Do_you_have_any_of_the_following_symptoms_now_or_do_you_get_these_symptoms_from_staying_up_late,_alcohol_use_or_spicy_foods_?[]"  required value="Bitter or acidic taste in your mouth or at the back of your throat">
                    <label class="mouse-none">
                    Bitter or acidic taste in your mouth or at the back of your throat 
                    </label>    
                </label>

                <label class="button-container custom-radio w-100 mb-4 symptoms-hang-section">
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle symptoms-hang-input"  name="Do_you_have_any_of_the_following_symptoms_now_or_do_you_get_these_symptoms_from_staying_up_late,_alcohol_use_or_spicy_foods_?[]"  required value="Upper abdominal pain">
                    <label class="mouse-none">
                    Upper abdominal pain 
                    </label>    
                </label>

                <label class="button-container custom-radio w-100 mb-4 symptoms-hang-section wrong-custom-button" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle symptoms-hang-input " name="Do_you_have_any_of_the_following_symptoms_now_or_do_you_get_these_symptoms_from_staying_up_late,_alcohol_use_or_spicy_foods_?[]"  required value="I get some of these symptoms from staying up late, alcohol use or spicy foods">
                    <label class="mouse-none">
                     I get some of these symptoms from staying up late, alcohol use or spicy foods
                    </label>    
                </label>

            </div>


        </div>



        <div class="step" id="step-2">

            <div class="question-div">

                <span class="question">Do you have any of the following-</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle wrong-input" name="Do_you_have_any_of_the_following-[]" value="Blood in vomit" required>
                    <label class="mouse-none">
                        Blood in vomit
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle wrong-input" name="Do_you_have_any_of_the_following-[]" value="Blood in stool" required>
                    <label class="mouse-none">
                        Blood in stool
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle wrong-input" name="Do_you_have_any_of_the_following-[]" value="Severe abdominal pain" required>
                    <label class="mouse-none">
                        Severe abdominal pain
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 wrong-custom-butto">
                    <input type="checkbox" class="custom-radio-circle wrong-input" name="Do_you_have_any_of_the_following-[]" value="Abdominal pain that radiates to your back" required>
                    <label class="mouse-none">
                        Abdominal pain that radiates to your back
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3">
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle" name="Do_you_have_any_of_the_following-[]" value="None of the above apply to me" required>
                    <label class="mouse-none">
                        None of the above apply to me
                    </label>
                </label>
            </div>



            <div class="question-div mt-4">

                <span class="question">How long have you had these symptoms</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3">
                    <input type="radio" class="custom-radio-circle" name="How_long_have_you_had_these_symptoms" value="I only have symptoms when I eat spicy food, drink alcohol or do not get enough sleep" required>
                    <label class="mouse-none">
                        I only have symptoms when I eat spicy food, drink alcohol or do not get enough sleep
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3">
                    <input type="radio" class="custom-radio-circle" name="How_long_have_you_had_these_symptoms" value="Less than 1 week" required>
                    <label class="mouse-none">
                        Less than 1 week
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 wrong-custom-button">
                    <input type="radio" class="custom-radio-circle wrong-input" name="How_long_have_you_had_these_symptoms" value="More than 1 week" required>
                    <label class="mouse-none">
                        More than 1 week
                    </label>
                </label>

            </div>

        </div>


        <div class="step" id="step-3">

            <div class="question-div">

                <span class="question">Have you been diagnosed with any of the following</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Ulcer in your stomach" required>
                    <label class="mouse-none">
                        Ulcer in your stomach
                    </label>
                </label>
                
                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Varices" required>
                    <label class="mouse-none">
                        Varices
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Liver disease like hepatitis, liver failure or cholestatic jaundice" required>
                    <label class="mouse-none">
                        Liver disease like hepatitis, liver failure or cholestatic jaundice
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Bleeding disorder" required>
                    <label class="mouse-none">
                        Bleeding disorder
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Abnormal heart rhythm, long QT syndrome or family history of long QT syndrome" required>
                    <label class="mouse-none">
                        Abnormal heart rhythm, long QT syndrome or family history of long QT syndrome
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Heart disease such as a heart attack" required>
                    <label class="mouse-none">
                        Heart disease such as a heart attack
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Skin disease like Steven Johnson Syndrome or toxic epidermal necrolysis" required>
                    <label class="mouse-none">
                        Skin disease like Steven Johnson Syndrome or toxic epidermal necrolysis
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="Kidney failure" required>
                    <label class="mouse-none">
                        Kidney failure
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-diagnosed-section">
                    <input type="checkbox" class="custom-radio-circle hang-diagnosed-input" name="Have_you_been_diagnosed_with_any_of_the_following[]" value="None of the above apply to me" required>
                    <label class="mouse-none">
                        None of the above apply to me
                    </label>
                </label>

            </div>


        </div>


        <div class="step" id="step-4">

            <div class="question-div">

                <span class="question">Are you pregnant or could you be pregnant?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-preg-section ">
                    <input type="radio" class="custom-radio-circle hang-preg-input" name="Are_you_pregnant_or_could_you_be_pregnant_" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3  hang-preg-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  hang-preg-input wrong-input" name="Are_you_pregnant_or_could_you_be_pregnant_" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-preg-section">
                    <input type="radio" class="custom-radio-circle hang-preg-input" name="Are_you_pregnant_or_could_you_be_pregnant_" value="Does not apply / I am male" required>
                    <label class="mouse-none">
                    Does not apply / I am male
                    </label>
                </label>

            </div>
        </div>




        <div class="step" id="step-5">
            <div class="question-div">
                <span class="question">Are you allergic to Ondansetron (generic Zofran) or Famotidine (generic Pepcid)?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-allergic-section">
                    <input type="radio" class="custom-radio-circle hang-allergic-input" name="Are_you_allergic_to_Ondansetron_(generic_Zofran)_or_Famotidine_(generic_Pepcid)?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-allergic-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle hang-allergic-input wrong-input" name="Are_you_allergic_to_Ondansetron_(generic_Zofran)_or_Famotidine_(generic_Pepcid)?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>
            </div>



            <div class="question-div mt-4">
                <span class="question">Please tell us if you are allergic to any medications</span>
                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-medications-section">
                    <input type="checkbox" class="custom-radio-circle hang-medications-input" name="Please_tell_us_if_you_are_allergic_to_any_medications" value="I am not allergic" required>
                    <label class="mouse-none">
                    I am not allergic
                    </label>
                </label>
                <!-- <label class="button-container custom-radio w-100 mb-4 mt-3 hang-medications-section wrong-custom-button" onclick="showField('Are_you_allergic_to_any_other_meds_or_other_allergens')">
                    <input type="radio" id="Are_you_allergic_to_any_other_meds" class="custom-radio-circle hang-medications-input wrong-input" name="Please_tell_us_if_you_are_allergic_to_any_medications" value="I am allergic" required>
                    <label class="mouse-none">
                    I am allergic
                    </label>
                </label> -->
                <textarea id="Are_you_allergic_to_any_other_meds_or_other_allergens" class="form-control textarea-custom" name="Please_tell_us_if_you_are_allergic_to_any_medications_or_other_allergens_free_text" class="mt-4" placeholder="Enter the names of medicines you are allergic"></textarea>
            </div>


            <div class="question-div mt-4">
                <span class="question">Please tell us the names of all the medications including names of OTC medications, supplements you take daily</span>
                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-OTC-section">
                    <input required type="checkbox" class="custom-radio-circle hang-OTC-input" name="Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications,_supplements_you_take_daily" value="I do not take any over the counter medications or supplements">
                    <label class="mouse-none">
                    I do not take any over the counter medications or supplements
                    </label>
                </label>
                <textarea id="Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications_supplements_you_take_daily" class="form-control textarea-custom" name="Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications,_supplements_you_take_daily_free_text" placeholder="Enter the names of all the medications including names of OTC medications, supplements you take daily"></textarea>
            </div>

        </div>

        <div class="step" id="step-6">

            <div class="question-div text-center ">
                <p class="question failed_result d-none">Based on the information you have provided; we think you <b><span style="color: red">would not</span></b> be a good candidate for treatment with our Hangover treatment kit.</p>
                <p class="question passed_result d-none">Based on the information you have provided; we think you <b><span style="color: green">would</span></b> be a good candidate for treatment with our Hangover treatment kit.</p>
                <!-- <p>We will send your information to our medical provider for review and let you know when <br>your prescription will be approved.</p> -->
            </div>

        </div>

        <div class="step" id="step-7">

            <div class="question-div">

                <span class="question">By continuing to use this website, you agree to the following</span>

                <ul>
                    <li>The information you have provided is true to the best of your knowledge.</li>
                    <li>The medication is for your use only.</li>
                    <li>You will seek medical help if you vomit blood, have severe abdominal pain that could radiate to your back or have persistent vomiting (more than 3 times).</li>
                    <li>You will stop the medication if you experience any side effects and contact your primary care provider immediately.</li>
                    <li>You will inform your primary care provider about treatment you received from us.</li>
                    <li>You will read the medication information provided with your prescription.</li>
                </ul>
                <ul>
                    <li><a target="_blank" data-toggle="modal" data-target="#terms-of-use">Terms of Use ABF</a></li>
                    <li> <a href="/telemedicine" target="_blank">Telehealth Consent ABF</a></li>
                   
                </ul>
                
               
                
                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-agree-section">
                    <input type="radio" class="custom-radio-circle hang-agree-input" name="I_agree" value="1" required>
                    <label class="mouse-none">
                    I agree
                    </label>
                </label>

            </div>

        </div>

        <div class="step" id="step-8">

            <div class="question-div">
                <span class="question">You can ask any question to your medical provider here </span>
                <textarea class="form-control mt-3 textarea-custom" placeholder="Write your question here" name="Question_for_provider"></textarea>
                <label class="button-container custom-radio w-100 mb-4 mt-3 hang-provider-section">
                    <input type="radio" class="custom-radio-circle hang-provider-input" name="Question_for_provider" value="No question">
                    <label class="mouse-none">
                    I have no questions
                    </label>
                </label>
            </div>
        </div>




        <div class="step-buttons mt-4">
            
            <button class="btn button-custom d-none previous-button" type="button" id="prevBtn" onclick="changeStep(-1)" disabled>Previous</button>
           <div class="col text-end">
           <button type="button" class="btn button-custom" id="nextBtn" style="float:right;" onclick="changeStep(1)">Next</button>
           </div>
            <a href="https://vacaymd.com/" class="btn button-custom d-none" id="failed_btn_ok"> Okay</a>
            <button type="submit" class="btn button-custom d-none" id="submitBtn">Continue</button>
        </div>
    </div>


</form>


<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="terms-of-use" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
    let currentStep = 1;
    const totalSteps = 8;

    function changeStep(n) {

        window.scrollTo(0, 0);

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

        $('#failed_btn_ok').addClass('d-none');

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
            $('#prevBtn').removeClass('d-none');
        }else{
            $('#prevBtn').addClass('d-none');
            $('#nextBtn').addClass('d-none');
        }
        if (currentStep==6) {
        var totalErrorsFinal=$('#total_wrongs').val();
        if(totalErrorsFinal > 0){
           $('#failed_btn_ok').removeClass('d-none');
           $('#nextBtn').addClass('d-none');
        }else{
            $('#failed_btn_ok').addClass('d-none');
            $('#nextBtn').removeClass('d-none');
        }
        
        }else{
        if (currentStep === totalSteps) {

            $('#submitBtn').removeClass('d-none');
            $('#nextBtn').addClass('d-none');
        } else {

            $('#nextBtn').removeClass('d-none');
            $('#submitBtn').addClass('d-none');
        }
        }

        //$('#nextBtn').removeClass('d-none');
    }
</script>