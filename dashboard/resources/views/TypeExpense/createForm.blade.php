<form action="{{route('storeTypeAdminExpenses')}}" id="form" method="POST">
    @csrf
    @method('POST')
    <div class="modal-body">
      <div class="row">
        <div class="col-2">
          <label for="">Name:</label>
        </div>
        <div class="col-10">
          <input class="form-control form-control-sm" width="50%" type="text" name="nameType" required>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2">
          <label for="">Category:</label>
        </div>
        <div class="col-10">
          <select class="form-control form-control-sm" aria-label="Default select example" name="category" required>
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->nameCategory}}</option>
            @endforeach
          </select>
        </div>
      </div>
      
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-secondary">Submit</button>
    </div>
  </form>