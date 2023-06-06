<div class="widget-content widget-content-area br-8 p-4 mb-2">
    <b>Filters</b>
    <form method="get" action="/admin/orders" class="row g-3 align-items-center">
        <div class="col-md-4">
            <select class="form-select" name="status">
                <option selected value="">Choose Status...</option>
    

                <option>Completed</option>
                <option>Approved</option>
                <option>Cancelled</option>
                <option>Pending</option>
                <option>In Process</option>
                <option>Rejected</option>
            </select>
        </div>
        <div class="col-md-4">
        <input type="text" name="start_date" class="form-control" placeholder="Start date" onfocus="(this.type='date')" onblur="(this.type='text')" value="">
        </div>

        <div class="col-md-4">
            <input type="text" name="end_date" class="form-control" placeholder="End date" onfocus="(this.type='date')" onblur="(this.type='text')" value="">
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-primary me-4" value="Filter Now">
        </div>
    </form>
</div>