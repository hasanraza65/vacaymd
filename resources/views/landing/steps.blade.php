@include('landing.layout.header')


@if(isset($_GET['type']) && $_GET['type'] == 'uti')

@include('landing.includes.uti')

@elseif(isset($_GET['type']) && $_GET['type'] == 'ed')

@include('landing.includes.ed')

@elseif(isset($_GET['type']) && $_GET['type'] == 'hangover')

@include('landing.includes.hang')

@else 

<div class="container mb-4" style="margin-left:auto; margin-right:auto; margin-top: 100px">
		<b class="p-2"><label style="text-align: left" class="display-4">Looking for Treatment?</label></b>
		<div class="row mt-4">
			<div class="col-md-12 mb-2 justify-content-between">
				<a href="/steps?type=ed" class="btn btn-custom w-100 py-2 px-2 ps-3 m-2"><span><b>Erectile Dysfunction</b> (ED) Treatment</span> <span><button class="read-more-button">Read More</button></span></a>
			</div>
			<div class="col-md-12 mb-2">
				<a href="/steps?type=uti" class="btn btn-custom w-100 py-2 px-2 ps-3 m-2"><span>Uncomplicated and Complicated <b>UTIs</b></span> <span><button class="read-more-button">Read More</button></span></a>
			</div>
			<div class="col-md-12 mb-2">
				<a href="/steps?type=hangover" class="btn btn-custom w-100 py-2 px-2 ps-3 m-2"><span><b>Hangover</b> with Prescription Strength Medications</span> <span><button class="read-more-button">Read More</button></span></a>
			</div>
		</div>
	</div>

@endif


<input type="hidden" value="0" id="total_wrongs" class="form-control m-4">


@include('landing.layout.footer')