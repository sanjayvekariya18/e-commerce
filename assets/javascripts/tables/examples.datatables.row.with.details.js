/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {
		var $table = $('#datatable-details');

		// format function for row details
		var fnFormatDetails = function( datatable, tr ) {
			var data = datatable.fnGetData( tr );

			return [
				'<table class="table mb-none">',
                                        '<tr class="b-top-none">',
                                            '<td style="padding: 6px;width: 50%;">',
                                                '<table class="table mb-none" style="border:1px solid;">',
                                                    '<th colspan="2" style="text-align: center;border-top: none;background-color: #171717;color: #FFFFFF;"> ITEMS DETAILS </th>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">SKU :</label></td>',
                                                        '<td style="padding: 6px;">' + data[9] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Quantity :</label></td>',
                                                        '<td style="padding: 6px;">' + data[10] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Product Name :</label></td>',
                                                        '<td style="padding: 6px;">' + data[11] + '</td>',
                                                    '</tr>',
                                                '</table>',
                                            '</td>',
                                            '<td style="padding: 6px;">',
                                                '<table class="table mb-none" style="border:1px solid;">',
                                                    '<th colspan="2" style="text-align: center;border-top: none;background-color: #171717;color: #FFFFFF;"> SHIPPING DETAILS </th>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Total Weight :</label></td>',
                                                        '<td style="padding: 6px;">' + data[12] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Shipping Charge :</label></td>',
                                                        '<td style="padding: 6px;">' + data[6] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Reason :</label></td>',
                                                        '<td style="padding: 6px;">' + data[13] + '</td>',
                                                    '</tr>',
                                                '</table>',
                                            '</td>',
                                            '<td style="padding: 6px;">',
                                                '<table class="table mb-none" style="border:1px solid;">',
                                                    '<th colspan="2" style="text-align: center;border-top: none;background-color: #171717;color: #FFFFFF;"> TRANSACTION DETAILS </th>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Sales Price :</label></td>',
                                                        '<td style="padding: 6px;">' + data[4] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Settlement Price:</label></td>',
                                                        '<td style="padding: 6px;">' + data[5] + '</td>',
                                                    '</tr>',
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Commission Fee :</label></td>',
                                                        '<td style="padding: 6px;">' + data[15] + '</td>',
                                                    '</tr>',                                                    
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Shipping Charge :</label></td>',
                                                        '<td style="padding: 6px;">' + data[6] + '</td>',
                                                    '</tr>',                                                    
                                                    '<tr class="b-top-none" style="border:1px solid;">',
                                                        '<td style="padding: 6px;"><label class="mb-none">Payable Amount :</label></td>',
                                                        '<td style="padding: 6px;">' + data[14] + '</td>',
                                                    '</tr>',
                                                '</table>',
                                            '</td>',
                                        '</tr>',					
				'</div>'
			].join('');
		};

		// insert the expand/collapse column
		var th = document.createElement( 'th' );
		var td = document.createElement( 'td' );
		td.innerHTML = '<i data-toggle class="fa fa-plus-square-o text-primary h5 m-none" style="cursor: pointer;"></i>';
		td.className = "text-center";
		th.className = "myFirstField";

		$table
			.find( 'thead tr' ).each(function() {
				this.insertBefore( th, this.childNodes[0] );
			});

		$table
			.find( 'tbody tr' ).each(function() {
				this.insertBefore(  td.cloneNode( true ), this.childNodes[0] );
			});

		// initialize
		var datatable = $table.dataTable({
			aoColumnDefs: [{
				bSortable: false,
				aTargets: [ 0 ]
			}],
			aaSorting: [
				[1, 'asc']
			]
		});

		// add a listener
		$table.on('click', 'i[data-toggle]', function() {
			var $this = $(this),
				tr = $(this).closest( 'tr' ).get(0);

			if ( datatable.fnIsOpen(tr) ) {
				$this.removeClass( 'fa-minus-square-o' ).addClass( 'fa-plus-square-o' );
				datatable.fnClose( tr );
			} else {
				$this.removeClass( 'fa-plus-square-o' ).addClass( 'fa-minus-square-o' );
				datatable.fnOpen( tr, fnFormatDetails( datatable, tr), 'details' );
			}
		});
	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);