<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Sppd">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon.png'); ?>">
    <link href="<?= base_url('assets'); ?>/main.css" rel="stylesheet">
</head>
<style type="text/css">
    .modal-backdrop {
        z-index: -1;
    }
</style>
<link href="<?= base_url('assets/'); ?>jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url('assets/'); ?>buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() . 'assets/morris.css' ?>">
<link rel="stylesheet" href="<?= base_url('assets/'); ?>select2.min.css" />
<link rel="stylesheet" href="<?= base_url('assets/'); ?>toastr.min.css" />
<link rel="stylesheet" href="<?= base_url('assets/'); ?>jquery-ui.css" />

<script src="<?= base_url('assets/'); ?>jquery.js"></script>
<script src="<?= base_url('assets/'); ?>select2.full.min.js"></script>
<script src="<?php echo base_url('assets/jquery.form.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/validation/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/'); ?>dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>toastr.min.js"></script>
<script src="<?= base_url('assets/'); ?>sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/inputmask.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery.inputmask.js'); ?>"></script>

<script src="<?= base_url() . 'assets/raphael-min.js' ?>"></script>
<script src="<?= base_url() . 'assets/morris.min.js' ?>"></script>

<script src="<?php echo base_url('assets/jquery-ui.js'); ?>"></script>


<link rel="stylesheet" href="<?= base_url('assets/'); ?>sweetalert2.css" />
<script src="<?= base_url('assets/fontawesome.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/'); ?>sweetalert2.js"></script>
<script src="<?= base_url('assets/'); ?>bootstrap.min.js"></script>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Header -->
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?= $this->session->userdata('namanya'); ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?= $this->session->userdata('email'); ?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example" id="metu">
                                        <i class="fa text-white fa-sign-out-alt pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header  -->
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>

                <?php $this->load->view('sidebar'); ?>

            </div>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <!-- content -->
                    <?= $output; ?>
                    <!-- End Content  -->
                </div>

                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <!-- <a href="javascript:void(0);" class="nav-link">
                                                 Footer Right   
                                            </a> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('assets'); ?>/scripts/main.js"></script>
    <script>
        $("#metu").on('click', function() {
            window.location.href = "<?= site_url('logout'); ?>";
        });
    </script>

</body>

</html>