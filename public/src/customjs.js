function deleteFunction(id=null, route=null) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            //var id = $(el).data('id');
            $.ajax({
                type: 'DELETE',
                url: route,
                data: {
                    
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
                },
                success: function(data) {
                    
                    $('#row_'+id).remove();
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    );
                }
            });
        }
    })
}

//order form conditional fields function

function orderFormCondition(problem=null){

    $('#error_msg').addClass('d-none');

    $('.uti_form').addClass('d-none');
    $('.uti_terms').addClass('d-none');
    $('.ed_form').addClass('d-none');
    $('.ed_terms').addClass('d-none');
    $('.hangover_form').addClass('d-none');
    $('.hangover_terms').addClass('d-none');
    $('.ed_terms').addClass('d-none');
    $('.uticard').css('background-color','white');
    $('.edcard').css('background-color','white');
    $('.hangovercard').css('background-color','white');
    $('#agree_terms_1').prop('required',false);
    $('#agree_terms_2').prop('required',false);
    $('#agree_terms_3').prop('required',false);

    if(problem == 'UTI'){

        $('.uti_form').removeClass('d-none');
        $('.uti_terms').removeClass('d-none');
        $('.btn-nxt').prop('disabled', false);
        $('.uticard').css('background-color','#aaffbe');
        $('#agree_terms_1').prop('required',true);


    }else if(problem == 'ED'){

        $('.ed_form').removeClass('d-none');
        $('.ed_terms').removeClass('d-none');
        $('.btn-nxt').prop('disabled', false);
        $('.edcard').css('background-color','#aaffbe');
        $('#agree_terms_2').prop('required',true);


    }else if(problem == 'HANGOVER'){

        $('.hangover_form').removeClass('d-none');
        $('.hangover_terms').removeClass('d-none');
        $('.btn-nxt').prop('disabled', false);
        $('.hangovercard').css('background-color','#aaffbe');
        $('#agree_terms_3').prop('required',true);

        
    }

}

function toggleMedsField(option){

    if (option == 'yes') {
        $('#meds-allergy').removeClass('d-none');
    }
    else if (option == 'no') {
        $('#meds-allergy').addClass('d-none');
    }

}

//ending order form conditional fields function

function approveAlert() {
    Swal.fire({
        title: 'Are you sure to approve this?',
        text: 'Patient will be charged after this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approve It!',
        html: `
                       <label class="button-container custom-register-checkbox-container w-100 mb-2 mt-4">
                            <input type="checkbox" class="custom-radio-circle " name="confirm" id="radioConfirm" value="confirm" required>
                            <label class="mouse-none" for="radioConfirm" style="font-weight: normal; margin-right: 10px;">
                            Patient ID matches all information 
                                
                            </label>
                        </label>
           
        `,
        preConfirm: () => {
            const confirmRadio = document.getElementById('radioConfirm');
            if (!confirmRadio.checked) {
                Swal.showValidationMessage('Please confirm that patient ID matches all information .');
            }
            return {
                confirm: confirmRadio.checked
            };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value.confirm) {
            $("#confirm_patient_id").val('on');
            document.getElementById('approve-form').submit();
        }
    });
    
}

function rejectAlert() {
    Swal.fire({
        title: 'Are you sure to reject this?',
        //text: "Patient will be charged after this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject It!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('reject-form').submit();
        }
    });
}

