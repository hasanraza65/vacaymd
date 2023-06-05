<div class="widget-content widget-content-area br-8 p-4 mb-2">
    <b>Filters</b>
    <form method="get" action="/pharmacy/orders" class="row g-3 align-items-center">
       
         @if(isset($_GET['active_tab']))
            <input value="{{$_GET['active_tab']}}" type="hidden" id="active_tab" name="active_tab">
        @else
            <input value="latest_orders" type="hidden" id="active_tab" name="active_tab">
        @endif

        @if(isset($_GET['active_btn']))
            <input value="{{$_GET['active_btn']}}" type="hidden" id="active_btn" name="active_btn">
        @else
            <input value="new-orders-btn" type="hidden" id="active_btn" name="active_btn">
        @endif
        
        <div class="row mt-4">
            <div class="col-md-3">
                <input name="start_date" class="form-control" type="text" placeholder="Start Date" onfocus="(this.type='date')">
            </div>
            <div class="col-md-3">
                <input name="end_date" class="form-control" type="text" placeholder="End Date" onfocus="(this.type='date')">
            </div>
            <div class="col-md-3">
                <input type="submit" class="btn btn-primary me-4 btn-lg" value="Filter Now">
            </div>
        </div>
    </form>
</div>