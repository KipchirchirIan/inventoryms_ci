/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function () {
    $(".table").dataTable();

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
})