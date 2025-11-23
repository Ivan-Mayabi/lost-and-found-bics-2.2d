@extends('layout.managers')

@section('title', 'Edit Lost Item')

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h4>Edit Lost Item</h4>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('lfm.lostitems.update', $lostItem->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="d-flex">
        <div class="w-75">
          <div class="form-group mb-3">
            <label for="item_id">Select Item</label>
            <select name="item_id" class="form-control" required>
              @foreach($items as $item)
                <option value="{{ $item->id }}" {{ $lostItem->item_id == $item->id ? 'selected' : '' }}>
                  {{ $item->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="date_lost">Date Lost</label>
            <input type="datetime-local" name="date_lost" class="form-control" value="{{ old('date_lost', $lostItem->date_lost) }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="place_lost">Place Lost</label>
            <input type="text" name="place_lost" class="form-control" value="{{ old('place_lost', $lostItem->place_lost) }}" required>
          </div>
        </div class="w-25">
          <img id="file_preview" src="{{ asset('favicon.png') }}" class="w-25"> 
        <div>

        </div>
      </div>
      

      <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $lostItem->description) }}</textarea>
      </div>

      <div class="form-group mb-3">
        <label for="image_url">Image URL</label>
        <input type="file" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $lostItem->image_url) }}">
      </div>

      <button type="submit" class="btn btn-primary">Update Lost Item</button>
      <a href="{{ route('lfm.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
    //Our two objects, the image and the file input
    const image_url = document.getElementById("image_url");
    const file_preview = document.getElementById("file_preview");

    //A listener detecting any change to file input
    image_url.addEventListener("change",function(){
        //If any change, get the first file
        const file = this.files[0];
        if(file){
            //If there is any file, read its content
            const reader= new FileReader();
            //Read the file as a DataURL so that it can be sent to the server
            reader.readAsDataURL(file);
            //Once the file's content has been read, change the content of the image to be what is heree
            reader.onload = function(e){
                file_preview.src = e.target.result;
            }
        }
    });
</script>
@endpush
