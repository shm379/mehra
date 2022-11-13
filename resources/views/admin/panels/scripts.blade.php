<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin/vendors/js/ui/jquery.sticky.js')}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin/js/core/app.js') }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset('admin/js/core/scripts.js') }}"></script>
<script src="{{ asset('admin/js/core/tailwind.js') }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset('admin/js/scripts/customizer.js') }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@if(isset($table_config))
    <script>
        $(document).ready(function() {
            var isRtl = $('html').attr('data-textdirection') === 'rtl';

            var dt_ajax_table = $('.datatables-ajax'),
                dt_bulk_actions = $('.datatable-actions')
                dt_filter_table = $('.dt-column-search'),
                dt_adv_filter_table = $('.dt-advanced-search'),
                dt_responsive_table = $('.dt-responsive'),
                assetPath = 'admin/datatable',
                dt_ajax_id = dt_ajax_table[0].id;
            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');
            }
            if (dt_ajax_table.length) {
                var dt_ajax = dt_ajax_table.dataTable({
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    language: {
                        url: '{{url('admin/js/Persian.json')}}',
                    },
                    columnDefs: [
                        {
                            orderable: true,
                            className: 'select-checkbox',
                            targets: 0
                        }
                    ],
                    select: {
                        style: 'multi',
                    },
                    buttons: [
                        {
                            text: 'Row selected data',
                            action: function ( e, dt, node, config ) {
                                alert(
                                    'Row data: '+
                                    JSON.stringify( dt.row( { selected: true } ).data() )
                                );
                            },
                            enabled: false
                        },
                        {
                            text: 'Count rows selected',
                            action: function ( e, dt, node, config ) {
                                alert( 'Rows: '+ dt.rows( { selected: true } ).count() );
                            },
                            enabled: false
                        },
                        {
                            extend: 'searchBuilder',
                            config: {
                                depthLimit: 2
                            }
                        },
                        {
                            text: 'انتخاب همه',
                            action: function () {
                                this.rows().select();
                            }
                        },
                        {
                            text: 'انتخاب هیچکدام',
                            action: function () {
                                this.rows().deselect();
                            }
                        },
                        {
                            text: 'Get selected data',
                            action: function () {
                                var count = this.rows( { selected: true } ).count();

                                dt_bulk_actions.prepend( '<div>'+count+' row(s) selected</div>' );
                            }
                        },
                    ],
                    fixedHeader: true,
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal( {
                                header: function ( row ) {
                                    var data = row.data();
                                    return 'اطلاعات '+data['title'];
                                }
                            } ),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                                tableClass: 'table'
                            } )
                        }
                    },
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    {!! $table_config !!}
                });
                $('.datatables-ajax tr.selected').each( function () {
                    var selectedRows = $('.datatables-ajax tr.selected').count();

                    $(this).button( 0 ).enable( selectedRows === 1 );
                    $(this).button( 1 ).enable( selectedRows > 0 );
                } );
                // dt_ajax
                //     .on( 'select', function ( e, dt, type, indexes ) {
                //         var rowData = this.rows( indexes ).data().toArray();
                //         dt_bulk_actions.prepend( '<div><b>'+type+' selection</b> - '+JSON.stringify( rowData )+'</div>' );
                //     } )
                //     .on( 'deselect', function ( e, dt, type, indexes ) {
                //         var rowData = this.rows( indexes ).data().toArray();
                //         dt_bulk_actions.prepend( '<div><b>'+type+' <i>de</i>selection</b> - '+JSON.stringify( rowData )+'</div>' );
                //     } );
            }
        });
    </script>
@endif
@yield('page-script')
@livewireScripts
<!-- END: Page JS-->
