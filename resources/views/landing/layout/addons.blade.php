<!-- Modal -->
<div class="modal fade" id="addonsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Addons Medicines/Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/add_addons_to_order">
        @csrf
      <div class="modal-body">
        <h4>Choose Items</h4>
        <div class="table-responsive">
        <table class="table">

          <tr>
            <th>Image View</th>
            <th class="align-middle">Item Name</th>
            <th class="align-middle">item Price</th>
            <th class="align-middle">item Description</th>
            <th class="text-center align-middle">Select</th>
          </tr>
          @foreach($items as $itemss)
          <tr>
            <td><img width="40" height="auto" src="{{$itemss->thumbnail}}"></td>
            <td class="align-middle">{{$itemss->item_name}}</td>
            <td class="align-middle">${{$itemss->item_price}}</td>
            <td class="align-middle">{{$itemss->item_description}}</td> 
            <td class="text-center align-middle"><input value="{{$itemss->id}}" type="checkbox" name="selected_items[]"></td>
          </tr>
          <input type="hidden" name="selected_item_price[]" value="{{$itemss->item_price}}">
          @endforeach
          
          <input type="hidden" value="{{ $id }}" name="order_id">

        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No Thanks</button>
        <button type="submit" class="btn btn-primary">Add To Order</button>
      </div>
      </form>
    </div>
  </div>
</div>