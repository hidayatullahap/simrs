<style>
    html {
        background: url(<?php echo base_url("assets/images/background_login3.jpg");?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    body {
        background: transparent;
    }
    .login-box, .login-box .login-box-body{
        background-color: rgba(229, 229, 229, 1);
    }

    .colorter{
        -webkit-animation: color-change 2s infinite;
        -moz-animation: color-change 2s infinite;
        -o-animation: color-change 2s infinite;
        -ms-animation: color-change 2s infinite;
        animation: color-change 2s infinite;
    }

    @-webkit-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-moz-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-ms-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-o-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3c8dbc; }
        100% { color: #0dc143; }
    }
</style>
<body>
        <div class="login-box">
            <div class="login-logo">
                <div style="margin-top: -5%; margin-bottom: -5%;">
                    <a href="#"><strong><span class="colorter">SIMRS</span></strong></a>
                </div>
                <div style="margin-top: -5%; margin-bottom: -10%;">
                    <span style="font-size: 60%;">Sistem Informasi Rumah Sakit</span>
                </div>
            </div>
            <div class="login-box-body">
                <form action="<?php  echo base_url('/login/proses'); ?>" method="post" id="form_login">
                    <?php
                    if ($this->session->userdata('notif_error')) {
                        ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo $this->session->userdata('notif_error'); ?>
                        </div>
                    <?php $this->session->unset_userdata('notif_error');
                    } ?>
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Username" required="required"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="required"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
            <div style="margin-top: 0%; margin-bottom: 5%; padding-bottom: 5%; text-align: center;">
                <span style="font: 400 170% 'Great Vibes', Helvetica, sans-serif; color: #222222; text-shadow: 4px 4px 3px rgba(0,0,0,0.1); ">~ Bergerak Cepat Memberi Pelayanan ~</span>
            </div>
        </div>

        <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script src="<?php echo base_url("assets/js/plugins/validator/validator.js"); ?>"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' 
                });
            });
        </script>
        <script>
            validator.message.date = 'not a real date';

            $('#form_login')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required').on('keyup blur', 'input', function() {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

            $('#form_login').submit(function(e) {
                e.preventDefault();
                var submit = true;

                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();

                return false;
            });
        </script>
    </body>
</html>