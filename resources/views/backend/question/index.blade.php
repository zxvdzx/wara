
@extends('backend.layout.layout')

@section('style')
    <style>
        .font-label {
            font-size:20px
        }
        .font-form {
            font-size:14px
        }
        .font-form1 {
            font-size:16px
        }
    </style>
@endsection
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">{{ trans('general.header.question') }}</h3>
            <p class="animated fadeInDown">
                {{ trans('general.header.exercise') }} <span class="fa-angle-right fa"></span> {{ trans('general.header.question') }}
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
            <a class="btn btn-gradient btn-primary"onclick="javascript:show_form_create()" title="{{ trans('general.button.create') }}">{{ trans('general.button.create') }}</a>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="data-tables" class="table table-striped table-bordered table-condensed table-responsive" data-tables="true">
                        <thead>
                            <tr>
                                <th class="center-align">{{ trans('general.table.id') }}</th>
                                <th class="center-align">{{ trans('general.table.update_at') }}</th>
                                <th class="center-align">{{ trans('general.table.category') }}</th>
                                <th class="center-align">{{ trans('general.table.question') }}</th>
                                <th class="center-align" width="5%">{{ trans('general.table.point') }}</th>
                                <th class="center-align" width="20%">{{ trans('general.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="modal fade modal-getstart" id="modalFormData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title FormData-title" id="myModalLabel">{{ trans('general.button.create') }}</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'admin.question.post', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
                    <input type="hidden" name="action" id="action" value="">
                    <input type="hidden" name="id" value="">
                    <div class="col-md-12 panel area-insert-update" style="padding:50px;">
                        <div class="form-group area-insert-update">
                            <label><span style="font-size:18px">{{ trans('general.form.category') }}<span></label>
                            <select class="form-control" name="category_name">
                                @foreach($categories as $k => $val)
                                    <option value="{{ $k }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            <p class="has-error text-danger error-name"></p>
                        </div>
                        <div class="form-group{{ Form::hasError('category_name') }} has-feedback">
                            {!! Form::errorMsg('category_name') !!}
                        </div>
                        <div class="form-group area-insert-update form-animate-text">
                            <input type="text" name="question" class="form-text" required>
                            <span class="bar"></span>
                            <label class="">{{ trans('general.form.question') }}</label>
                            <p class="has-error text-danger error-name"></p>
                        </div>
                        <div class="form-group{{ Form::hasError('question') }} has-feedback">
                            {!! Form::errorMsg('question') !!}
                        </div>
                        <div class="form-group area-insert-update form-animate-text">
                            <input type="number" name="point" class="form-text" required>
                            <span class="bar"></span>
                            <label class="">{{ trans('general.form.point') }}</label>
                            <p class="has-error text-danger error-name"></p>
                        </div>
                        <div class="form-group{{ Form::hasError('point') }} has-feedback">
                            {!! Form::errorMsg('point') !!}
                        </div>
                        <div class="form-group area-insert-update form-animate-checkbox">
                          <input type="checkbox" class="checkbox" onclick="enableFileInput(this.id)" id="is_file" name="is_file">
                          <label>{{ trans('general.form.upload') }}</label>
                        </div>
                        <div class="form-group area-insert-update form-animate-text">
                            <!-- <audio name="audio_name" type="audio/mp3" controls="controls"></audio> -->
                            <input type="file" id="file_name" name="file_name" class="form-text" accept="audio/mp3">
                            <span class="bar"></span>
                            <p class="has-error text-danger error-name"></p>
                        </div>
                        <div class="form-group{{ Form::hasError('file_name') }} has-feedback">
                            {!! Form::errorMsg('file_name') !!}
                        </div>
                        <fieldset>
                            <legend>{{ trans('general.header.mc') }}</legend>
                            <button class="btn btn-xs btn-warning pull-right" onclick="cancelOption()" type="button">{{ trans('general.button.cancel_option') }}</button>
                            <div class="col-md-12 panel" style="padding:50px;">
                                <div>
                                    <div class="form-group area-insert-update form-animate-text col-md-11">
                                        <input type="text" placeholder="option 1" id="mc1" name="mc[0]" class="form-text" required>
                                        <span class="bar"></span>
                                    </div>
                                    <div class="form-group form-animate-checkbox col-md-1">
                                        <input type="checkbox" id="cb1" name="cb[0]" onclick="disableOther(1)" class="checkbox">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group area-insert-update form-animate-text col-md-11">
                                        <input type="text" placeholder="option 2" id="mc2" name="mc[1]" class="form-text" required>
                                        <span class="bar"></span>
                                    </div>
                                    <div class="form-group form-animate-checkbox col-md-1">
                                        <input type="checkbox" id="cb2" name="cb[1]" onclick="disableOther(2)" class="checkbox">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group area-insert-update form-animate-text col-md-11">
                                        <input type="text" placeholder="option 3" id="mc3" name="mc[2]" class="form-text" required>
                                        <span class="bar"></span>
                                    </div>
                                    <div class="form-group form-animate-checkbox col-md-1">
                                        <input type="checkbox" id="cb3" name="cb[2]" onclick="disableOther(3)" class="checkbox">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group area-insert-update form-animate-text col-md-11">
                                        <input type="text" placeholder="option 4" id="mc4" name="mc[3]" class="form-text" required>
                                        <span class="bar"></span>
                                    </div>
                                    <div class="form-group form-animate-checkbox col-md-1">
                                        <input type="checkbox" id="cb4" name="cb[3]" onclick="disableOther(4)" class="checkbox">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group area-delete">
                        <div class="col-md-12">
                            <center>{{ trans('general.messages.delete_confirm') }}</center>
                        </div>
                    </div>
                    <div class="form-group area-insert-update">
                        <center>
                            {!! Form::submit(trans('general.button.save'), ['class' => 'btn btn-primary btn-gradient btn-submit save-data', 'title' => trans('general.button.save'),'disabled' => 'true']) !!}&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-gradient btn-warning btn-reset" type="reset">{{ trans('general.button.reset') }}</button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-gradient btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">{{ trans('general.button.cancel') }}</button>
                        </center>
                    </div>
                    <div class="form-group area-delete">
                        <center>
                            {!! Form::submit(trans('general.button.delete'), ['class' => 'btn btn-danger btn-submit', 'title' => trans('general.button.delete')]) !!}
                            <button class="btn btn-gradient btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">{{ trans('general.button.cancel') }}</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-getstart" id="modalFormDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title FormData-title" id="myModalLabel">{{ trans('general.button.create') }}</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="id" value="">
                <div class="col-md-12 panel" style="padding:50px;">
                    <div class="form-group area-insert-update">
                        <label class="font-label">{{ trans('general.form.category') }}</label>
                        <p class="font-form" name="category_name"></p>
                    </div>
                    <div class="form-group area-insert-update">
                        <label class="font-label">{{ trans('general.form.question') }}</label>
                        <p class="font-form" name="question"></p>
                    </div>
                    <div class="form-group area-insert-update">
                        <label class="font-label">{{ trans('general.form.point') }}</label>
                        <p class="font-form" name="point"></p>
                    </div>
                    <div class="form-group area-insert-update form-animate-text" name="audio-section">
                        <br><br>
                        <audio name="audio_name" type="audio/mp3" controls="controls"></audio>
                    </div>
                    <fieldset>
                        <legend>{{ trans('general.header.mc') }}</legend>
                        <div class="col-md-12 panel" style="padding:50px;">
                            <div>
                                <div class="form-group area-insert-update col-md-11">
                                    <p class="font-form1" name="mc[0]"></p>
                                </div>
                                <div class="form-group form-animate-checkbox col-md-1">
                                    <input type="checkbox" id="cb1" name="cb[0]" class="checkbox">
                                </div>
                            </div>
                            <div>
                                <div class="form-group area-insert-update col-md-11">
                                    <p class="font-form1" name="mc[1]"></p>
                                </div>
                                <div class="form-group form-animate-checkbox col-md-1">
                                    <input type="checkbox" id="cb2" name="cb[1]" class="checkbox">
                                </div>
                            </div>
                            <div>
                                <div class="form-group area-insert-update col-md-11">
                                    <p class="font-form1" name="mc[2]"></p>
                                </div>
                                <div class="form-group form-animate-checkbox col-md-1">
                                    <input type="checkbox" id="cb3" name="cb[2]" class="checkbox">
                                </div>
                            </div>
                            <div>
                                <div class="form-group area-insert-update col-md-11">
                                    <p class="font-form1" name="mc[3]"></p>
                                </div>
                                <div class="form-group form-animate-checkbox col-md-1">
                                    <input type="checkbox" id="cb4" name="cb[3]" class="checkbox">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                
                <div class="form-group area-insert-update">
                    <center>
                        <button class="btn btn-gradient btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">{{ trans('general.button.close') }}</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function toObject(arr) {
        var rv = {};
        for (var i = 0; i < arr.length; ++i)
            rv[i] = arr[i];
        return rv;
    }
    
    $('#file_name').hide();
    var table = $('#data-tables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('admin.question.datatable') !!}",
        order: [[ 1, 'desc' ]],
        columns: [
            {data: 'id', name: 'id',visible:false},
            {data: 'updated_at', name: 'updated_at',visible:false},
            {data: 'category', name: 'category'},
            {data: 'question', name: 'question'},
            {data: 'point', name: 'point'},
            {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
        ]
    });

    function show_form_create(){
        cancelOption();
        $("#is_file").prop('checked', false);
        $('.FormData-title').html("{{ trans('general.modal.create_question') }}");
        $("[name='action']").val('create');
        $("[name='category_name']").val('');
        $("[name='question']").val('');
        $("[name='point']").val('');
        $("#mc1").val('');
        $("#mc2").val('');
        $("#mc3").val('');
        $("#mc4").val('');
        $('#file_name').attr('disabled','disabled');
        $('#file_name').hide();
        $("[name='file_name']").val('');
        $('.area-insert-update').show();
        $('.area-delete').hide();
        $('#modalFormData').modal({backdrop: 'static', keyboard: false});
        $('#modalFormData').modal('show');
        $("[name='id']").val('');
    }

    function show_form_update(id){
        $('.save-data').removeAttr('disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('admin.question.post')}}",
            data: {
                'id': id,
                'action': 'get-data'
            },
            dataType: 'json',
            success: function(response)
            {
                if($("[name='category_name'] option").length==0 ){

                    Object.keys(response.categories).forEach(function(index) {
                        $("[name='category_name']").append('<option value="'+index+'">'+response.categories[index]+'</option>');
                    });
                }else{
                }

                $("[name='audio_name']").attr("src",response.file_path);
                $("[name='category_name']").val(response.category_name);
                $("[name='question']").val(response.question);
                $("[name='point']").val(response.point);
                if(response.is_file){
                    $("#is_file").prop('checked', true);
                    $('#file_name').removeAttr("disabled");
                    $('#file_name').show();
                }

                var cbList = [
                    'cb1',
                    'cb2',
                    'cb3',
                    'cb4',
                ];
                
                cbList.forEach(function(item, index){
                    if(response.cb!=item){
                        $('#'+item).attr('disabled','disabled');
                        $('#'+item).hide();
                    }
                });

                $("#"+response.cb).prop('checked', true);
                response.mc.forEach(setMc);
            }
        });

        $("[name='id']").val(id);
        $('.area-insert-update').show();
        $('.area-delete').hide();
        $('.FormData-title').html("{{ trans('general.modal.update_question') }}");
        $("[name='action']").val('update');
        $('#modalFormData').modal({backdrop: 'static', keyboard: false});
        $('#modalFormData').modal('show');
    }
    
    function show_form_detail(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('admin.question.post')}}",
            data: {
                'id': id,
                'action': 'get-data'
            },
            dataType: 'json',
            success: function(response)
            {
                $("[name='question']").text(response.question);
                $("[name='point']").text(response.point);
                
                if(response.file_path!=""){
                    $("[name='audio_name']").attr("src",response.file_path);
                }else{
                    $("[name='audio-section']").hide();
                }
                $("[name='category_name']").text(response.category);
                if(response.is_file){
                    $("#is_file").prop('checked', true);
                    $('#file_name').removeAttr("disabled");
                    $('#file_name').show();
                }

                var cbList = [
                    'cb1',
                    'cb2',
                    'cb3',
                    'cb4',
                ];
                
                cbList.forEach(function(item, index){
                    if(response.cb!=item){
                        $("[name='cb["+index+"]']").attr('disabled','disabled');
                        $("[name='cb["+index+"]']").hide();
                    }else{
                        // $("[name='mc["+index+"]']").css({'font-weight':'bold','color':'green'});
                        $("[name='cb["+index+"]']").prop('checked', true);
                    }
                });
    
                response.mc.forEach(setMcDetail);
            }
        });

        $("[name='id']").val(id);
        $('.area-insert-update').show();
        $('.area-delete').hide();
        $('.FormData-title').html("{{ trans('general.modal.view_question') }}");
        $("[name='action']").val('update');
        $('#modalFormDetail').modal({backdrop: 'static', keyboard: false});
        $('#modalFormDetail').modal('show');
    }

    function setMc(item, index) {
        $("[name='mc["+index+"]']").val(item); 
    }
    
    function setMcDetail(item, index) {
        $("[name='mc["+index+"]']").text(item); 
    }

    function show_form_delete(id){
        $("[name='question']").removeAttr('required');
        $("[name='point']").removeAttr('required');
        $("[name='mc[0]']").removeAttr('required');
        $("[name='mc[1]']").removeAttr('required');
        $("[name='mc[2]']").removeAttr('required');
        $("[name='mc[3]']").removeAttr('required');
        $("[name='id']").val(id);
        $('.area-insert-update').hide();
        $('.area-delete').show();
        $('.FormData-title').html("{{ trans('general.modal.delete_question') }}");
        $("[name='action']").val('delete');
        $('#modalFormData').modal({backdrop: 'static', keyboard: false});
        $('#modalFormData').modal('show');
    }

    $('.jquery-form-data').ajaxForm({
        dataType : 'json',
        success: function(response) {
            if(response.status == 'success'){
                var type_not = 'success';
            }else{
                var type_not = 'failed';
            }
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
                title: response.status,
                text: response.notification,
                type: type_not,
                addclass: "stack-custom",
                stack: myStack
            });
            table.ajax.reload();
            $('#modalFormData').modal('hide');
        },
        beforeSend: function() {
            $('.has-error').html('');
        },
        error: function(response){
            if (response.status === 422) {
                var data = response.responseJSON;
                $.each(data,function(key,val){
                    $('.error-'+key).html(val);
                });
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: "Failed",
                    text: "Validate Error, Check Your Data Again",
                    type: 'danger',
                    addclass: "stack-custom",
                    stack: myStack
                });
                $("#modalFormData").scrollTop(0);
            } else {
                $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
            }
        }
    });

    function enableFileInput(id)
    {
        var check = $('#'+id).is(":checked"); 
        if(check){
            $('#file_name').show();
            $('#file_name').removeAttr("disabled");
        }else{
            $('#file_name').attr('disabled','disabled');
            $('#file_name').hide();
        }
    }
    function cancelOption()
    {
        $('#cb1').show();
        $('#cb2').show();
        $('#cb3').show();
        $('#cb4').show();
        $("#cb1").prop('checked', false);
        $("#cb2").prop('checked', false);
        $("#cb3").prop('checked', false);
        $("#cb4").prop('checked', false);
        $('#cb1').removeAttr("disabled");
        $('#cb2').removeAttr("disabled");
        $('#cb3').removeAttr("disabled");
        $('#cb4').removeAttr("disabled");
        $('.save-data').attr('disabled','disabled');

    }
    
    function disableOther(id)
    {
        switch(id){
            case 1:
                $('#cb2').hide();
                $('#cb3').hide();
                $('#cb4').hide();
                $('#cb2').attr('disabled','disabled');
                $('#cb3').attr('disabled','disabled');
                $('#cb4').attr('disabled','disabled');
                $('.save-data').removeAttr("disabled");
            break;
            case 2:
                $('#cb1').hide();
                $('#cb3').hide();
                $('#cb4').hide();
                $('#cb1').attr('disabled','disabled');
                $('#cb3').attr('disabled','disabled');
                $('#cb4').attr('disabled','disabled');
                $('.save-data').removeAttr("disabled");
            break;
            case 3:
                $('#cb1').hide();
                $('#cb2').hide();
                $('#cb4').hide();
                $('#cb1').attr('disabled','disabled');
                $('#cb2').attr('disabled','disabled');
                $('#cb4').attr('disabled','disabled');
                $('.save-data').removeAttr("disabled");
            break;
            case 4:
                $('#cb1').hide();
                $('#cb2').hide();
                $('#cb3').hide();
                $('#cb1').attr('disabled','disabled');
                $('#cb2').attr('disabled','disabled');
                $('#cb3').attr('disabled','disabled');
                $('.save-data').removeAttr("disabled");
            break;
        }
    }
</script>
@endsection