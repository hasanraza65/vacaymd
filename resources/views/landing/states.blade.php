@include('landing.layout.header')

<form method="get" action="/steps">
<div class="container mb-4" style="margin-left:auto; margin-right:auto; margin-top: 100px">
		<b class="p-2"><label style="text-align: left" class="display-4">Choose a state</label></b>
		<div class="row mt-4">

			<div class="col-md-12 mb-2 justify-content-between">
                <select name="state" style="height:50px!important; font-size:20px!important" class="form-select">
                    @foreach($data as $state)
                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                    @endforeach
                </select>
			</div>
			
		</div>

    <div class="step-buttons mt-4">
            
        <div class="col text-end">
        <button type="submit" class="btn button-custom" id="nextBtn" style="float:right;" onclick="changeStep(1)">Choose Treatment</button>
        </div>
        
    </div>


</div>
</form>


@include('landing.layout.footer')