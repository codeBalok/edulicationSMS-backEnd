    <!-- UnPay modal -->
    <div class="modal fade" id="cancelModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="CancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <form action="{{ route('fees-student-cancel', $row->id) }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="CancelModalLabel">{{ __('are you sure') }}</h5>
                    <p class="text-danger mt-2">{{ __("The action can't be undone!") }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('close') }}</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-check"></i> {{ __('confirm') }}</button>
                </div>
            </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->