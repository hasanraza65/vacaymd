<div class="step_info">
    <div class="container" style="padding-left: 30px; padding-right: 30px">
    UTI Questionnaire: Step <span class="step_num">1</span>
    </div>
    <div class="container text-dark mt-1" style="padding-left: 30px; padding-right: 30px;font-size:13px;">
    <p class="mb-0">UTI kit contains Cranberry and Probiotic blend x 10 tabs, Urine Testing Strips x 2 and Nitrofurantoin x 10 tabs.<br> This kit is designed to prevent UTI for 5 days and has a complete course of antibiotic.</p>
    </div>
</div>

<form action="/patient/order" method="POST">
    <input type="hidden" name="problem_type" value="UTI">
    <input type="hidden" name="selected_state_id" value="<?=$_GET['state']?>">
    @csrf

    <div class="step-form container">

        @include('landing.layout.error_message')

        <div class="step active" id="step-1">

            <div class="question-div">

                <span class="question">Do you have any of the following</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle d-uti-section" name="Do_you_have_any_of_the_following[]" value="I don’t have symptoms at this time, but I am worried I might get a UTI">
                    <label class="mouse-none">
                       I don’t have symptoms at this time, but I am worried I might get a UTI
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle d-uti-section" name="Do_you_have_any_of_the_following[]" value="Pain , burning or discomfort while urinating">
                    <label class="mouse-none">
                        Pain , burning or discomfort while urinating
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Urinating more frequently than usual">
                    <label class="mouse-none">
                        Urinating more frequently than usual
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Need to urinate (urgency) more than usual">
                    <label class="mouse-none">
                        Need to urinate (urgency) more than usual
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section wrong-custom-button" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="wrong-input custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Fever (more than 99.5 F)">
                    <label class="mouse-none">
                        Fever (more than 99.5 F)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section wrong-custom-button" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="wrong-input custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Flank pain or pain between your spine and ribs">
                    <label class="mouse-none">
                        Flank pain or pain between your spine and ribs
                    </label>
                </label>


                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section wrong-custom-button" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="wrong-input custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Blood in urine (other than menstrual blood)">
                    <label class="mouse-none">
                        Blood in urine (other than menstrual blood)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 d-uti-section wrong-custom-button" >
                    <input onclick="event.stopPropagation();" type="checkbox" class="wrong-input custom-radio-circle d-uti-input" name="Do_you_have_any_of_the_following[]" value="Nausea or vomiting">
                    <label class="mouse-none">
                        Nausea or vomiting
                    </label>
                </label>

            </div>

        </div>

        <div class="step" id="step-2">

            <div class="question-div">

                <span class="question">How long have you had these symptoms</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 symptoms-uti-section">
                    <input type="radio" class="custom-radio-circle symptoms-uti-input" name="How_long_have_you_had_these_symptoms" value="I don’t have symptoms at this time" required>
                    <label class="mouse-none">
                        I don’t have symptoms at this time
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 symptoms-uti-section">
                    <input type="radio" class="custom-radio-circle symptoms-uti-input" name="How_long_have_you_had_these_symptoms" value="Less than 1 week" required>
                    <label class="mouse-none">
                        Less than 1 week
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 symptoms-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle symptoms-uti-input wrong-input" name="How_long_have_you_had_these_symptoms" value="More than 1 week" required>
                    <label class="mouse-none">
                        More than 1 week
                    </label>
                </label>


            </div>

            <div class="question-div mt-4">

                <span class="question">Do you have any vaginal symptoms such as discharge , odor, itching?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 vaginal-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  vaginal-uti-input wrong-input" name="Do_you_have_any_vaginal_symptoms_such_as_discharge_,_odor,_itching_?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 vaginal-uti-section">
                    <input type="radio" class="custom-radio-circle vaginal-uti-input" name="Do_you_have_any_vaginal_symptoms_such_as_discharge_,_odor,_itching_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div mt-4">

                <span class="question">Do you get UTIs frequently (more than once every 3 months)? </span>

                <label class="button-container custom-radio w-100 mb-4 mt-3  uti-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  uti-uti-input wrong-input" name="Do_you_get_UTIs_frequently_(more_than_once_every_3_months)_?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 uti-uti-section">
                    <input type="radio" class="custom-radio-circle uti-uti-input" name="Do_you_get_UTIs_frequently_(more_than_once_every_3_months)_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div mt-4">
                <span class="question">If you have been successfully treated for a UTI before, please write down the name of the anti-biotic your physician prescribed </span>
                <label class="button-container custom-radio w-100 mb-4 mt-3 ">
                    <input id="If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed" type="checkbox" class="custom-radio-circle surgery-uti-input" name="If_you_have_been_successfully_treated_for_a_UTI_before,_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed" value="I was not prescribed OR I do not remember the name of the antibiotic I was prescribed.">
                    <label class="mouse-none">I was not prescribed OR I do not remember the name of the antibiotic I was prescribed.
                    </label>
                </label>
                <textarea id="If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed_text" class="form-control mt-3 textarea-custom" name="If_you_have_been_successfully_treated_for_a_UTI_before,_please_write_down_the_name_of_the_anti-biotic_your_physician_prescribed" placeholder="Write down the names of the anti-biotic here"></textarea>
            </div>

        </div>

        <div class="step" id="step-3">

            <div class="question-div">

                <span class="question">Have you been hospitalized or had surgery in the last 3 months</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3  surgery-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  surgery-uti-input wrong-input" name="Have_you_been_hospitalized_or_had_surgery_in_the_last_3_months" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 surgery-uti-section">
                    <input type="radio" class="custom-radio-circle surgery-uti-input" name="Have_you_been_hospitalized_or_had_surgery_in_the_last_3_months" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div">

                <span class="question">Do you have a history of kidney stones?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 stone-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  stone-uti-input wrong-input" name="Do_you_have_a_history_of_kidney_stones_?" value="Yes" required> 
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 stone-uti-section">
                    <input type="radio" class="custom-radio-circle stone-uti-input" name="Do_you_have_a_history_of_kidney_stones_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div">

                <span class="question">Have had a catheter in your bladder in the last 3 months?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3  bladder-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  bladder-uti-input wrong-input" name="Have_had_a_catheter_in_your_bladder_in_the_last_3_months_?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 bladder-uti-section">
                    <input type="radio" class="custom-radio-circle bladder-uti-input" name="Have_had_a_catheter_in_your_bladder_in_the_last_3_months_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

        </div>

        <div class="step" id="step-4">

            <div class="question-div">

                <span class="question">Are you pregnant or could be pregnant?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3  pregnant-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  pregnant-uti-input wrong-input" name="Are_you_pregnant_or_could_be_pregnant?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 pregnant-uti-section">
                    <input type="radio" class="custom-radio-circle pregnant-uti-input" name="Are_you_pregnant_or_could_be_pregnant?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div">

                <span class="question">Do you have any of the following conditions?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="Diabetes" required>
                    <label class="mouse-none">
                        Diabetes
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="HIV" required>
                    <label class="mouse-none">
                        HIV
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="Cancer or are on immunosuppressant medications (medications that reduce your immunity)" required>
                    <label class="mouse-none">
                        Cancer or are on immunosuppressant medications (medications that reduce your immunity)
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="Kidney failure, liver failure or lung pneumonitis / fibrosis" required>
                    <label class="mouse-none">
                        Kidney failure, liver failure or lung pneumonitis / fibrosis
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="Gall bladder problems" required>
                    <label class="mouse-none">
                        Gall bladder problems
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="G6PD deficiency" required>
                    <label class="mouse-none">
                        G6PD deficiency
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input wrong-input" name="Do_you_have_any_of_the_following_conditions?[]" value="Peripheral neuropathy" required>
                    <label class="mouse-none">
                        Peripheral neuropathy
                    </label>
                </label>
                <label class="button-container custom-radio w-100 mb-4 mt-3 condition-uti-section">
                    <input type="checkbox" class="custom-radio-circle condition-uti-input" name="Do_you_have_any_of_the_following_conditions?[]" value="None of the above" required>
                    <label class="mouse-none">
                       None of the above
                    </label>
                </label>
                

            </div>

        </div>

        <div class="step" id="step-5">
            <div class="question-div">
                <span class="question">Are you allergic to Nitrofurantoin?</span>
                <label class="button-container custom-radio w-100 mb-4 mt-3  allergic-uti-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle  allergic-uti-input wrong-input" name="Are_you_allergic_to_Nitrofurantoin?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 allergic-uti-section">
                    <input type="radio" class="custom-radio-circle allergic-uti-input" name="Are_you_allergic_to_Nitrofurantoin?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>
            </div>

            <div class="question-div">

                <span class="question">Are you allergic to any other meds?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 meds-uti-section" onclick="showField('Are_you_allergic_to_any_other_meds')">
                    <input type="radio" class="custom-radio-circle meds-uti-input" name="Are_you_allergic_to_any_other_meds?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <textarea id="Are_you_allergic_to_any_other_meds" class="form-control mt-3 textarea-custom d-none" placeholder="Each medicine name at one line which you are allergic." name="Are_you_allergic_to_any_other_meds_(Meds_Names))" class="mt-4" ></textarea>

                <label class="button-container custom-radio w-100 mb-4 mt-3 meds-uti-section" onclick="hideField('Are_you_allergic_to_any_other_meds')">
                    <input type="radio" class="custom-radio-circle meds-uti-input" name="Are_you_allergic_to_any_other_meds?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

            <div class="question-div mt-4">
                <span class="question">Please tell us the names of the medications, supplements that you take every day  </span>
                <textarea class="form-control mt-3 textarea-custom" placeholder="Enter the name of medications" name="Please_tell_us_the_names_of_the_medications,_supplements_that_you_take_every_day_free_text" class="mt-4" ></textarea>
            </div>

            <div class="question-div mt-4">
                <span class="question">Please let us know if you have any questions or concerns</span>
                <textarea class="form-control mt-3 textarea-custom" placeholder="Enter your answer" name="Please_let_us_know_if_you_have_any_questions_or_concerns" class="mt-4"></textarea>
            </div>

        </div>

        <div class="step result_step" id="step-6">

            <div class="question-div text-center ">
                <p class="question failed_result d-none">Based on the information you have provided;<br> we think you <b><span style="color: red">would not</span></b> be a good candidate for treatment with our UTI kit.</p>
                <p class="question passed_result d-none">Based on the information you have provided;<br> we think you <b><span style="color: green">would</span></b> be a good candidate for treatment with our UTI kit.</p>
                <!-- <p>We will send your information to our medical provider for review and let you know when <br>your prescription will be approved.</p> -->
            </div>

        </div>

        <div class="step" id="step-7">

            <div class="question-div">

                <span class="question">By continuing to use this website, you agree to the following</span>

                <ul>
                    <li>The medication is for your use only.</li>
                    <li>You will seek in-person medical attention if you have fever (more than 99.5F), flank pain or pain in your back, non-menstrual blood in urine, nausea or vomiting.</li>
                    <li>You will inform your PCP about the treatment you received from us.</li>
                    <li>You will seek medical attention from your primary care provider if your symptoms do not improve in 2 days or if your symptoms worsen despite our treatment.</li>
                    <li>Our treatment is designed to work for the majority of infections, however, in some cases, the treatment may be ineffective.</li>
                    <li>If you have side effects from our treatment, you should stop taking the medications and contact us and your primary care provider.</li>
                    <li>You will read the medication information provided with your prescription.</li>
                </ul>
                <ul>
                    <!---<li><a href="/terms_of_use" target="_blank">Terms of Use ABF</a></li>
                    <li> <a href="/telemedicine" target="_blank">Telehealth Consent ABF</a></li> -->
                    <b><span style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Use ABF</span></b><br>
                    <b><span style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#telmedModal">Telehealth Consent ABF</span></b>
                </ul>

                <label class="button-container custom-radio w-100 mb-4 mt-4 agree-uti-section">
                    <input type="radio" class="custom-radio-circle agree-uti-input" name="I_agree" value="1" required>
                    <label class="mouse-none">
                        I Agree
                    </label>
                </label>
            </div>

        </div>

        <div class="step" id="step-8">

            <div class="question-div">

                <span class="question">You can ask any question to your medical provider here </span>

                <textarea class="form-control mt-3 textarea-custom" placeholder="Write your questions here" name="Question_for_provider" class="mt-4"></textarea>

                <label class="button-container custom-radio w-100 mb-4 mt-4 qustions-uti-section">
                    <input type="radio" class="custom-radio-circle qustions-uti-input" name="Question_for_provider" value="No question">
                    <label class="mouse-none">
                    I have no questions
                    </label>
                </label>

            </div>

        </div>


        <div class="step-buttons mt-4">
            <button class="button-custom d-none previous-button" type="button" id="prevBtn" onclick="changeStep(-1)" disabled>Previous</button>
            <div class="col text-end">
             <button type="button" class="btn button-custom" id="nextBtn" style="float:right;" onclick="changeStep(1)">Next</button>
           </div>
            <a href="https://vacaymd.com/" class="btn button-custom d-none" id="failed_btn_ok"> Okay</a>
            <button type="submit" class="button-custom d-none" id="submitBtn">Continue</button>
        </div>
    </div>


</form>




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

        //custom button style for result steps
        if(currentStep === 6){

            $('.step-buttons').addClass('result_steps_button');

        }else{

            $('.step-buttons').removeClass('result_steps_button');
        }
        //ending custom button style for result steps

        
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