function sendMessage(profile_pic,sender_name,order_id,user_role){
var userrole = '';
if(user_role == 2){

    userrole = 'doctor';

}else{

    userrole = 'patient';
}
message = $('#message_text').val();
    var route = '';
    if(user_role == 2){
    route = '/doctor/sendmessage';
    }else if(user_role == 4){
    route = '/patient/sendmessage';
    }

    $.ajax({
        type: 'POST',
        url: route,
        data: {
            message:message,
            order_id:order_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
        },
        success: function(data) {
            // Use the returned message ID
        var message_id = data.message_id;

        // Update your message_text variable with the new message ID
        var message_text = `<div id="row_${message_id}" data-id="${message_id}" class="messages_texts_div">
                            <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
                            <img class="rounded" src="${profile_pic}" alt="pic1">
                            <div class="media-body">
                                <h4 class="media-heading">${sender_name}</h4>
                                <p class="media-text">${message}</p>
                            </div>
                            </div>

                                <div id="action_btn_div${message_id}" class="action_btn_div d-none">
                            
                                    <span onclick="editMessage('${message}',${message_id})" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                    <span onclick="deleteFunction(${message_id},'/${userrole}/messages/${message_id}')" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> 

                                </div>

                            </div>`;

        $('.msgs_appending_div').append(message_text);
          
        }
    });


    $('#message_text').val('');


    Snackbar.show({text: 'Message Sent!', actionTextColor: '#fff', backgroundColor: '#00ab55'});

}
function getMessage(order_id,user_role){
    var route = '';
    if(user_role == 2){
    route = '/doctor/getmessages';
    }else if(user_role == 4){
    route = '/patient/getmessages';
    }
    let timerInterval
    Swal.fire({
    title: 'Fetching Messages!',
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    })
   
   
    $('.msgs_appending_div').html('');
        $.ajax({
            type: 'POST',
            url: route,
            data: {
                order_id:order_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),   
            },
            success: function(response) {
            response.m.forEach(data => {
            
                // Use the returned message ID
            var message_id = data.id;
            var createdAt = new Date(data.created_at);
    var dateof = createdAt.toLocaleDateString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: 'numeric'
    });
            // Update your message_text variable with the new message ID
            var message_text = `<div id="row_${message_id}" data-id="${message_id}" class="messages_texts_div">
                                <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
                                <img class="rounded" src="${data.user_detail.profile_pic ?? '/src/assets/img/default_pic.webp'}" alt="pic1">
                                <div class="media-body">
                                    <h4 class="media-heading">${data.user_detail.user_role==2 ? 'Doctor':'Patient'} : ${data.user_detail.name}</h4>
                                    <span class="message_date mb-4">${dateof}</span>
                                    <p class="media-text">${data.message}</p>
                                </div>
                                </div>
    
                                    <div id="action_btn_div${message_id}" class="action_btn_div d-none">
                                
                                        <span onclick="editMessage('${data.message}',${message_id})" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                        <span onclick="deleteFunction(${message_id},'/${user_role}/messages/${message_id}')" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> 
    
                                    </div>
    
                                </div>`;
            
            $('.msgs_appending_div').append(message_text);
                
            });    
                
              
            }
        });
    
    
        $('#message_text').val('');
    
    
        //Snackbar.show({text: 'Message Sent!', actionTextColor: '#fff', backgroundColor: '#00ab55'});
     

    }
    
$(document).ready(function() {
$('.messages_texts_div').hover(
    function() {
        // Mouseenter event handler
        var message_id = $(this).data('id');
        $('#action_btn_div'+message_id).removeClass('d-none');
    },
    function() {
        // Mouseleave event handler
        var message_id = $(this).data('id');
        $('#action_btn_div'+message_id).addClass('d-none');
    }
);
});

function editMessage(message,message_id){

    $('#editMsgModal').modal('show');
    $('#update_message_text').val('');

    $('#update_message_text').val(message);
    $('#message_id').val(message_id);

}

//profile pic upload function
document.addEventListener('DOMContentLoaded', function() {
    var imgInp = document.getElementById('imgInp');
    var progressText = document.getElementById('progress-text');
  
    imgInp.addEventListener('change', function() {
      progressText.textContent = 'Uploading...';
  
      var form = new FormData();
      form.append('file', imgInp.files[0]);
  
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '/update-profile-pic', true);
      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
  
      xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
          var progress = Math.round((e.loaded / e.total) * 100);
          progressText.textContent = 'Uploading: ' + progress + '%. Please do not reload page.';
        }
      };
  
      xhr.onload = function() {
        if (xhr.status === 200) {
          progressText.textContent = 'Upload complete';
          location.reload();
        } else {
          progressText.textContent = 'Error uploading file. Please try again later.';
          alert('Error uploading file. Please try again later.');
        }
      };
  
      xhr.send(form);
    });
  });
//ending profile pic upload function  