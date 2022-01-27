<script>
        $(document).on("click", ".revert-loan", function () {
        var loan_id = $(this).data('id');
        $(".modal-body #loan_id").val(loan_id);
    });

    // Revert back to credit
    $('#btnSubmitForCredit').on('click',function(e) {
        e.preventDefault();
        let remarks = $('#remarks').val();
        let loan_id = $('#loan_id').val();
        if (remarks == '') {
            $('#remarks_err').text('This field is required');
        }
        if (remarks.length > 255 ) {
            $('#remarks_err').text('The maximun words is 255');
        }

        if (remarks != '' && remarks.length <= 255) {
            $('.revert-form').submit();
        }
    })
</script>