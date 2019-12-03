@csrf
<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">   
   <div class="form-group">
      <label for="title">Name</label>
      <input type="text" name="name" class="form-control" id="title" @isset($product) value="{{ ($product->name != '') ? $product->name : ''}}" @endisset>
      <small id="emailHelp" class="form-text text-danger">{{$errors->first('title')}}</small>
   </div>
</div>
<div class="form-group {{$errors->has('model') ? 'has-error' : ''}}">
  <label for="model">Model</label>
  <input type="text"
    class="form-control" name="model" id="model" aria-describedby="helpId" placeholder="" @isset($product) value="{{ ($product->model != '') ? $product->model : ''}}" @endisset>
  <small id="helpId" class="form-text text-muted">{{$errors->first('model')}}</small>
</div>
<div class="form-group {{$errors->has('model') ? 'has-error' : ''}}">
  <label for="harga">Price</label>
  <input type="text"
    class="form-control" name="price" id="harga" aria-describedby="helpId" placeholder="" @isset($product) value="{{ ($product->price != '') ? $product->price : ''}}" @endisset>
  <small id="helpId" class="form-text text-muted">{{$errors->first('harga')}}</small>
</div>
<div class="form-group {{$errors->has('parent_id') ? 'has-error' : ''}}">
   <div class="form-group">
      <label for="category_lists">Categories</label>
      <select name="category_lists[]" class="form-control selectize-multiple" id="category_lists" multiple>
         @if(empty($product)) 
         <option disabled selected value> -- select an Category -- </option>
            @foreach (App\Category::all() as $item)               
               <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
         @else
            @foreach (App\Category::all() as $item)
               @if (in_array($item->id, $product->categories->pluck('id')->all()))
                  <option value="{{$item->id}}" selected>{{$item->title}}</option>   
               @else
                  <option value="{{$item->id}}">{{$item->title}}</option>
               @endif
            @endforeach 
         @endif
      </select>
      <small id="helpId" class="form-text text-muted">{{$errors->first('category_lists')}}</small>
   </div>
</div>
<div class="form-group">
  <label for="photo">Photo</label>
  <input type="file" class="form-control-file" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId">
  <small id="helpId" class="form-text text-muted">{{$errors->first('photo')}}</small>
</div>
@if (isset($product) && $product->photo !== null)    
<div class="row">
   <div class="col-md-6">
      <p>Current photo:</p>
      <div class="thumbnail">
         <img src="{{ url('/img/' . $product->photo) }}" class="img-rounded">
      </div>
   </div>
</div>
@endif
<button type="submit" class="btn btn-primary">{{ empty($product) ? 'Save' : 'Update'}}</button>