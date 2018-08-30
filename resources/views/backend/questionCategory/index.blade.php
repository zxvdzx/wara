
@extends('backend.layout.layout')

@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">{{ trans('general.header.category') }}</h3>
            <p class="animated fadeInDown">
                {{ trans('general.header.exercise') }} <span class="fa-angle-right fa"></span> {{ trans('general.header.category') }}
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
                                <th class="center-align" width="15%">{{ trans('general.table.action') }}</th>
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
                {!! Form::open(['route'=>'admin.category.post', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
                    <input type="hidden" name="action" id="action" value="">
                    <input type="hidden" name="id" value="">
                    <div class="form-group area-insert-update">
                        <label class="col-md-3 control-label">{{ trans('general.form.category') }}</label>
                        <div class="col-lg-9">
                            {!! Form::text('category', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                            <p class="has-error text-danger error-name"></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-group{{ Form::hasError('category') }} has-feedback">
                        {!! Form::errorMsg('category') !!}
                    </div>
                    <div class="form-group area-delete">
                        <div class="col-md-12">
                            <center>{{ trans('general.messages.delete_confirm') }}</center>
                        </div>
                    </div>
                    <div class="form-group area-insert-update">
                        <center>
                            {!! Form::submit(trans('general.button.save'), ['class' => 'btn btn-primary btn-gradient btn-submit', 'title' => trans('general.button.save')]) !!}&nbsp;&nbsp;&nbsp;
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
@endsection

@section('script')
<script>
    var table = $('#data-tables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('admin.category.datatable') !!}",
        order: [[ 1, 'desc' ]],
        columns: [
            {data: 'id', name: 'id',visible:false},
            {data: 'updated_at', name: 'updated_at',visible:false},
            {data: 'category', name: 'category'},
            {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
        ]
    });

    function show_form_create(){
        $('.FormData-title').html("{{ trans('general.modal.create_category') }}");
        $("[name='action']").val('create');
        $("[name='category']").val('');
        $('.area-insert-update').show();
        $('.area-delete').hide();
        $('#modalFormData').modal({backdrop: 'static', keyboard: false});
        $('#modalFormData').modal('show');
        $("[name='id']").val('');
    }

    function show_form_update(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('admin.category.post')}}",
            data: {
                'id': id,
                'action': 'get-data'
            },
            dataType: 'json',
            success: function(response)
            {
                $("[name='category']").val(response.category);
            }
        });

        $("[name='id']").val(id);
        $('.area-insert-update').show();
        $('.area-delete').hide();
        $('.FormData-title').html("{{ trans('general.modal.update_category') }}");
        $("[name='action']").val('update');
        $('#modalFormData').modal({backdrop: 'static', keyboard: false});
        $('#modalFormData').modal('show');
    }

    function show_form_delete(id){
        $("[name='id']").val(id);
        $('.area-insert-update').hide();
        $('.area-delete').show();
        $('.FormData-title').html("{{ trans('general.modal.delete_category') }}");
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
</script>
@endsection