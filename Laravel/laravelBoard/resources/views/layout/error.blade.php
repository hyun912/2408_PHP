
{{-- 에러메세지가 있는가 --}}
@if($errors->any())
<div id="errMsg" class="form-text text-danger">
  @foreach($errors->all() as $msg)
    <span>{{ $msg }}</span> <br>
  @endforeach
</div>
@endif