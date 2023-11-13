@extends('page')
@section('title', 'Profile')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Profile</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Profile <small>Page</small></h1>
<!-- end page-header -->
@endsection
@section('content')
<!-- begin profile-container -->
<div class="profile-container">
    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image" style="height: 200px !important;">
                <img id="img-avatar" src="{{ Auth::user()->avatar=='avatar.png'? asset('assets/img/'. Auth::user()->avatar) : url('files/profile/'. Auth::user()->avatar) }}" alt="Avatar" width="100%" />
                <i class="fa fa-user"></i>
            </div>
            <!-- end profile-image -->
            <div class="m-b-10">
                <input type="file" accept="image/*" class="btn btn-warning btn-block btn-sm btn-choose-image" />
                <!-- <a href="#" class="btn btn-warning btn-block btn-sm">Change Picture</a> -->
            </div>
        </div>
        <!-- end profile-left -->
        <!-- begin profile-right -->
        <div class="profile-right">
            <!-- begin profile-info -->
            <div class="profile-info">
                <!-- begin table -->
                <div class="table-responsive">
                    <table class="table table-profile">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <h4>{{ Auth::user()->name }} <small>{{ Auth::user()->job_title }}</small></h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="highlight">
                                <td class="field">NIK</td>
                                <td><a href="#" id="nik" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter NIK">{{ Auth::user()->nik?Auth::user()->nik:'Add Nik' }}</a></td>
                            </tr>
                            <tr class="highlight">
                                <td class="field">Job Title</td>
                                <td><a href="#" id="job_title" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter Job Title">{{ Auth::user()->job_title?Auth::user()->job_title:'Add Job Title' }}</a></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="field">Mobile</td>
                                <td><a href="#" id="mobile_no" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter Mobile No"><i class="fa fa-mobile m-r-5"></i>{{ Auth::user()->mobile_no?Auth::user()->mobile_no:'Add Number' }}</a></td>
                            </tr>
                            <tr>
                                <td class="field">Home</td>
                                <td><a href="#" id="home_no" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter Home No">{{ Auth::user()->home_no?Auth::user()->home_no:'Add Number' }}</a></td>
                            </tr>
                            <tr>
                                <td class="field">Office</td>
                                <td><a href="#" id="office_no" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter Home No">{{ Auth::user()->office_no?Auth::user()->office_no:'Add Number' }}</a></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="highlight">
                                <td class="field">About Me</td>
                                <td><a href="#" id="about_me" data-type="textarea" data-pk="{{ Auth::user()->id }}" data-title="Enter Description">{{ Auth::user()->about_me?Auth::user()->about_me:'Add Description' }}</a></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="field">Country/Region</td>
                                <td><a href="#" id="country" data-type="select2" data-pk="{{ Auth::user()->id }}" data-value="{{ Auth::user()->country }}" data-title="Select country"></a></td>
                            </tr>
                            <tr>
                                <td class="field">City</td>
                                <td><a href="#" id="city" data-type="select2" data-pk="{{ Auth::user()->id }}" data-value="{{ Auth::user()->city }}" data-title="Select city"></a></td>
                            </tr>
                            <tr>
                                <td class="field">State</td>
                                <td><a href="#" id="state" data-type="text" data-pk="{{ Auth::user()->id }}" data-title="Enter State">{{ Auth::user()->state?Auth::user()->state:'Add State' }}</a></td>
                            </tr>
                            <tr>
                                <td class="field">Gender</td>
                                <td>
                                    <a href="#" id="gender" data-type="select" data-pk="{{ Auth::user()->id }}" data-value="{{ Auth::user()->gender }}" data-title="Select sex"></a>
                                </td>
                            </tr>
                            <tr class="highlight">
                                <td class="field">Birthdate</td>
                                <td><a href="#" id="birthdate" data-type="combodate" data-value="{{ Auth::user()->birthdate }}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{ Auth::user()->id }}" data-title="Select Date of birth"></a></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="field">Current Password</td>
                                <td>
                                    <div class="col-md-4" style="padding-left: 0px !important;">
                                        <input type="password" name="password" id="password-indicator-current" class="form-control m-b-5 input-sm" />
                                        <div class="invalid-feedback invalid-password"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="field">New Password</td>
                                <td>
                                    <div class="col-md-4" style="padding-left: 0px !important;">
                                        <input type="text" name="password_new" id="password-indicator-new" class="form-control m-b-5 input-sm" />
                                        <div class="invalid-feedback invalid-password_new"></div>
                                        <div id="passwordStrengthNew" class="is0 m-t-5"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Confirm Password</td>
                                <td>
                                    <div class="col-md-4" style="padding-left: 0px !important;">
                                        <input type="text" name="password_confirm" id="password-indicator-confirm" class="form-control m-b-5 input-sm" />
                                        <div class="invalid-feedback invalid-password_confirm"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="highlight">
                                <td class="field">&nbsp;</td>
                                <td class="">
                                    <button type="button" id="btn-update-password" class="btn btn-primary w-150px">Update Password</button>
                                    <a href="{{ url('/') }}" class="btn border-0 w-150px ms-5px"> Close</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
    <!-- end profile-section -->
