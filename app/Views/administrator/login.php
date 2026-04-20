<!DOCTYPE html>
<html lang="en" >
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <title>Login Administrator | Oceanarium</title>
        <meta name="description" content="Login page example"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>        <!--end::Fonts-->
        
        <!--begin::Page Custom Styles(used by this page)-->
        <link href="<?= base_url('');?>assets/css/pages/login/login-15883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <!--end::Page Custom Styles-->
        
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?= base_url('');?>assets/plugins/global/plugins.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('');?>assets/plugins/custom/prismjs/prismjs.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('');?>assets/css/style.bundle5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        
        <link href="<?= base_url('');?>assets/css/themes/layout/header/base/light5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('');?>assets/css/themes/layout/header/menu/light5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('');?>assets/css/themes/layout/brand/dark5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('');?>assets/css/themes/layout/aside/dark5883.css?v=7.2.9" rel="stylesheet" type="text/css"/>        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="<?= base_url()?>assets/image/logobxsea.png"/>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #182c53;">
                    <!--begin::Aside Top-->
                    <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                        <!--begin::Aside header-->
                        <a href="#" class="text-center mb-10">
                            <img src="<?= base_url('');?>assets/image/logobxsea_white.png" class="max-h-100px" alt=""/>
                        </a>
                        <!--end::Aside header-->
                        <!--begin::Aside title-->
                        <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #ffff;">
                            Welcome to BXSEA <br> Landing Administrator
                        </h3><br>
                        <h5 class="font-weight-bolder text-center font-size-h4 font-size-h4-lg" style="color: #ffff;">Plan your blog post by choosing a topic <br> creating
an outline and checking facts</h5>
                        <!--end::Aside title-->
                    </div>
                    <!--end::Aside Top-->
                    <!--begin::Aside Bottom-->
                    <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-y-center" style="background-image: url(<?= base_url();?>assets/image/fishdeep.png); width:100%;"></div>
                    <!--end::Aside Bottom-->
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                    <!--begin::Content body-->
                    <div class="d-flex flex-column-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <?php if(session()->getFlashdata('nodata')):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Warning!</strong> Your username & password data does not match, please check again.
                                </div>
                            <?php endif;?>
                            <?php if(session()->getFlashdata('error')):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Error!</strong> You failed to sign in.
                                </div>
                            <?php endif;?>
                            <?php if(session()->getFlashdata('invalidate')):?>
                                <div class="alert alert-primary alert-dismissible">
                                    <strong>Info!</strong> The data you send is not validated.
                                </div>
                            <?php endif;?>
                            <?php if(session()->getFlashdata('nologin')):?>
                                <div class="alert alert-primary alert-dismissible">
                                    <strong>Hey!</strong> You do not have access to the page, please login first.
                                </div>
                            <?php endif;?>
                            <!--begin::Form-->
                            <form method="POST" action="<?= base_url('adminsite/loginproc');?>" class="form">
                                <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to BXSEA Administrator</h3>
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Username</label>
                                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="text" name="username" autocomplete="off" required="required" placeholder="Input Your Username"/>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                    </div>
                                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" name="password" autocomplete="off" required="required" placeholder="Input Your Password"/>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5">
                                    <input type="submit" name="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" value="Sign In To Dashboard">
                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->                        
                    </div>
                    <!--end::Content body-->
                    <!--begin::Content footer-->
                    <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                        <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                            <span class="mr-1">2023&copy;</span>
                            <a href="https://bxsea.co.id/" target="_blank" class="text-dark-75 text-hover-primary">BXSea Bintaro Jaya</a>
                        </div>
                        <a href="javascript:void(0);" class="text-primary font-weight-bolder font-size-lg">Terms</a>
                        <a href="javascript:void(0);" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
                        <a href="javascript:void(0);" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a>
                    </div>
                    <!--end::Content footer-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->
        
        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>
            var KTAppSettings = {
                "breakpoints": {
                    "sm": 576,
                    "md": 768,
                    "lg": 992,
                    "xl": 1200,
                    "xxl": 1400
                },
                "colors": {
                "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
            };
        </script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="<?= base_url('');?>assets/plugins/global/plugins.bundle5883.js?v=7.2.9"></script>
        <script src="<?= base_url('');?>assets/plugins/custom/prismjs/prismjs.bundle5883.js?v=7.2.9"></script>
        <script src="<?= base_url('');?>assets/js/scripts.bundle5883.js?v=7.2.9"></script>
        <!--end::Global Theme Bundle-->
    </body>
    <!--end::Body-->
</html>