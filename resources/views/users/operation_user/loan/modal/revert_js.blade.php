<script>
        $(document).on("click", ".revert-loan", function () {
        var loan_id = $(this).data('id');
        $(".modal-body #loan_id").val(loan_id);
    });

    // Revert back to credit
    $('#btnSubmitForCredit').on('click',function(e) {
        e.preventDefault();
        let remarks = $('#credit_remarks').val();
        console.log(remarks);
        let loan_id = $('#loan_id').val();
        if (remarks == '') {
            $('#credit_remarks_err').text('This field is required');
            return false;
        }
        if (remarks.length > 255 ) {
            $('#credit_remarks_err').text('The maximun words is 255');
            return false;
        }

        if (remarks != '' && remarks.length <= 255) {
            $('.credit-revert-form').submit();
        }
    })
</script>