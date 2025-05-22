@foreach($children as $cat)                             
<div class="tree-item active {{ ($cat->children)?'has-children':''   }}">
    <i class="expand-icon"></i><i class="icon folder-icon"></i>
    <span class="checkbox2">
        @if(count($cat->children)>0)
        <span for="1">{{$cat->name}}</span>
        @else
        <input type="radio" id="{{$cat->id}}" name="parent" value="{{$cat->id}}"> 
        <label for="1" class="checkbox-view"></label> 
        <span for="1">{{$cat->name}}</span>
        @endif
    </span>    
    @if(count($cat->children))
     @include('admin.ap.courseChild',['children' => $cat->children])
    @endif                                
    </div>
@endforeach