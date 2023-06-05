<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-kZAyZR6UxpnJ+KryoMmUz5l/6en8XCp+HHAAK5GSLf2xlYtvJ8U2Q4U+9cuEnJoa3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

<style>
    .textarea-container {
        position: relative;
    }

    textarea {
        padding-right: 2.5rem;
    }

    .attach-icon {
        position: absolute;
        bottom: 0.5rem;
        right: 0.5rem;
        width: 1.5rem;
        height: 1.5rem;
        cursor: pointer;
    }
</style>

<div class="widget-content widget-content-area br-8 p-4">
    <b>Chat</b>
    
    <div class="messages">
        
        <div class="msgs_appending_div">
        @foreach($messages as $messages_data)
        <div id="row_{{$messages_data->id}}" data-id="{{$messages_data->id}}" class="messages_texts_div">
            
            <!-- message box -->
            <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
                <img class="rounded" src="{{ empty($messages_data->userDetail->profile_pic) ? '/src/assets/img/default_pic.webp' : $messages_data->userDetail->profile_pic }}" alt="pic1">
                <div class="media-body">
                    <?php $messageRole=App\Http\Controllers\AuthController::getUserRole($messages_data->user_id);
                    if($messageRole->user_role==2){
                        $sendername='Doctor';
                    }else if($messageRole->user_role==4){
                        $sendername='Patient';
                    }else{
                        $sendername='';
                    }
                    
                    ?>
                    <h4 class="media-heading"><?=$sendername;?>: {{$messages_data->userDetail->name}}</h4>
                    <span class="message_date mb-4">{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</span>
                    <p id="media-text{{$messages_data->id}}" class="media-text mt-2">{{$messages_data->message}}</p>
                </div>
                @if($messages_data->user_id == Auth::user()->id)
                <div id="action_btn_div{{$messages_data->id}}" class="action_btn_div d-none">
                    
                    <span onclick="editMessage('{{$messages_data->message}}',{{$messages_data->id}})" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                    <span onclick="deleteFunction({{$messages_data->id}},'/patient/messages/{{$messages_data->id}}')" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> 

                </div>
                @endif
            </div>
            <!--- message box ending --->
            
        </div>
        @endforeach
        </div>

        <!--- textarea ---> 

        <div class="textarea-container mt-4">
            <textarea name="message" id="message_text" class="form-control" rows="5" placeholder="Write your message here..."></textarea>

               <!--- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attach-icon"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                --->
        </div>
        @if(Auth::user()->profile_pic == null || Auth::user()->profile_pic == "")
        @php 
        $profile_pic = '/src/assets/img/default_pic.webp';
        @endphp
        @else
        @php 
        $profile_pic = Auth::user()->profile_pic;
        @endphp
        @endif
        <input onclick="sendMessage('{{$profile_pic}}', '{{Auth::user()->name}}',{{$data->id}},{{Auth::user()->user_role}})" type="button" class="btn btn-primary mt-2 mb-2" value="Send Message">
        <button onclick="getMessage({{$data->id}},{{Auth::user()->user_role}})" class="btn btn-outline-success">Refresh</button>
        <!--- ending textarea --->
    
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="editMsgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/patient/updatemessage" method="POST">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Message</h5>
                <button style="color:black" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> X </svg>
                </button>
            </div>
            <div class="modal-body">
                
                <textarea name="message" id="update_message_text" class="form-control" rows="5" placeholder="Write your message here..."></textarea>
                <input type="hidden" value="" name="message_id" id="message_id">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
    </div>
</div>