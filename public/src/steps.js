function toggleMenu() {
  const menu = document.getElementById('menu');
  menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function showField(idname){

  $('#'+idname).removeClass('d-none');

}

function hideField(idname){

$('#'+idname).addClass('d-none');

}

/*
var selectedValues = {};

$(document).ready(function() {
  var selectedValues = {};

  $("input[type='radio'], input[type='checkbox']").change(function() {
    var name = $(this).attr("name");

    // Initialize if not already present
    if (!selectedValues.hasOwnProperty(name)) {
      selectedValues[name] = "";
      selectedValues[name + "_errors"] = 0;
    }

    // Count the number of errors in this group
    var groupErrors = 0;
    $("input[name='" + name + "']").each(function() {
      if ($(this).hasClass("wrong-input") && $(this).is(":checked")) {
        groupErrors++;
      }
    });

    selectedValues[name + "_errors"] = groupErrors;

    // When dealing with checkboxes, multiple options can be selected
    var selectedOptions = $("input[name='" + name + "']:checked").map(function() {
      return $(this).val();
    }).get();

    selectedValues[name] = selectedOptions.join(',');

    var totalErrors = 0;
    for (var key in selectedValues) {
      if (key.endsWith("_errors")) {
        totalErrors += selectedValues[key];
      }
    }

    $('#total_wrongs').val(totalErrors);

    if (totalErrors > 0) {
      $('.failed_result').removeClass('d-none');
      $('.passed_result').addClass('d-none');
    } else {
      $('.failed_result').addClass('d-none');
      $('.passed_result').removeClass('d-none');
    }
  });
});

*/

/*

$(function(){

  var requiredCheckboxes = $(':checkbox[required]');

  requiredCheckboxes.change(function(){

      if(requiredCheckboxes.is(':checked')) {
          requiredCheckboxes.removeAttr('required');
      }

      else {
          requiredCheckboxes.attr('required', 'required');
      }
  });

}); */

$(function() {
  var requiredCheckboxes = $(':checkbox[required]');

  requiredCheckboxes.change(function() {
    var group = $(this).closest('.question-div'); // Find the parent group

    var groupCheckboxes = group.find(':checkbox[required]'); // Find checkboxes within the group

    if (groupCheckboxes.is(':checked')) {
      groupCheckboxes.removeAttr('required');
    } else {
      groupCheckboxes.attr('required', 'required');
    }
  });
});



/*
$(".wrong-custom-button").on('click', function(event){
      
current_errors = $('#is_wrong').val();
current_errors = current_errors+1;

});  */

///////////////////
/* ERROR ALERT COMMENTED */
////////////////////

/*
$(".wrong-custom-button").on('click', function(event){
      
  $('.error-message').removeClass('d-none');
  $('#nextBtn').prop('disabled', true);

  Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Sorry! You are not eligible for this treatment.',
      confirmButtonText: 'Go Back'
    }).then((result) => {
      
        //window.location.href = '/steps';

});

}); 

$(document).ready(function() {
  $('label').on('click', function() {
    if (!$(this).hasClass('wrong-custom-button')) {

      $('.error-message').addClass('d-none');

      if($('input[type="radio"].wrong-input:checked').length == 0){

      $('#nextBtn').prop('disabled', false);

      }

      if($('input[type="checkbox"].wrong-input:checked').length == 0){

      $('#nextBtn').prop('disabled', false);

      }
    }
  });
});

*/

///////////////////
/* ERROR ALERT COMMENTED */
////////////////////

// const radioInputs = document.querySelectorAll('.custom-radio-circle');

// for (let i = 0; i < radioInputs.length; i++) {
//   radioInputs[i].addEventListener('change', function() {
//     const outerLabel = this.parentElement;
//     const allLabels = document.querySelectorAll('.button-container');
    
//     for (let j = 0; j < allLabels.length; j++) {
//       allLabels[j].classList.remove('checked');
//     }
    
//     if (this.checked) {
//       outerLabel.classList.add('checked');
//     }
//   });
// }

const erectionOptions = document.querySelectorAll('.morning-section-input');
for (let i = 0; i < erectionOptions.length; i++) {
  erectionOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.morning-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const treatedOptions = document.querySelectorAll('.treated-section-input');
for (let i = 0; i < treatedOptions.length; i++) {
  treatedOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.treated-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}


const slidenafilOptions = document.querySelectorAll('.slidenafil-section-input');
for (let i = 0; i < slidenafilOptions.length; i++) {
  slidenafilOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.slidenafil-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const surgeryOptions = document.querySelectorAll('.surgery-section-input');
for (let i = 0; i < surgeryOptions.length; i++) {
  surgeryOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.surgery-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const symptomsOptions = document.querySelectorAll('.symptoms-section-input');
for (let i = 0; i < symptomsOptions.length; i++) {
  symptomsOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.symptoms-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const shortnessOptions = document.querySelectorAll('.shortness-section-input');
for (let i = 0; i < shortnessOptions.length; i++) {
  shortnessOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.shortness-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const diagnoseOptions = document.querySelectorAll('.diagnose-section-input');
for (let i = 0; i < diagnoseOptions.length; i++) {
  diagnoseOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.diagnose-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const medEDOptions = document.querySelectorAll('.med-ed-input');
for (let i = 0; i < medEDOptions.length; i++) {
  medEDOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.med-ed-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const drugEDOptions = document.querySelectorAll('.drug-ed-input');
for (let i = 0; i < drugEDOptions.length; i++) {
  drugEDOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.drug-ed-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const agreeOptions = document.querySelectorAll('.agree-ed-input');
for (let i = 0; i < agreeOptions.length; i++) {
  agreeOptions[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.agree-ed-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

  
  const questionOptions = document.querySelectorAll('.questions-ed-input');
  for (let i = 0; i < questionOptions.length; i++) {
    questionOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.questions-ed-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const dUtiOptions = document.querySelectorAll('.d-uti-input');
  for (let i = 0; i < dUtiOptions.length; i++) {
    dUtiOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.d-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const sUtiOptions = document.querySelectorAll('.symptoms-uti-input');
  for (let i = 0; i < sUtiOptions.length; i++) {
    sUtiOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.symptoms-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const vUtiOptions = document.querySelectorAll('.vaginal-uti-input');
  for (let i = 0; i < vUtiOptions.length; i++) {
    vUtiOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.vaginal-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const cUtiOptions = document.querySelectorAll('.condition-uti-input');
  for (let i = 0; i < cUtiOptions.length; i++) {
    cUtiOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.condition-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const utiUtiOptions = document.querySelectorAll('.uti-uti-input');
  for (let i = 0; i < utiUtiOptions.length; i++) {
    utiUtiOptions[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.uti-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }


  const surgeryUtiSection = document.querySelectorAll('.surgery-uti-input');
  for (let i = 0; i < surgeryUtiSection.length; i++) {
    surgeryUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.surgery-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const stoneUtiSection = document.querySelectorAll('.stone-uti-input');
  for (let i = 0; i < stoneUtiSection.length; i++) {
    stoneUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.stone-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const bladderUtiSection = document.querySelectorAll('.bladder-uti-input');
  for (let i = 0; i < bladderUtiSection.length; i++) {
    bladderUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.bladder-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const pregnantUtiSection = document.querySelectorAll('.pregnant-uti-input');
  for (let i = 0; i < pregnantUtiSection.length; i++) {
    pregnantUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.pregnant-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const allergicUtiSection = document.querySelectorAll('.allergic-uti-input');
  for (let i = 0; i < allergicUtiSection.length; i++) {
    allergicUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.allergic-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }


  const medsUtiSection = document.querySelectorAll('.meds-uti-input');
  for (let i = 0; i < medsUtiSection.length; i++) {
    medsUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.meds-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const sympHang = document.querySelectorAll('.symptoms-hang-input');
  for (let i = 0; i < sympHang.length; i++) {
    sympHang[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.symptoms-hang-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const agreeUtiSection = document.querySelectorAll('.agree-uti-input');
  for (let i = 0; i < agreeUtiSection.length; i++) {
    agreeUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.agree-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }

  const questionUtiSection = document.querySelectorAll('.qustions-uti-input');
  for (let i = 0; i < questionUtiSection.length; i++) {
    questionUtiSection[i].addEventListener('change', function() {
      const outerLabel = this.parentElement;
      const allLabels = document.querySelectorAll('.qustions-uti-section');
      
      for (let j = 0; j < allLabels.length; j++) {
        allLabels[j].classList.remove('checked');
      }
      
      if (this.checked) {
        outerLabel.classList.add('checked');
      }
    });
  }
  const hangDiagnose = document.querySelectorAll('.hang-diagnosed-input');
for (let i = 0; i < hangDiagnose.length; i++) {
  hangDiagnose[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-diagnosed-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}


const hangPreg = document.querySelectorAll('.hang-preg-input');
for (let i = 0; i < hangPreg.length; i++) {
  hangPreg[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-preg-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}
  
const hangallergic = document.querySelectorAll('.hang-allergic-input');
for (let i = 0; i < hangallergic.length; i++) {
  hangallergic[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-allergic-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const hangMedications = document.querySelectorAll('.hang-medications-input');
for (let i = 0; i < hangMedications.length; i++) {
  hangMedications[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-medications-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const hangOTC = document.querySelectorAll('.hang-OTC-input');
for (let i = 0; i < hangOTC.length; i++) {
  hangOTC[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-OTC-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const hangAgree = document.querySelectorAll('.hang-agree-input');
for (let i = 0; i < hangAgree.length; i++) {
  hangAgree[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-agree-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

const hangProvider = document.querySelectorAll('.hang-provider-input');
for (let i = 0; i < hangProvider.length; i++) {
  hangProvider[i].addEventListener('change', function() {
    const outerLabel = this.parentElement;
    const allLabels = document.querySelectorAll('.hang-provider-section');
    
    for (let j = 0; j < allLabels.length; j++) {
      allLabels[j].classList.remove('checked');
    }
    
    if (this.checked) {
      outerLabel.classList.add('checked');
    }
  });
}

function validateStep(step) {
  const stepDiv = document.getElementById(`step-${step}`);
  const requiredFields = stepDiv.querySelectorAll("[required]");
  let isValid = true;
  let radioGroups = {};
  let checkboxGroups = {};

  for (let field of requiredFields) {
    if (field.type === "radio") {
      if (!radioGroups[field.name]) {
        radioGroups[field.name] = [];
      }
      radioGroups[field.name].push(field);
    } else if (field.type === "checkbox") {
      if (!checkboxGroups[field.name]) {
        checkboxGroups[field.name] = [];
      }
      checkboxGroups[field.name].push(field);
    } else {
      if (!field.value.trim()) {
        isValid = false;
        field.style.borderColor = "red";
      } else {
        field.style.borderColor = ""; // Reset the border color when the field is filled
      }
    }
  }

  // Check radio button groups
  for (let groupName in radioGroups) {
    const radios = radioGroups[groupName];
    const checkedRadio = radios.find(radio => radio.checked);
    if (!checkedRadio) {
      isValid = false;
      radios.forEach(radio => radio.parentNode.style.borderColor = "red");
    } else {
      radios.forEach(radio => radio.parentNode.style.borderColor = "");
    }
  }

  // Check checkbox groups
  for (let groupName in checkboxGroups) {
    const checkboxes = checkboxGroups[groupName];
    const checkedCheckbox = checkboxes.find(checkbox => checkbox.checked);
    if (!checkedCheckbox) {
      isValid = false;
      checkboxes.forEach(checkbox => checkbox.parentNode.style.borderColor = "red");
    } else {
      checkboxes.forEach(checkbox => checkbox.parentNode.style.borderColor = "");
    }
  }

  return isValid;
}


$("#state").change(function() {

  if(this.value === 'Coming To Nevada'){
    //$('.nevada_options').removeClass('d-none');
    $('#nevada_delivery_address').removeClass('d-none');
    $('#arrival_date').removeClass('d-none');
    $('#nevada_delivery_address').removeClass('col-md-12');
    $('#nevada_delivery_address').addClass('col-md-6');
    
  }else{
    $('#nevada_delivery_address').removeClass('d-none');
    $('#nevada_delivery_address').removeClass('col-md-6');
    $('#nevada_delivery_address').addClass('col-md-12');
    $('#arrival_date').addClass('d-none');
  }

});

/*
$(document).ready(function() {
  // Attach a change event listener to all checkboxes within the same parent container
  $('.question-div').find('input[type="checkbox"]').change(function() {
    var checkboxGroup = $(this).closest('.question-div').find('input[type="checkbox"]');
    var lastOption = checkboxGroup.last();

    var anyChecked = false;

    // Check if any checkbox within the group is checked
    checkboxGroup.each(function() {
      if ($(this).is(':checked')) {
        anyChecked = true;
        return false; // Exit the loop if a checked checkbox is found
      }
    });

    // Hide or show the last option based on the checked status
    if (anyChecked) {
      lastOption.parent().hide();
    } else {
      lastOption.parent().show();
    }

    // Uncheck all checkboxes within the group if any checkbox is checked
    if ($(this).is(':checked')) {
      checkboxGroup.prop('checked', false);
    }
  });
}); */ 


function hideNoOption(){


    var checkboxGroup = $(this).closest('.question-div').find('input[type="checkbox"]');
    var lastOption = checkboxGroup.last();

    var anyChecked = false;

    // Check if any checkbox within the group is checked
    checkboxGroup.each(function() {
      if ($(this).is(':checked')) {
        anyChecked = true;
        return false; // Exit the loop if a checked checkbox is found
      }
    });

    // Hide or show the last option based on the checked status
    if (anyChecked) {
      lastOption.parent().hide();
    } else {
      lastOption.parent().show();
    }

    // Uncheck all checkboxes within the group if any checkbox is checked
    if ($(this).is(':checked')) {
      checkboxGroup.prop('checked', false);
    }


}

//logic for no or none of the above options
/*
$(document).ready(function() {
  $('input[type="checkbox"]').on('change', function() {
    var currentCheckbox = $(this);
    var checkBoxGroup = $(this).closest('.question-div').find('input[type="checkbox"]');
    var noOptionCheckbox = checkBoxGroup.filter(function() {
      return this.value.toLowerCase().includes('none');
    });

    if (currentCheckbox[0] == noOptionCheckbox[0]) {
      if (currentCheckbox.is(':checked')) {
        checkBoxGroup.not(noOptionCheckbox).prop('checked', false);
      }
    } else {
      if (currentCheckbox.is(':checked')) {
        noOptionCheckbox.prop('checked', false);
      }
    }
  });
});
*/

/*
$(document).ready(function() {
  $('input[type="checkbox"]').on('change', function() {
    var currentCheckbox = $(this);
    var checkBoxGroup = $(this).closest('.question-div').find('input[type="checkbox"]');
    var noOptionCheckbox = checkBoxGroup.filter(function() { 
      return this.value.toLowerCase() == 'no' || this.value.toLowerCase() == 'none of the above' || this.value.toLowerCase() == 'none of these' || this.value.toLowerCase() == 'none' || this.value.toLowerCase() == 'none of the above apply to me';
    });

    if (currentCheckbox[0] == noOptionCheckbox[0]) {
      if (currentCheckbox.is(':checked')) {
        checkBoxGroup.not(noOptionCheckbox).each(function() {
          // If the checkbox is wrong-input and is checked, decrease the total wrongs count
          if ($(this).hasClass("wrong-input") && $(this).is(":checked")) {
            var totalErrors = parseInt($('#total_wrongs').val()) - 1;
            $('#total_wrongs').val(totalErrors);
            if (totalErrors > 0) {
              $('.failed_result').removeClass('d-none');
              $('.passed_result').addClass('d-none');
            } else {
              $('.failed_result').addClass('d-none');
              $('.passed_result').removeClass('d-none');
            }
          }
        }).prop('checked', false);
      }
    } else {
      if (currentCheckbox.is(':checked')) {
        noOptionCheckbox.prop('checked', false);
      }
    }
  });
});

*/
//ending logic

$(document).ready(function() {
  var selectedValues = {};

  $('input[type="checkbox"], input[type="radio"]').on('change', function() {
    var name = $(this).attr("name");

    // Logic for error count
    var currentCheckbox = $(this);
    var checkBoxGroup = $(this).closest('.question-div').find('input[type="checkbox"]');
    var noOptionCheckbox = checkBoxGroup.filter(function() { 
      return this.value.toLowerCase() == 'no' || this.value.toLowerCase() == 'none of the above' || this.value.toLowerCase() == 'none of these' || this.value.toLowerCase() == 'none' || this.value.toLowerCase() == 'none of the above apply to me';
    });

    if (currentCheckbox[0] == noOptionCheckbox[0]) {
      if (currentCheckbox.is(':checked')) {
        checkBoxGroup.not(noOptionCheckbox).each(function() {
          // If the checkbox is wrong-input and is checked, decrease the total wrongs count
          if ($(this).hasClass("wrong-input") && $(this).is(":checked")) {
            if (!selectedValues.hasOwnProperty(name)) {
              selectedValues[name] = "";
              selectedValues[name + "_errors"] = 0;
            }

            selectedValues[name + "_errors"]--;

            var totalErrors = 0;
            for (var key in selectedValues) {
              if (key.endsWith("_errors")) {
                totalErrors += selectedValues[key];
              }
            }

            $('#total_wrongs').val(totalErrors);

            if (totalErrors > 0) {
              $('.failed_result').removeClass('d-none');
              $('.passed_result').addClass('d-none');
            } else {
              $('.failed_result').addClass('d-none');
              $('.passed_result').removeClass('d-none');
            }
          }
        }).prop('checked', false);
      }
    } else {
      if (currentCheckbox.is(':checked')) {
        noOptionCheckbox.prop('checked', false);
      }
    }

    // Logic for checking wrong inputs
    if (!selectedValues.hasOwnProperty(name)) {
      selectedValues[name] = "";
      selectedValues[name + "_errors"] = 0;
    }

    // Count the number of errors in this group
    var groupErrors = 0;
    $("input[name='" + name + "']").each(function() {
      if ($(this).hasClass("wrong-input") && $(this).is(":checked")) {
        groupErrors++;
      }
    });

    selectedValues[name + "_errors"] = groupErrors;

    var selectedOptions = $("input[name='" + name + "']:checked").map(function() {
      return $(this).val();
    }).get();

    selectedValues[name] = selectedOptions.join(',');

    var totalErrors = 0;
    for (var key in selectedValues) {
      if (key.endsWith("_errors")) {
        totalErrors += selectedValues[key];
      }
    }

    $('#total_wrongs').val(totalErrors);

    if (totalErrors > 0) {
      $('.failed_result').removeClass('d-none');
      $('.passed_result').addClass('d-none');
    } else {
      $('.failed_result').addClass('d-none');
      $('.passed_result').removeClass('d-none');
    }
  });
});




$(document).ready(function() {
  $('input[name="Please_tell_us_if_you_are_allergic_to_any_medications"]').on('change', function() {
    if($(this).is(':checked')) {
      $('#Are_you_allergic_to_any_other_meds_or_other_allergens').addClass('d-none');
    } else {
      $('#Are_you_allergic_to_any_other_meds_or_other_allergens').removeClass('d-none');
    }
  });
});

$(document).ready(function() {
  $('input[name="Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications,_supplements_you_take_daily"]').on('change', function() {
    if($(this).is(':checked')) {
      $('#Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications_supplements_you_take_daily').addClass('d-none');
    } else {
      $('#Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications_supplements_you_take_daily').removeClass('d-none');
    }
  });
});

$(document).ready(function() {
  $('#If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed').on('change', function() {

    if($(this).is(':checked')) {
      $('#If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed_text').addClass('d-none');
    } else {
      $('#If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed_text').removeClass('d-none');
    }
  });
});

$(document).ready(function() {
  var textarea1 = $('#Are_you_allergic_to_any_other_meds_or_other_allergens');
  var textarea2 = $('#Please_tell_us_the_names_of_all_the_medications_including_names_of_OTC_medications_supplements_you_take_daily');

  textarea1.on('keyup', function() {
    var correspondingCheckbox = $('.hang-medications-input');
    if ($(this).val().trim().length > 0) {
      correspondingCheckbox.removeAttr('required');
    } else {
      correspondingCheckbox.prop('required', true);
    }
  }).trigger('keyup');

  textarea2.on('keyup', function() {
    var correspondingCheckbox = $('.hang-OTC-input');
    if ($(this).val().trim().length > 0) {
      correspondingCheckbox.removeAttr('required');
    } else {
      correspondingCheckbox.prop('required', true);
    }
  }).trigger('keyup');

  $('.hang-medications-input').on('change', function() {
    if ($(this).is(':checked')) {
      textarea1.val('');
      textarea1.removeAttr('required');
    } else {
      textarea1.prop('required', true);
    }
  });

  $('.hang-OTC-input').on('change', function() {
    if ($(this).is(':checked')) {
      textarea2.val('');
      textarea2.removeAttr('required');
    } else {
      textarea2.prop('required', true);
    }
  });
});


$(document).ready(function() {
  var textarea = $('#If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed_text');
  var checkbox = $('#If_you_have_been_successfully_treated_for_a_UTI_before_please_write_down_the_name_of_the_anti_biotic_your_physician_prescribed');

  textarea.on('keyup', function() {
    if ($(this).val().trim().length > 0) {
      checkbox.removeAttr('required');
    } else {
      checkbox.prop('required', true);
    }
  }).trigger('keyup');

  checkbox.on('change', function() {
    if ($(this).is(':checked')) {
      textarea.val('');
      textarea.removeAttr('required');
    } else {
      textarea.prop('required', true);
    }
  });
});


document.addEventListener('DOMContentLoaded', (event) => {
  let removeElements = document.getElementsByClassName('remove_icon');

  for(let i = 0; i < removeElements.length; i++) {
      removeElements[i].addEventListener('click', function(e) {
          e.preventDefault();
          let href = this.getAttribute('href');

          Swal.fire({
              title: 'Are you sure?',
              text: "This addon will be removed from your order!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, remove it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = href;
              }
          })
      });
  }
});


