@extends('cms::layouts.backend')

@section('content')

    <div class="row mb-3">
        <div class="col-md-12 float-right">
            <button class="btn btn-danger" id="clear-btn">
                <i class="fa fa-fw fa-trash"></i> {{ trans('cms::app.clear') }}
            </button>
        </div>
    </div>

    <div class="table-responsive mb-5">
        <table class="table juzaweb-table">
            <thead>
                <tr>
                    <th data-field="date">{{ trans('cms::app.date') }}</th>
                    <th data-width="10%" data-align="center" data-field="all">{{ trans('cms::app.content') }}</th>
                    <th data-width="10%" data-align="center" data-field="emergency">{{ trans('cms::app.emergency') }}</th>
                    <th data-width="10%" data-align="center" data-field="error">{{ trans('cms::app.error') }}</th>
                    <th data-width="10%" data-align="center" data-field="info">{{ trans('cms::app.info') }}</th>
                    <th data-width="10%" data-align="center" data-field="warning">{{ trans('cms::app.warning') }}</th>
                    <th data-width="10%" data-align="center" data-field="notice">{{ trans('cms::app.notice') }}</th>
                    <th data-width="15%" data-align="center" data-formatter="action_formatter">{{ trans('cms::app.actions') }}</th>
                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        function action_formatter(value, row, index) {
            let str = `<a href="${row.edit_url}" class="btn btn-info px-2"><i class="fa fa-search"></i></a>`;
            str += `<a href="javascript:void(0)" class="btn btn-danger px-2 delete-log" data-date="${row.date}"><i class="fa fa-trash"></i></a>`;
            return str;
        }

        const table = new JuzawebTable({
            url: '{{ route('admin.logs.error.get-logs') }}',
        });

        $(document).on('click', '.delete-log', function () {
            let date = $(this).data('date');
            confirm_message(
                "{{ trans('Are you sure you want to delete this log file: :date ?', ['date' => '__DATE__']) }}".replace('__DATE__', date),
                function (result) {
                    if (!result) {
                        return false;
                    }

                    $.ajax({
                        url: "{{ route('admin.logs.error.delete') }}",
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            date: date
                        },
                        success: function(data) {
                            if (data.result === 'success') {
                                location.replace("{{ route('admin.logs.error.index') }}");
                            } else {
                                alert('OOPS ! This is a lack of coffee exception !')
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(errorThrown);
                        }
                    });

                    return false;
                }
            );
        });

        $(document).on('click', '#clear-btn', function () {
            confirm_message(
                "{{ trans('Are you sure you want to clear all log files?') }}",
                function (result) {
                    if (!result) {
                        return false;
                    }

                    $.ajax({
                        url: "{{ route('admin.logs.error.clear') }}",
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data) {
                            if (data.result === 'success') {
                                location.replace("{{ route('admin.logs.error.index') }}");
                            } else {
                                alert('OOPS ! This is a lack of coffee exception !')
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(errorThrown);
                        }
                    });

                    return false;

                }
            );
        });
    </script>

@endsection
