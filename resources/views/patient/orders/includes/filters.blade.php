<div class="widget-content widget-content-area br-8 p-4 mb-2">
    <b>Filters</b>
    <form method="get" action="/admin/orders" class="row g-3 align-items-center">
        <div class="col-md-4">
            <select class="form-select" name="status">
                <option selected>Choose Status...</option>
                <option>Completed</option>
                <option>In Process</option>
                <option>Rejected</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="date" name="date" class="form-control" placeholder="Filter By Date">
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-primary me-4 btn-lg" value="Filter Now">
        </div>
    </form>
</div>