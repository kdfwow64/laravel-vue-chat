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
                    <h4 class="modal-title">Edit Contact</h4>
                </div>
                <div class="modal-body">
                    <form class="validate ajax-form" action="{{url("contacts/id")}}" method="post" enctype="multipart/form-data">
                        <div class="alert alert-success" style="display: none">
                        </div>
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img src="" class="avatar" style="height: 126px;width: 128px;" onclick="$(this).next('input[name=avatar]').click();">
                                    <input type="file" name="avatar" style="display:none" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="control-label">First Name</label>
                                    <input name="first_name" class="form-control" id="first_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name" class="control-label">Last Name</label>
                                    <input name="last_name" class="form-control" id="last_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input id="phone" name="phone" class="form-control" data-mask="19999999999">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs bordered">
                                    <li class="active">
                                        <a href="#default_labels_edit" data-toggle="tab">
                                            <span>Default Labels</span>
                                        </a>
                                    </li>
                                    @if(Auth::user()->account->limits("custom_labels") > 0)
                                        <li>
                                            <a href="#custom_labels_edit" data-toggle="tab">
                                                <span>Custom Labels</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="default_labels_edit">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="website" class="control-label">Website</label>
                                                    <input id="website" name="website" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company" class="control-label">Company</label>
                                                    <input name="company" class="form-control" id="company">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="position" class="control-label">Position</label>
                                                    <input name="position" class="form-control" id="position">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country" class="control-label">Country</label>
                                                    <input name="country" class="form-control" id="country">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="state" class="control-label">State</label>
                                                    <input name="state" class="form-control" id="state">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="city" class="control-label">City</label>
                                                    <input name="city" class="form-control" id="city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address" class="control-label">Address</label>
                                                    <input name="address" class="form-control" id="address">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender" class="control-label">Gender</label>
                                                    <select id="gender" name="gender" class="selectboxit form-control">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="birth_date" class="control-label">Date of Birth</label>
                                                    <input class="form-control datepicker" id="birth_date" name="birth_date" data-start-view="2" data-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bd_text" class="control-label">Birthday Text</label>
                                                    <textarea rows="1" name="bd_text" class="form-control autogrow" id="bd_text" style="resize: vertical"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description" class="control-label">Description</label>
                                                    <textarea rows="1" name="description" class="form-control autogrow" id="description" style="resize: vertical"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Auth::user()->account->limits("custom_labels") > 0)
                                        <div class="tab-pane" id="custom_labels_edit">
                                            <div class="row">
                                                @foreach($labels as $label)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="custom_labels[{{str_slug($label->name, '_')}}]" class="control-label">{{$label->name}}</label>
                                                            <input id="custom_labels[{{str_slug($label->name, '_')}}]" name="custom_labels[{{str_slug($label->name, '_')}}]" class="form-control">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
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
                        {name: 'start_time', type: 'time'},
                        {name: 'end_time', type: 'time'},
                        {name: 'repeat_end', type: 'date'},
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
                    @if(Auth::user()->can(['shedule.view']))
                    showtoolbar: true,
                    rendertoolbar: function (toolbar) {
                        var container = $("<div style='margin: 5px;'></div>");
                        toolbar.append(container);
                        container.append('<button class="btn btn-success btn-sm btn-icon icon-left" id="create_contact"><i class="entypo-plus"></i>Create</button>');
                        container.append('<button class="btn btn-danger btn-sm btn-icon icon-left" id="delete_contact" style="margin-left: 10px;display: none"><i class="entypo-trash"></i>Delete</button>');
                        container.append('<button class="btn btn-blue btn-sm btn-icon icon-left import" data-format="csv" style="margin-left: 10px"><i class="entypo-up"></i>Import</button>');
                        container.append('<button class="btn btn-info btn-sm btn-icon icon-left export" data-format="csv" style="margin-left: 10px"><i class="entypo-down"></i>Export To CSV</button>');
                        container.append('<button class="btn btn-info btn-sm btn-icon icon-left export" data-format="xls" style="margin-left: 10px"><i class="entypo-down"></i>Export To Excel</button>');
                    },
                    @endif
                    columns: [
                        {text: 'Start Time', datafield: 'start_time', cellsalign: 'center', align: 'center'},
                        {text: 'End Time', datafield: 'end_time', cellsalign: 'center', align: 'center'},
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
                $.get(Config.defaultURL + "/contacts/" + $(this).data('id') + "/edit", function (data) {
                    var edit = $('#edit');
                    edit.find('form')
                        .data('updated', false).attr('action', Config.defaultURL + '/contacts/' + data.id)
                        .end()
                        .find('.alert')
                        .hide();
                    edit.find('[name^="custom_labels"]').val("");
                    $.each(data, function (k, v) {
                        edit.find('[name=' + k + '][type!=password][type!=file]').val(v).trigger("change");
                        if (k === "custom_labels" && v !== null) {
                            $.each(v, function (k, v) {
                                edit.find("[name=custom_labels\\[" + k + "\\]]").val(v);
                            });
                        }
                        if (jQuery.isArray(v)) {
                            edit.find('select[name=' + k + '\\[\\]]').val(v).trigger("change");
                        }
                        if (data.avatar === null || !data.avatar.trim()) {
                            edit.find('.avatar').attr('src', Config.defaultURL + '/assets/images/member.jpg');
                        } else {
                            edit.find('.avatar').attr('src', data.avatar);
                        }
                    });
                    $.each(edit.find(".autogrow"), function (k, v) {
                        $(v).trigger('input');
                    });
                    edit.modal('show', {backdrop: 'static'});
                }, "json");
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
