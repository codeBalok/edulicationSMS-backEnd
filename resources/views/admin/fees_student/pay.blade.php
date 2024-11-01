    <!-- Edit modal content -->
    <div id="payModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" id="payModal-{{ $row->id }}" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form class="needs-validation" novalidate action="{{ route('fees-student-pay') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- View Start -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <p><mark class="text-primary">{{ __('student id') }}:</mark> #{{ $row->studentEnroll->student->student_id ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('name') }}:</mark> {{ $row->studentEnroll->student->first_name ?? '' }} {{ $row->studentEnroll->student->last_name ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('program') }}:</mark> {{ $row->studentEnroll->program->title ?? '' }}</p><hr/>
                            </div>
                            <div class="col-md-6">
                                <p><mark class="text-primary">{{ __('fees type') }}:</mark> {{ $row->category->title ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('session') }}:</mark> {{ $row->studentEnroll->session->title ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('semester') }}:</mark> {{ $row->studentEnroll->semester->title ?? '' }} ({{ $row->studentEnroll->section->title ?? '' }})</p><hr/>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <input type="text" name="fee_id" value="{{ $row->id }}" hidden>

                    <!-- Form Start -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="due_date" class="form-label">{{ __('due date') }} <span>*</span></label>
                            <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $row->due_date }}" required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('due date') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="pay_date" class="form-label">{{ __('pay date') }} <span>*</span></label>
                            <input type="date" class="form-control" name="pay_date" id="pay_date" value="{{ date('Y-m-d') }}" required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('pay date') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fee_amount" class="form-label">{{ __('amount') }} ($) <span>*</span></label>
                            <input type="text" class="form-control autonumber" name="fee_amount" id="fee_amount" value="{{ round($row->fee_amount, 2) }}" required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('amount') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="discount_amount" class="form-label">{{ __('discount') }} ($) <span>*</span></label>
                            <input type="text" class="form-control autonumber" name="discount_amount" id="discount_amount" value="{{ round($discount_amount, 2) }}" required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('discount') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fine_amount" class="form-label">{{ __('fine amount') }} ($) <span>*</span></label>
                            <input type="text" class="form-control autonumber" name="fine_amount" id="fine_amount" value="{{ round($fine_amount, 2) }}" required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('fine amount') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="net_amount" class="form-label">{{ __('net amount') }} ($) <span>*</span></label>
                            <input type="text" class="form-control autonumber" name="paid_amount" id="net_amount" value="{{ round($net_amount, 2) }}"  required readonly>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('net amount') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="payment_method" class="form-label">{{ __('payment method') }} <span>*</span></label>
                            <select class="form-control" name="payment_method" id="payment_method-{{ $row->id }}" required>
                                <option value="">{{ __('select') }}</option>
                                <option value="1" @if( old('payment_method') == 1 ) selected @endif>{{ __('card') }}</option>
                                <option value="2" @if( old('payment_method') == 2 ) selected @endif>{{ __('cash') }}</option>
                                <option value="3" @if( old('payment_method') == 3 ) selected @endif>{{ __('cheque') }}</option>
                                <option value="4" @if( old('payment_method') == 4 ) selected @endif>{{ __('bank') }}</option>
                                <option value="5" @if( old('payment_method') == 5 ) selected @endif>{{ __('E-Wallet') }}</option>
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('payment method') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="note" class="form-label">{{ __('note') }}</label>
                            <input type="text" class="form-control" name="note" id="note-{{ $row->id }}" value="{{ old('note') }}">
                        </div>
                    </div>
                    <!-- Form End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('close') }}</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-money-check"></i> {{ __('received') }}</button>
                </div>
              </form>
            </div>
        </div>
    </div>