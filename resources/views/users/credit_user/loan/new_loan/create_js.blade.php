<script>
    var i = 0;
    var k = 0;

    // Add commas
    $('#amount_of_sanctn').on('keyup', function() {
        var input = $(this).val().replaceAll(',', '');
        if (input.length < 1)
            $(this).val('');
        else {
            var val = parseFloat(input);
            var formatted = inrFormat(input);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            $(this).val(formatted);
        }
    });

    function indianMoneyFormat(event) {
        var input = event.target.value.replaceAll(',', '');
        console.log(input);
        if (input.length < 1)
            $(this).val('');
        else {
            var val = parseFloat(input);
            var formatted = inrFormat(input);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            event.target.value = formatted;
        }
    }

    function inrFormat(val) {
        var x = val;
        x = x.toString();
        var afterPoint = '';
        if (x.indexOf('.') > 0)
            afterPoint = x.substring(x.indexOf('.'), x.length);
        x = Math.floor(x);
        x = x.toString();
        var lastThree = x.substring(x.length - 3);
        var otherNumbers = x.substring(0, x.length - 3);
        if (otherNumbers != '')
            lastThree = ',' + lastThree;
        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
        return res;
    }


    $('#btn_submit').on('click', function() {
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "To submit Loan Form!",
            iconHtml: '<img src="{{ asset('frontend/images/logo.png') }}">',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                // Start
                var errorFlagOne = 0;
                var inputs = document.getElementById('dynamicAddRemove').getElementsByTagName('input');
                for (var i = 0; i < inputs.length; ++i)
                {
                    if (inputs[i].type === 'text') {
                        if (inputs[i].value == '') {
                            if (k > 0) {
                                setTimeout(() => {
                                    $('.loan_type_err' + (k)).text('');
                                }, 5000);
                                $('.loan_type_err' + (k)).text('This field can\'t be blank');

                                setTimeout(() => {
                                    $('.amount_of_sanction_err' + (k)).text('');
                                }, 5000);
                                $('.amount_of_sanction_err' + (k)).text('This field can\'t be blank');

                                setTimeout(() => {
                                    $('.tenure_err' + (k)).text('');
                                }, 5000);
                                $('.tenure_err' + (k)).text('This field can\'t be blank');

                            } else {
                                setTimeout(() => {
                                    $('.loan_type_err').text('');
                                }, 5000);
                                $('.loan_type_err').text('This field can\'t be blank');

                                setTimeout(() => {
                                    $('.amount_of_sanction_err').text('');
                                }, 5000);
                                $('.amount_of_sanction_err').text('This field  can\'t be blank');

                                setTimeout(() => {
                                    $('.tenure_err').text('');
                                }, 5000);
                                $('.tenure_err').text('This field can\'t be blank');

                            }
                            errorFlagOne = 1;
                        }

                    }
                }
                // End
                if (errorFlagOne == 1) {
                    return false;
                }else{
                    document.getElementById('loan_form').submit();
                    $('#btn_submit').text('Loading...');
                    document.getElementById("btn_submit").disabled = true;
                    document.getElementById("btn_submit").style.cursor = 'no-drop';
                } 
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //     'Cancelled',
                //     'Loan Form Is Not Submitted :)',
                //     'error'
                // )
            }
        })
    })
    setTimeout(function() {
        $(".alert-success").hide();
    }, 10000);

    function numericOnly(event) {
        var key = event.keyCode;
        return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 57 || key == 9 || key == 46 || key == 8  || key == 110);
    };

    //For dynamic loan add
    $("#dynamic-ar").click(function () {
        // Start
        var errorFlagOne = 0;
        var inputs = document.getElementById('dynamicAddRemove').getElementsByTagName('input');
        for (var i = 0; i < inputs.length; ++i)
        {
            if (inputs[i].type === 'text') {
                if (inputs[i].value == '') {
                    if (k > 0) {
                        setTimeout(() => {
                            $('.loan_type_err' + (k)).text('');
                        }, 5000);
                        $('.loan_type_err' + (k)).text('This field can\'t be blank');

                        setTimeout(() => {
                            $('.amount_of_sanction_err' + (k)).text('');
                        }, 5000);
                        $('.amount_of_sanction_err' + (k)).text('This field can\'t be blank');

                        setTimeout(() => {
                            $('.tenure_err' + (k)).text('');
                        }, 5000);
                        $('.tenure_err' + (k)).text('This field can\'t be blank');

                    } else {
                        setTimeout(() => {
                            $('.loan_type_err').text('');
                        }, 5000);
                        $('.loan_type_err').text('This field can\'t be blank');

                        setTimeout(() => {
                            $('.amount_of_sanction_err').text('');
                        }, 5000);
                        $('.amount_of_sanction_err').text('This field  can\'t be blank');

                        setTimeout(() => {
                            $('.tenure_err').text('');
                        }, 5000);
                        $('.tenure_err').text('This field can\'t be blank');

                    }
                    errorFlagOne = 1;
                }

            }
        }

        // End

        if (errorFlagOne == 1) {
            return false;
        } else {
            $('#loan_type_block').addClass("actv_bg");
            $('#amount_of_sanction_block').addClass("actv_bg");
            $('#tenure_block').addClass("actv_bg");
            $("#loan_type_block").append(`<hr>
                <div class="row">
                    <div class="col-md-3">
                        Loan - ${k+2}
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="addMoreInputFields[${k+1}][loan_type]" value="{{ old('loan_type') }}">
                        <span class="loan_type_err${k+1} text-danger"></span>
                    </div>
                </div>
            `);
            $("#amount_of_sanction_block").append(`
                <div class="row">
                    <div class="col-md-3">
                            Loan - ${k+2}
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="addMoreInputFields[${k+1}][amount_of_sanction]" value="{{ old('amount_of_sanction') }}" onkeydown="return numericOnly(event);" onkeyup="indianMoneyFormat(event)">
                        <span class="amount_of_sanction_err${k+1} text-danger"></span>
                    </div>
                </div>
            `);
            $("#tenure_block").append(`
                    <div class="row">
                        <div class="col-md-3">
                                Loan - ${k+2}
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="addMoreInputFields[${k+1}][tenure]" value="{{ old('tenure') }}">
                            <span class="tenure_err${k+1} text-danger"></span>
                        </div>
                    </div>
                </div>
            `);
            
            document.getElementById('dynamicAddRemove').scrollIntoView(false);
            ++i;
            ++k;
        }
    });
    $('.amount-of-sanction').on('change', function() {
        console.log('hiii');
        var input = $(this).val().replaceAll(',', '');
        if (input.length < 1)
            $(this).val('');
        else {
            var val = parseFloat(input);
            var formatted = inrFormat(input);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            $(this).val(formatted);
        }

    });
</script>