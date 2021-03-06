/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function () {
    const date = new Date();
    const fullMonthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const tableLizable = $(".datatable-lize");

    if (tableLizable.length) {
        $(tableLizable).dataTable();
    }

    /* Disable submit buttons after form submit
       to avoid double submissions
     */
    $('form').on('submit', function (e) {
        // e.preventDefault();
        // alert('Form submitted');

        $(':submit').attr('disabled', true)
            .attr('aria-disabled', 'true')
            .addClass('disabled');
    });

    if ($('.months-list').length) {
        let months = $('.month');
        let currentMonth = date.getMonth();
        let options = {month: 'long'};
        $('#current-month').text(new Intl.DateTimeFormat('en-US', options).format(date));
        months.eq(currentMonth).addClass('active');

        displayMonthlyCheckoutData(currentMonth);

        months.click(function (e) {
            e.preventDefault();

            let selectedIndex = $('.month').index(this);
            $('.month.active').removeClass('active');
            $(this).addClass('active');
            $('#current-month').text(fullMonthNames[selectedIndex]);

            displayMonthlyCheckoutData(selectedIndex);
        });
    }

    function displayMonthlyCheckoutData(monthIndex) {
        // console.log(monthIndex);

        let month = monthIndex + 1;

        $.ajax({
            url: base_url + "/admin/item/checkout_data_by_monthyear/" + month,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            success: function (response, textStatus) {
                let respJson = JSON.parse(response);
                // console.log(respJson);
                $('#checkoutTable').html(respJson.data.table);
                $('#checkoutTblDownloadLink').html('<a href="' + base_url + '/admin/dashboard/print/checkout_report/' + month + '" class="btn btn-primary mt-2" role="button">Download PDF</a>');

                if (respJson.data.count < 1) {
                    $('#checkoutTblDownloadLink a').addClass('disabled').attr('disabled', true);
                }
            },
            fail: function (response, textStatus) {
                console.error(response);
            }
        });

        // $('#checkoutTable').DataTable({
        //     destroy: true,
        //     ajax: base_url + "/admin/item/checkout_data_by_monthyear?month_num=" + month,
        //     columns: [
        //         { data: 'item_id' },
        //         { data: 'item_name' },
        //         { data: 'qty_utlized' }
        //     ]
        // });
    }

    // Todo: Switch the classes instead of the HTML markup
    $('.show-hide-pass').click(function () {

        let targetInputField = $(this).parent().siblings("input");
        if ((targetInputField).attr("type") === 'password') {
            $(targetInputField).attr("type", "text");
            $(this).html('<i class="fas fa-eye"></i>');
        } else {
            $(targetInputField).attr("type", "password");
            $(this).html('<i class="fas fa-eye-slash"></i>');
        }
    });

})