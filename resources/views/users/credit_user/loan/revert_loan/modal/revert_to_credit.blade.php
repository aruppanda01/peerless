<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="examModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examModalLabel">Revert back to the Credit Dept.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accountant_user.revertBackToCredit') }}" method="POST" enctype="multipart/form-data"
                    class="revert-form">
                    @csrf
                    <input type="hidden" name="loan_id" id="loan_id">
                    <div class="form-group">
                        <label for="">Enter remarks</label>
                        <textarea name="remarks" id="remarks" cols="2" rows="2" class="form-control"></textarea>
                        <span class="text-danger" id="remarks_err"></span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary float-right mt-3" id="btnSubmitForCredit">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
