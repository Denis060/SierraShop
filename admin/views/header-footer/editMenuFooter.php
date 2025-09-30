<?php require('admin/views/shared/header.php'); ?>
<?php require('admin/views/shared/loader.php'); ?>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<?php require('admin/views/shared/formsearch.php'); ?>
<?php require('admin/views/shared/rightnavbar.php'); ?>
<?php require('admin/views/shared/leftnavbar.php'); ?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Menu Footer</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> SierraShop</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=header-footer">Header-Footer</a></li>
                        <li class="breadcrumb-item active">Edit menu link permissions</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <h2 style="font-weight: bold;">Edit link information</h2>
                <div class="col-lg-12">
                    <form id="product-form" class="form-horizontal" method="post" action="admin.php?controller=header-footer&amp;action=editMenuFooter" enctype="multipart/form-data" role="form">
                        <input name="menu_footer_id" type="hidden" value="<?= $menuFooter ? $menuFooter['id'] : '0'; ?>" />
                        <h4 class="card-inside-title" style="font-weight:bold;">Link description name</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="name" type="text" maxlength="150" value="<?= $menuFooter ? $menuFooter['menu_name'] : ''; ?>" class="form-control" id="name" placeholder="E.g.: tanhongit.com, Tan Hong IT Homepage..." required="" />
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Add link:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="menu_url" maxlength="255" type="text" value="<?= $menuFooter ? $menuFooter['menu_url'] : ''; ?>" class="form-control" id="name" placeholder="https://tanhongit.com..."/>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Add description:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="menu_description" maxlength="255" type="text" value="<?= $menuFooter ? $menuFooter['menu_description'] : ''; ?>" class="form-control" id="name" placeholder="E.g.: E-commerce website, etc..."/>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group" style="text-align: center;">
                            <button class="btn btn-primary waves-effect" type="submit">Update link information</button>
                            <a class="btn btn-warning waves-effect" href="admin.php?controller=header-footer&amp;action=listMenuFooter">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require('admin/views/shared/footer.php'); ?>