</div>
<!-- end profile-container -->
@endsection
@section('css')
<link href="{{ asset('assets/plugins/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap3-editable/inputs-ext/select2/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
@endsection
@section('js')
<script src="{{ asset('assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap3-editable/inputs-ext/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/password-indicator/js/password-indicator.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#job_title").editable({
            url: "{{ route('settings.users.biodata') }}",
            validate: function(e) {
                if ($.trim(e) === "") {
                    return "This field is required"
                }
            }
        });

        $("#mobile_no").editable({
            url: "{{ route('settings.users.biodata') }}",
        });

        $("#nik").editable({
            url: "{{ route('settings.users.biodata') }}",
        });

        $("#about_me").editable({
            url: "{{ route('settings.users.biodata') }}",
        });

        $("#home_no").editable({
            url: "{{ route('settings.users.biodata') }}",
        });
        $("#office_no").editable({
            url: "{{ route('settings.users.biodata') }}",
        });
        $("#state").editable({
            url: "{{ route('settings.users.biodata') }}",
        });
        $("#birthdate").editable({
            url: "{{ route('settings.users.biodata') }}",
        });
        var t = [];
        $.each({
            ID: "Indonesia",
        }, function(e, n) {
            t.push({
                id: e,
                text: n
            })
        });
        $("#country").editable({
            source: t,
            url: "{{ route('settings.users.biodata') }}",
            select2: {
                width: 200,
                placeholder: "Select country",
                allowClear: true
            }
        });

        var ct = [];
        $.each({
            JKT: "Jakarta",
            BDG: "Bandung",
            TNG: "Tangerang",
            BKS: "Bekasi",
            BGR: "Bogor",
            DPK: "Depok",
        }, function(e, n) {
            ct.push({
                id: e,
                text: n
            })
        });
        $("#city").editable({
            source: ct,
            url: "{{ route('settings.users.biodata') }}",
            select2: {
                width: 200,
                placeholder: "Select City",
                allowClear: true
            }
        });

        $("#gender").editable({
            prepend: "not selected",
            url: "{{ route('settings.users.biodata') }}",
            source: [{
                value: 'L',
                text: "Male"
            }, {
                value: 'P',
                text: "Female"
            }],
            display: function(e, t) {
                var n = {
                        "": "",
                        "L": '<i class="fa fa-male m-r-5"></i>',
                        "P": '<i class="fa fa-female m-r-5"></i>'
                    },
                    r = $.grep(t, function(t) {
                        return t.value == e
                    });
                if (r.length) {
                    $(this).text(r[0].text).prepend(n[e])
                } else {
                    $(this).empty()
                }
            }
        });
        $("#password-indicator-new").passwordStrength({
            targetDiv: "#passwordStrengthNew"
        });
        $('#btn-update-password').click(function(e) {
            $('#btn-update-password').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('#btn-update-password').prop('disabled', true);
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-password').text('');
            $('.invalid-password_new').text('');
            $('.invalid-password_confirm').text('');
            var _pass = $('#password-indicator-current').val();
            var _passNew = $('#password-indicator-new').val();
            var _passConfirm = $('#password-indicator-confirm').val();
            $.ajax({
                url: "{{ route('settings.users.editpass') }}",
                type: "PUT",
                data: {
                    password: _pass,
                    password_new: _passNew,
                    password_confirm: _passConfirm,
                },
                success: function(result) {
                    if (result.success) {
                        swal("Updated!", result.message, "success");
                    }
                    $('#btn-update-password').html('Update');
                    $('#btn-update-password').prop('disabled', false);
                },
                error: function(err) {
                    $.each(JSON.parse(err.responseText).message, function(i, error) {
                        console.log(i);
                        var _field = $(document).find('[name="' + i + '"]');
                        _field.addClass('is-invalid');
                        var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                        el.css('display', 'block');
                        el.text(error[0]);
                    });
                    $('#btn-update-password').html('Update');
                    $('#btn-update-password').prop('disabled', false);
                }
            });
        });

        $('.btn-choose-image').change(function(e) {
            var files = e.target.files;
            var file_data = files[0];
            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-avatar').attr('src', event.target.result);
                    $('#img-header-avatar').attr('src', event.target.result);
                    $('#img-sidebar-avatar').attr('src', event.target.result);
                }
                reader.readAsDataURL(file_data);
                var formData = new FormData();
                formData.append('file', file_data);
                $.ajax({
                    url: "{{ url('settings/users/avatar') }}",
                    type: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result.success) {
                            swal("Updated!", result.message, "success");
                        }
                    },
                    error: function(err) {

                    }
                });
            }
        });
    });
</script>
@endsection