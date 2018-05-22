@extends('layouts.dashboard', ['current_page'=>'Schedule', 'title'=>'Schedule'])

@section('content')
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div id="jqxgrid_contacts"></div>
        </div>
    </div>
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Schedule</h4>
                </div>
                <div class="modal-body">
                    <form class="ajax-form" action="{{url("messages/edit")}}" method="post" enctype="multipart/form-data">
                        <div class="alert alert-success" style="display: none">
                        </div>
                        <input type="hidden" name="sid" id="sid">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text" class="control-label">Schedule Text</label>
                                    <textarea id="text" name="text" style="max-width: 100%;" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/jqwidgets/styles/jqx.metro.css')}}" type="text/css"/>
    <style>
        .select2-drop {
            z-index: 100000 !important;
        }

        .page-body .select2-container .select2-choice {
            height: 23px;
            line-height: 22px;
            margin: 4px
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxcore.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxbuttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxscrollbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxmenu.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.selection.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.filter.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.sort.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.columnsresize.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxdata.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.edit.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxlistbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxcheckbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.pager.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxdropdownlist.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxwindow.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxcalendar.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxdatetimeinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxdata.export.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/jqxgrid.export.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/globalization/globalize.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jqwidgets/globalization/translations.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'id', type: 'integer'},
                        {name: 'sender', type: 'string'},
                        {name: 'receiver', type: 'string'},
                        {name: 'group_id', type: 'string'},
                        {name: 'frequency', type: 'string'},
                        {name: 'start_time', type: 'time'},
                        {name: 'repeat_end', type: 'string'},
                        {name: 'text', type: 'string'}
                    ],
                    cache: false,
                    url: Config.defaultURL + "/schedule/all1",
                    data: {_token: Config.csrfToken},
                    type: 'GET',
                    filter: function () {
                        $("#jqxgrid_contacts").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function () {
                        $("#jqxgrid_contacts").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function (data) {
                        if (data !== null) {
                            source.totalrecords = data.TotalRows;
                        }
                    }
                };
            var dataadapter = new $.jqx.dataAdapter(source, {
                    loadError: function (xhr, status, error) {
                        console.log(error);
                    }
                }
            );

            var contacts = $("#jqxgrid_contacts").jqxGrid(
                {
                    source: dataadapter,
                    filterable: true,
                    width: '100%',
                    height: $(window).height() - 175 < 300 ? 300 : $(window).height() - 175,
                    sortable: true,
                    autoheight: false,
                    pageable: true,
                    virtualmode: true,
                    pagesize: 100,
                    pagesizeoptions: ['10', '50', '100', '500', '1000'],
                    columnsresize: true,
                    showfilterrow: true,
                    altrows: true,
                    enabletooltips: true,
                    enablehover: false,
                    enablebrowserselection: true,
                    editable: false,
                    selectionmode: 'checkbox',
                    theme: 'metro',
                    rendergridrows: function (obj) {
                        return obj.data;
                    },
                    @if(Auth::user()->can(['schedule.view','schedule.delete']))
                    showtoolbar: true,
                    rendertoolbar: function (toolbar) {
                        var container = $("<div style='margin: 5px;'></div>");
                        toolbar.append(container);
                        
                        container.append('<button class="btn btn-danger btn-sm btn-icon icon-left" id="delete_contact" style="margin-left: 10px;display: none"><i class="entypo-trash"></i>Delete</button>');
                        $("#delete_contact").on('click', function () {
                            var del_id = [];
                            $.each(contacts.jqxGrid('getselectedrowindexes'), function (k, v) {
                                var row = contacts.jqxGrid('getrowdata', v);
                                del_id.push(row.id);
                            });
                            BootstrapDialog.confirm({
                                title: 'Recurring Message Delete',
                                message: 'Do you really want to delete this schedule?',
                                type: BootstrapDialog.TYPE_DANGER,
                                closable: true,
                                draggable: false,
                                btnCancelLabel: 'Close',
                                btnOKLabel: 'Delete',
                                btnOKClass: 'btn-danger',
                                callback: function (result) {
                                    if (result) {
                                        $.post(Config.defaultURL + "/schedule", {
                                            _method: 'DELETE',
                                            id: del_id
                                        }, function () {
                                            if (contacts.jqxGrid('getdatainformation').rowscount <= del_id.length) {
                                                contacts.jqxGrid('clear');
                                                $('#delete_contact').hide();
                                            } else {
                                                contacts.jqxGrid('beginupdate');
                                                $.each(contacts.jqxGrid('getselectedrowindexes'), function (k, v) {
                                                    contacts.jqxGrid('deleterow', v);
                                                });
                                                contacts.jqxGrid('endupdate');
                                            }
                                            contacts.jqxGrid('clearselection');
                                        }, "json");
                                    }
                                }
                            });
                        });
                    },
                    @endif
                    columns: [
                        {text: 'Sender', datafield: 'sender', cellsalign: 'center', align: 'center'},
                        {text: 'Receiver', datafield: 'receiver', cellsalign: 'center', align: 'center'},
                        {text: 'GroupId', datafield: 'group_id', cellsalign: 'center', align: 'center'},
                        {text: 'Frequency', datafield: 'frequency', cellsalign: 'center', align: 'center'},
                        {text: 'Send Time', datafield: 'start_time', cellsalign: 'center', align: 'center'},
                        {text: 'Repeat End Date', datafield: 'repeat_end', cellsalign: 'center', align: 'center'},
                        {text: 'Text', datafield: 'text', cellsalign: 'center', align: 'center'},
                        {
                            text: '',
                            datafield: 'Edit',
                            filterable: false,
                            width: 38,
                            cellsrenderer: function (row) {
                                row = contacts.jqxGrid('getrowdata', row);
                                return "<a class=\"item-edit\" data-id=\"" + row.id + "\"><button class=\"btn btn-info btn-xs\" style=\"margin: 6px\"><i class=\"entypo-pencil\"></i></button></a>";
                            }
                        }
                    ]
                }).on('rowselect', function (event) {
                $('#delete_contact').toggle(contacts.jqxGrid('getselectedrowindexes').length > 0);
            }).on('rowunselect', function (event) {
                $('#delete_contact').toggle(contacts.jqxGrid('getselectedrowindexes').length > 0);
            });
            $('body').on('click', '.item-edit', function () {
                var edit = $('#edit');
                edit.find('#text').val($(this).parent().prev().children(0).html());
                edit.find('#sid').val($(this).data('id'));
            //    edit.find('form').attr('action', Config.defaultURL + '/schedule/' + $(this).data('id')); 
                edit.modal('show', {backdrop: 'static'});
            });
            $('#edit,#create').on('hidden.bs.modal', function () {
                if ($(this).find('form').data('updated')) {
                    contacts.jqxGrid('updatebounddata');
                }
            });

            $('#create').on('shown.bs.modal', function () {
                $(this).find('.avatar').attr('src', Config.defaultURL + '/assets/images/member.jpg');
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $(input).prev('.avatar').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#import-contacts').find('input[name=contacts]').change(function () {
                $(this).closest('form').submit();
            });
            $('#create,#edit').find('input[name=avatar]').change(function () {
                readURL(this);
            });
        });

    </script>
@endpush
