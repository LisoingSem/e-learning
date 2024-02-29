@extends('layouts.master')
@section('page_title', 'Role Permission')
@section('directory', 'Role Permission')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('setting.role.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> បកក្រោយ</a>
            </div>
        </div>
       <!-- <form class="row">
            <div class="col-sm-4">
                <label>ប្រព័ន្ធ</label>
                <select name="sys_id" id="sys_id" class="form-control" required>
                    <option value="">-----</option>
                    @foreach($systems as $system)
                    <option value="{{myEncrypt($system->id)}}" @if(request()->sys_id == myEncrypt($system->id)) selected @endif>({{$system->short_name}}){{$system->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <br>
                <button class="btn btn-primary mt-2">បង្ហាញ</button>
            </div>
       </form> -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-bold mt-3"> កំណត់សិទ្ធសម្រាប់តួនាទីជា {{$role->name_kh}} ({{$role->name}})</h4>
            </div>
        </div>
       <div class="row mt-3">
            <div class="col-sm-12">
                @if(isset($mudules))

                <table class="table table-bordered table-striped">
                    <?php $system_id = 0 ?>
                    @foreach($mudules as $module)
                    @if($module->system_id != $system_id)
                    <?php $system_id = $module->system_id ?>
                    <tr class="bg-info">
                        <td class="text-center">{{$module->system_name}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td >{{$module->name}}</td>
                    </tr>
                    <?php 
                        $features = DB::table('system_features')
                        ->where('active', 1)
                        ->where('module_id', $module->id)->get();
                    ?>
                   
                    <tr>
                       
                        <td>
                            @foreach($features as $feature)
                            <label>
                                <input type="checkbox" 
                                    onchange="savePermission(this)" 
                                    role="{{$role_id}}" 
                                    feature="{{($feature->id)}}" 
                                    @if(in_array($feature->id, explode(",", $role->permission))) checked @endif
                                    style="transform: scale(2); -webkit-transform: scale(2);">
                                &nbsp;<a href="{{route('setting.feature_link.index', myEncrypt($feature->id))}}">{{$feature->name}}({{$feature->name_kh}})</a>  &nbsp; &nbsp;
                            </label>
                            @endforeach
                        </td>
                       
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
       </div>
    </div>
</div>
@include('settings.roles.create')
@include('settings.roles.edit')
@endsection

@section('script')
<script>
    $(document).ready(function () {
      
    });

    function savePermission(el){
            var permissions = [];
            $("input[type='checkbox']:checked").each(function(index, element ) {
                permissions.push($(element).attr('feature'));
            })
            let permisData = permissions;
        $.ajax({
            type: 'POST',
            url: "{{route('setting.role_permission.save')}}",
            data: {
                "id":"{{$role_id}}",
                "_token":"{{csrf_token()}}",
                "permission": permisData.join()
            },
            success: function(res)
            {
                if(res.status == 200){
                    showNotifyMessage('Success', res.sms)
                }else{
                    showNotifyMessage('Error', res.sms)
                }
                console.log(res);
            }
        });
    }
    
</script>
@endsection
