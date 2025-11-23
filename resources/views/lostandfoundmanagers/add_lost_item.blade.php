@extends('layout.managers')

@section('title', 'Add Lost Item')
@section('page-title', 'Add Lost Item')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Record Lost Item</div>
        </div>
        <form action="{{ route('lfm.lost.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="d-flex">
                    <div class="w-75">
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Select Item</label>
                            <select name="item_id" class="form-control" required>
                                <option value="">-- Select Item --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                                    <label for="type" class="form-label">Item type</label>
                                    <input required type="text" name="type" class="form-control" value={{ old('type') }} >
                                </div>
                        <div class="mb-3">
                            <label for="date_lost" class="form-label">Date and time lost</label>
                            <input type="datetime-local" name="date_lost" class="form-control" value="{{ old('date_lost') }}"required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Place Lost</label>
                            <input type="text" name="place_lost" class="form-control" value="{{ old('place_lost') }}" required>
                        </div>
                    </div>
                    <div class="w-75">
                        <img id="file_preview" src="{{ asset('favicon.png') }}" class="w-50">                        
                    </div>
                </div>
                <div class="mb-3">
    <label for="description" class="form-label">Description (optional)</label>
    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
</div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL (optional)</label>
                    <input type="file" name="image_url" id="image_url" class="form-control"{{ old('image_url') }}>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="bi-icons bi-save"></i> Submit
                </button>
            </div>
        </form>
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