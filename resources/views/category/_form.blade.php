@csrf
<div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">   
   <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" id="title" @isset($category) value="{{ ($category->title != '') ? $category->title : ''}}" @endisset>
      <small id="emailHelp" class="form-text text-danger">{{$errors->first('title')}}</small>
   </div>
</div>
<div class="form-group {{$errors->has('parent_id') ? 'has-error' : ''}}">
   <div class="form-group">
      <label for="parent_id">Parent</label>
      <select name="parent_id" class="form-control" id="parent_id">
         <option disabled selected value> -- select an Parent Category -- </option>
         @if(empty($category)) 
            @foreach (App\Category::all() as $item)               
               <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
         @else
            @foreach (App\Category::all() as $item)
               @if ($category->parent_id == $item->id)
                  <option value="{{$item->id}}" selected>{{$item->title}}</option>   
               @else
                  <option value="{{$item->id}}">{{$item->title}}</option>
               @endif
            @endforeach 
         @endif
      </select>
   </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>