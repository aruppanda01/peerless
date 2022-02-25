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
            $('#btnSubmitForCredit').text('Loading...');
            document.getElementById("btnSubmitForCredit").disabled = true;
			document.getElementById("btnSubmitForCredit").style.cursor = 'no-drop';
        }
    })
    // Revert back to operation
    $('#btnSubmitForOperation').on('click',function(e) {
        e.preventDefault();
        let remarks = $('#operation_remarks').val();
        let loan_id = $('#loan_id').val();
        console.log(remarks);
        if (remarks == '') {
            $('#opertion_remarks_err').text('This field is required');
            return false;
        }
        if (remarks.length > 255 ) {
            $('#opertion_remarks_err').text('The maximun words is 255');
            return false;
        }

        if (remarks != '' && remarks.length <= 255) {
            $('.revert-form-opertion').submit();
            $('#btnSubmitForOperation').text('Loading...');
            document.getElementById("btnSubmitForOperation").disabled = true;
			document.getElementById("btnSubmitForOperation").style.cursor = 'no-drop';
        }
    })
</script>