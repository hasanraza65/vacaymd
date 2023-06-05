<div class="step_info">
    <div class="container" style="padding-left: 30px; padding-right: 30px">
        Erectile Dysfunction (ED) Questionnaire: Step <span class="step_num">1</span>
    </div>
    <div class="container text-dark mt-1" style="padding-left: 30px; padding-right: 30px;font-size:13px;">
    <p class="mb-0 pb-0">ED treatment kit consists of Sildenafil 50mg (Generic Viagra) x 10 tabs.</p>
    </div>
</div>

<form action="/patient/order" method="POST">
    <input type="hidden" name="problem_type" value="ED">
    @csrf

    <div class="step-form container">

        @include('landing.layout.error_message')

        <div class="step active container p-0" id="step-1">

            <div class="question-div">  
                
                <span class="question">How often have you had trouble getting or keeping an erection during sex?</span>

                <label class="button-container custom-radio w-100  mt-4 wrong-custom-button">
                    <input onclick="event.stopPropagation();" class="custom-radio-circle " type="radio" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="On occasion with a new partner or unfamiliar surrounding">
                    <label class="mouse-none">
                    On occasion with a new partner or unfamiliar surrounding 

                    </label>
                </label>

                <label class="button-container custom-radio w-100  mt-4 wrong-custom-button">
                    <input onclick="event.stopPropagation();" class="custom-radio-circle " type="radio" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="rarely">
                    <label class="mouse-none">
                        Rarely
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-4 wrong-custom-button">
                    <input onclick="event.stopPropagation();" class="custom-radio-circle wrong-input" type="radio" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="Every time">
                    <label class="mouse-none">
                        Every time
                    </label>
                </label>

                <!-- <label class="button-container custom-radio w-100 mb-4" onclick="changeStep(1)">
                    <input onclick="event.stopPropagation();" type="radio" class="custom-radio-circle" name="How_often_have_you_had_trouble_getting_or_keeping_an_erection_during_sex_?" value="None of the above">
                    <label class="mouse-none">
                        None of the above
                    </label>
                </label> -->

            </div>
            <div class="question-div mt-4">

                <span class="question">Do you have erections in the morning or during masturbation?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 morning-section">
                    <input type="radio" class="custom-radio-circle morning-section-input" name="Do_you_have_erections_in_the_morning_or_during_masturbation" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 morning-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle morning-section-input wrong-input" name="Do_you_have_erections_in_the_morning_or_during_masturbation" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

        </div>


        <div class="step" id="step-2">

            

            <div class="question-div">

                <span class="question">Have you ever been treated for ED with medication?</span>

                <label class="button-container custom-radio w-100 mb-4 mt-3 treated-section" onclick="showField('Have_you_ever_been_treated_for_ED_with_medication')">
                    <input type="radio" class="custom-radio-circle treated-section-input" name="Have_you_ever_been_treated_for_ED_with_medication_?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <textarea id="Have_you_ever_been_treated_for_ED_with_medication" placeholder="Please enter the names of the medication" class="form-control mt-3 textarea-custom d-none mt-4 mb-4" name="Please_let_us_know_the_name_of_the_medication rounded"></textarea>

                <label class="button-container custom-radio w-100 mb-4 treated-section" onclick="hideField('Have_you_ever_been_treated_for_ED_with_medication')">
                    <input type="radio" class="custom-radio-circle treated-section-input" name="Have_you_ever_been_treated_for_ED_with_medication_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>
                <!-- <label class="button-container custom-radio w-100 mb-4 treated-section wrong-custom-button" onclick="hideField('Have_you_ever_been_treated_for_ED_with_medication')">
                    <input type="radio" class="custom-radio-circle treated-section-input wrong-input" name="Have_you_ever_been_treated_for_ED_with_medication_?" value="None of the above" required>
                    <label class="mouse-none">
                        None of the above
                    </label>
                </label> -->

            </div>

            <div class="question-div mt-4">

                <span class="question">Are you allergic to Sildenafil or any of its components? </span>

                <label class="button-container custom-radio w-100 mb-4 mt-4 slidenafil-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle slidenafil-section-input wrong-input" name="Are_you_allergic_to_slidenafil_or_any_of_its_components?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-3 slidenafil-section">
                    <input type="radio" class="custom-radio-circle slidenafil-section-input" name="Are_you_allergic_to_slidenafil_or_any_of_its_components?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

                <div class="question-div mt-4">
                    <span class="question">Please let us know if you are allergic to any other medications</span>
                    <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_if_you_are_allergic_to_any_other_medications" class="mt-4" placeholder="Please enter the names of the medication"></textarea>
                </div>

            </div>

        </div>


        <div class="step" id="step-3">
            <div class="question-div">
                <span class="question">Have you had recent surgeries or hospitalization?</span>
                <label class="button-container custom-radio w-100 mb-4 mt-4 surgery-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle surgery-section-input wrong-input" name="Have_you_had_recent_surgeries_or_hospitalization_?" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 surgery-section">
                    <input type="radio" class="custom-radio-circle surgery-section-input" name="Have_you_had_recent_surgeries_or_hospitalization_?" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>
            </div>



            <div class="question-div">

                <span class="question">Do you have any of the following symptoms</span>
                <label class="button-container custom-radio w-100 mb-4  mt-4 symptoms-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle symptoms-section-input wrong-input" name="Do_you_have_any_of_the_following_symptoms_[]" value="Chest pain when climbing 2 flights of stairs" required>
                    <label class="mouse-none">
                        Chest pain when climbing 2 flights of stairs
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 symptoms-section wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle symptoms-section-input wrong-input" name="Do_you_have_any_of_the_following_symptoms_[]" value="Chest pain with sexual activity" required>
                    <label class="mouse-none">
                        Chest pain with sexual activity
                    </label>
                </label>


                <label class="button-container custom-radio w-100 mb-4  mt-4 symptoms-section wrong-custom-button">
                    <input class="custom-radio-circle symptoms-section-input wrong-input" type="checkbox" name="Do_you_have_any_of_the_following_symptoms_[]" value="Unexplained fainting or dizziness" required>
                    <label class="mouse-none">
                        Unexplained fainting or dizziness
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 symptoms-section wrong-custom-button">
                    <input class="custom-radio-circle symptoms-section-input wrong-input" type="checkbox" name="Do_you_have_any_of_the_following_symptoms_[]" value="Abnormal heart beats or rhythms" required>
                    <label class="mouse-none">
                        Abnormal heart beats or rhythms
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 symptoms-section">
                    <input type="checkbox" class="custom-radio-circle symptoms-section-input" name="Do_you_have_any_of_the_following_symptoms_[]" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>
            </div>

            <div class="question-div">

                <span class="question">Are you able to perform moderately active tasks (walking on level ground or walking up 2 flights of stairs) without chest pain or shortness of breath? </span>

                <label class="button-container custom-radio w-100 mb-4 mt-4 shortness-section">
                    <input type="radio" class="custom-radio-circle shortness-section-input" name="Are_you_able_to_perform_moderately_active_tasks_(walking_on_level_ground_or_walking_up_2_flights_of_stairs)_without_chest_pain_or_shortness_of_breath_?_" value="Yes" required>
                    <label class="mouse-none">
                        Yes
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 shortness-section wrong-custom-button">
                    <input type="radio" class="custom-radio-circle shortness-section-input wrong-input" name="Are_you_able_to_perform_moderately_active_tasks_(walking_on_level_ground_or_walking_up_2_flights_of_stairs)_without_chest_pain_or_shortness_of_breath_?_" value="No" required>
                    <label class="mouse-none">
                        No
                    </label>
                </label>

            </div>

        </div>



        <div class="step" id="step-4">

            <div class="question-div">

                <span class="question">Have you been diagnosed with any of the following conditions</span>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input type="checkbox" class="custom-radio-circle diagnose-section-input wrong-input" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Coronary artery disease, CAD or angina or had a heart attack or abnormal heart rhythms" required>
                    <label class="mouse-none">
                        Coronary artery disease, CAD or angina or had a heart attack or abnormal heart rhythms
                    </label>
                </label>


                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Stroke, mini stroke or TIA" required>
                    <label class="mouse-none">
                        Stroke, mini stroke or TIA
                    </label>
                </label>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Low (less than 100/60) or very high blood pressure (more than 170/90)" required>
                    <label class="mouse-none">
                        Low (less than 100/60) or very high blood pressure (more than 170/90)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Prostate conditions (like BPH)" required>
                    <label class="mouse-none">
                        Prostate conditions (like BPH)
                    </label>
                </label>


                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Kidney disease" required>
                    <label class="mouse-none">
                        Kidney disease
                    </label>
                </label>


                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Liver disease" required>
                    <label class="mouse-none">
                        Liver disease
                    </label>
                </label>


                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Eye conditions (optic neuropathy or inherited eye disease)" required>
                    <label class="mouse-none">
                        Eye conditions (optic neuropathy or inherited eye disease)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Peyronie’s disease or any other deformation of the penis" required>
                    <label class="mouse-none">
                        Peyronie's disease or any other deformation of the penis
                    </label>
                </label>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Blood problems (like sickle cell anemia, leukemia)" required>
                    <label class="mouse-none">
                    Blood problems (like sickle cell anemia, leukemia)
                    </label>
                </label>


                <label class="button-container custom-radio w-100 diagnose-section mb-4 mt-4 wrong-custom-button">
                    <input class="custom-radio-circle diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="HIV/AIDS" required>
                    <label class="mouse-none">
                        HIV / AIDS
                    </label>
                </label>

                <label class="button-container custom-radio w-100 diagnose-section mb-4  mt-4 wrong-custom-button">
                    <input class="custom-radio-circle wrong-input diagnose-section-input wrong-input" type="checkbox" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="Pulmonary Hypertension" required>
                    <label class="mouse-none">
                        Pulmonary Hypertension
                    </label>
                </label>



                <label class="button-container custom-radio w-100 diagnose-section mb-4 mt-4">
                    <input type="checkbox" class="custom-radio-circle" name="Have_you_been_diagnosed_with_any_of_the_following_conditions[]" value="None of these" required>
                    <label class="mouse-none">
                        None of these

                    </label>
                </label>


            </div>

            <div class="question-div mt-4">
                <span class="question">Please let us know if you have any other medical conditions other than those listed above </span>
                <textarea class="form-control mt-3 textarea-custom" name="Please_let_us_know_if_you_have_any_other_medical_conditions_other_than_those_listed_above" placeholder="Please enter here any other medical conditions" class="mt-4" ></textarea>

            </div>

        </div>



        <div class="step" id="step-5">

            <div class="question-div">

                <span class="question">Do you take any of these medications</span>

                <label class="button-container custom-radio w-100 mb-4  mt-4 med-ed-section wrong-custom-button">
                    <input class="custom-radio-circle med-ed-input wrong-input" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="Nitrates_like_isosorbide_mononitrate_or_dinitrate,_or_nicorandil_(typically_for_heart_disease_/_angina)" required>
                    <label class="mouse-none">
                        Nitrates like isosorbide mononitrate or dinitrate, or nicorandil (typically for heart disease / angina)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 med-ed-section wrong-custom-button">

                    <input class="custom-radio-circle med-ed-input wrong-input" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="Alpha-blockers,_such_as_Tamsulosin_(Flomax),_alfuzosin,_or_doxazosin_(usually_for_enlarged_prostate_or_to_treat_high_blood_pressure)" required>
                    <label class="mouse-none">
                        Alpha-blockers, such as Tamsulosin (Flomax), alfuzosin, or doxazosin (usually for enlarged prostate or to treat high blood pressure)
                    </label>
                </label>


                <label class="button-container custom-radio w-100 mb-4  mt-4 med-ed-section wrong-custom-button">
                    <input class="custom-radio-circle wrong-input med-ed-input" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="Blood_thinners_or_anticoagulants_e.g._warfarin_(Coumadin),_rivaroxaban_(Xarelto),_dabigatran_(Pradaxa),_apixaban_(Eliquis),_clopidogrel_(Plavix)or_related_drugs" required>
                    <label class="mouse-none">
                        Blood thinners or anticoagulants e.g. warfarin (Coumadin), rivaroxaban (Xarelto), dabigatran (Pradaxa), apixaban (Eliquis), clopidogrel (Plavix)or related drugs
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 med-ed-section wrong-custom-button">
                    <input class="custom-radio-circle med-ed-input wrong-input" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="CYP3A4" required>
                    <label class="mouse-none">
                        Any CYP3A4 inhibitors, e.g. Cobicistat containing products for HIV infection: Genvoya, Stribild, Symtuza, Prezcobix and Evotaz. Ritonivir (for HIV), Itraconazole or ketoconazole (to treat fungal infections), erythromycin, Clarithromycin (antibiotics), diltiazem or verapamil (for high blood pressure)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 med-ed-section wrong-custom-button">
                    <input class="custom-radio-circle med-ed-input wrong-input" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="Riociguat (for pulmonary hypertension)" required>
                    <label class="mouse-none">
                        Riociguat (for pulmonary hypertension)
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4 mt-4 med-ed-section">
                    <input class="custom-radio-circle" type="checkbox" name="Do_you_take_any_of_these_medications[]" value="None of the above" required>
                    <label class="mouse-none">
                       None of the above
                    </label>
                </label>


            </div>

            <div class="question-div">

                <div class="question-div mt-4">

                    <span class="question">Please list all medications you take daily-</span>

                    <textarea class="form-control mt-3 textarea-custom" name="Please_list_all_medications_you_take_daily-" class="mt-4" placeholder="Enter your answer"></textarea>

                </div>


            </div>

        </div>

        <div class="step" id="step-6">

            <div class="question-div">

                <span class="question">Have you used any of the following recreational drugs in the past 3 months?</span>

                <label class="button-container custom-radio w-100 mb-4  mt-4 drug-ed-section wrong-custom-button">
                    <input class="custom-radio-circle drug-ed-input wrong-input" type="checkbox" name="Have_you_used_any_of_the_following_recreational_drugs_in_the_past_3_months?[]" value="Poppers (amyl nitrate / butyl nitrate)" required>
                    <label class="mouse-none">
                        Poppers (amyl nitrate / butyl nitrate)
                    </label>
                </label>



                <label class="button-container custom-radio w-100 mb-4  mt-4 drug-ed-section wrong-custom-button">
                    <input class="custom-radio-circle drug-ed-input wrong-input" type="checkbox" name="Have_you_used_any_of_the_following_recreational_drugs_in_the_past_3_months?[]" value="Cocaine" required>
                    <label class="mouse-none">
                        Cocaine
                    </label>
                </label>

                <label class="button-container custom-radio w-100 mb-4  mt-4 drug-ed-section wrong-custom-button">
                    <input class="custom-radio-circle drug-ed-input wrong-input" type="checkbox" name="Have_you_used_any_of_the_following_recreational_drugs_in_the_past_3_months?[]" value="Crystal_meth" required>
                    <label class="mouse-none">
                        Crystal meth
                    </label>
                </label>


                <label class="button-container custom-radio w-100 mb-4 mt-4 drug-ed-section">
                    <input class="custom-radio-circle drug-ed-input" type="checkbox" name="Have_you_used_any_of_the_following_recreational_drugs_in_the_past_3_months?[]" value="None" required>
                    <label class="mouse-none">
                        None
                    </label>
                </label>


            </div>

        </div>

        <div class="step" id="step-7">

            <div class="question-div text-center ">
                <p class="question failed_result d-none">Based on the information you have provided; we think you <b><span style="color: red">would not</span></b> be a <br>good candidate for treatment with Sildenafil (generic Viagra)</p>
                <p class="question passed_result d-none">Based on the information you have provided; we think you <b><span style="color: green">would</span></b> be a <br>good candidate for treatment with Sildenafil (generic Viagra) .</p>
                <!-- <p>We will send your information to our medical provider for review and let you know when <br>your prescription will be approved.</p> -->
            </div>

        </div>

        <div class="step" id="step-8">

            <div class="question-div">

                <span class="question">By continuing to use this website, you agree to the following</span>

                <ul style="background-color: white; padding: 40px" class="mt-3 mb-3">
                    <li>You will seek medical care for erection lasting more than 4 hrs, dizziness or low blood pressure while using the medication.</li>
                    <li>The medication is for your use only. Do not share the medication with others.</li>
                    <li>Use of alcohol, illicit drugs may cause unforeseen side effects while using the medication.</li>
                    <li>You will stop the medication if you experience any side effects and contact your primary care provider immediately.</li>
                    <li>You will inform your primary care provider about treatment you received from us.</li>
                    <li>You will read the medication information provided with your prescription.</li>
                </ul>
                <ul>
                    <li><a href="/terms_of_use" target="_blank">Terms of Use ABF</a></li>
                    <li><a href="/telemedicine" target="_blank">Telehealth Consent ABF</a></li>
                </ul>

                <label class="button-container custom-radio w-100 mb-4 mt-4 agree-ed-section">
                    <input class="custom-radio-circle agree-ed-input" type="radio" name="I_agree" value="1" required>
                    <label class="mouse-none">
                        I agree
                    </label>
                </label>

            </div>

        </div>

        <div class="step" id="step-9">

            <div class="question-div">

                <span class="question">You can ask any question to your medical provider here </span>

                <textarea class="form-control mt-3 textarea-custom" placeholder="Write your question here" name="Question_for_provider"></textarea>


                <label class="button-container custom-radio w-100 mb-4 mt-4 questions-ed-section">
                    <input class="custom-radio-circle questions-ed-input" type="radio" name="Question_for_provider" value="No question">
                    <label class="mouse-none">
                        I have no questions
                    </label>
                </label>


            </div>

        </div>


        <div class="step-buttons mt-4 container p-0">
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
    const totalSteps = 9;

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
            $('#prevBtn').removeClass('d-none');
        }else{
            $('#prevBtn').addClass('d-none');
            $('#nextBtn').addClass('d-none');
        }
        

        
        if (currentStep==7) {
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


    function checkValidation(step_num) {

        /*

        let isValid = true;

        $("#step-"+step_num+" input[required]").each(function() {
            if ($(this).attr('type') === 'radio') {
                
                let radioGroupName = $(this).attr('name');
                var escapedString = jQuery.escapeSelector(radioGroupName);
                if (!$(`input[name=${escapedString}]:checked`).length) {
                isValid = false;
                return false;
                }
            
            } else if ($(this).val().trim() === '') {
                isValid = false;
                return false;
            }
            });

            if (!isValid) {
            alert("Please fill in the required fields, textareas, and select the required radio buttons.");
            } else {
            // Submit the form or perform other actions
            console.log("Form is valid");
            } */

    }
</script>